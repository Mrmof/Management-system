<?php 
session_start();
include 'connection.php';
if (isset($_POST['updateadmin'])) {
    $admin_id = $_GET['id'];
    $_SESSION['errorMessage'] = [];
    $fullname = $_POST['fullname'];
    $company_name = $_POST['company_name'];
    $company_description = $_POST['description'];
    $password = $_POST['password'];
    $confirmpass = $_POST['confirmP'];
    if ($fullname == '' || strlen($fullname) < 3) {
        echo "<script>window.history.back(); </script>";
        $_SESSION['errorMessage']['fullname'] = 'Please input your fullname';
    } elseif ($company_name == '' || strlen($company_name) < 3) {
        echo "<script>window.history.back(); </script>";
        $_SESSION['errorMessage']['company'] = 'Please input your company name';
    } elseif ($company_description == '' || strlen($company_description) < 3) {
        echo "<script>window.history.back(); </script>";
        $_SESSION['errorMessage']['company_desc'] = 'Please input your company description';
    } elseif ($password == '' || strlen($password) < 8) {
        echo "<script>window.history.back(); </script>";
        $_SESSION['errorMessage']['password'] = 'Please input your password (Password must be above 7 characters)';
    } 
    elseif ($password != $confirmpass) {
        echo "<script>window.history.back(); </script>";
        $_SESSION['errorMessage']['confirm_password'] = 'Password mismatch (Input correct password)';
    }else{
        $update = "UPDATE `users` SET `fullname`='$fullname',`company_name`='$company_name',`description`='$company_description',`password`='$password',`cpassword`='$confirmpass' WHERE id = '$admin_id'";
        $sqlquery = $connection->query($update);
        // if ($sqlquery) {
        //     echo 'yes';
        // }
        
        header("location: ../ManagementAdmin/admindashboard.php?id=".$_SESSION['id']);
    }
}

if (isset($_POST['addstaff'])) {
    $admin_id = $_GET['id'];
    $staff_fullname = $_POST['staff_fullname'];
    $staff_email = $_POST['staff_email'];
    $staff_position = $_POST['staff_position'];
    $staff_password = $_POST['staff_password'];
    // echo $staff_password;
    $checker = "SELECT * FROM `users` WHERE id = '$admin_id'";
    $result = $connection->query($checker);
    if ($result->num_rows > 0) {
       $admincollect = $result->fetch_assoc();
        $input = $admincollect['email'];
        echo $input;
    }

    $staffinsert = "INSERT INTO `staff`(`staff_fullname`, `staff_email`, `staff_position`, `staff_password`, `admin_id`,`admin_email`) VALUES ('$staff_fullname','$staff_email','$staff_position','$staff_password','$admin_id', '$input')";

    $sql = $connection->query($staffinsert);
    if ($sql) {
       header("location: ../ManagementAdmin/staff.php?id=" .$_SESSION['id']);
    }

    

}

if (isset($_POST['additem'])) {
    $admin_id = $_GET['id'];
    $item_name = $_POST['item'];
    $item_quantity = $_POST['quantity'];
    $item_price = $_POST['price'];
    $item_total = $item_quantity * $item_price;
    $date_added = date("Y.m.d");
    // echo $date_added;

    $insertitem = "INSERT INTO `item`(`item_name`, `item_quantity`, `item_price`, `item_total`, `admin_id`, `date_added`) VALUES ('$item_name','$item_quantity','$item_price','$item_total','$admin_id','$date_added')";

    $sql = $connection->query($insertitem);
    if ($sql) {
        header("location: ../ManagementAdmin/items.php?id=" .$_SESSION['id']);
    }

}

if (isset($_POST['addtrans'])) {
    $admin_id = $_GET['id'];
    $itemselected = $_POST['item'];
    $selected_quantity = $_POST['Item_quantity'];
    $date_added = date("Y.m.d");
    $items =  "SELECT * FROM `item` WHERE item_name = '$itemselected' AND admin_id = $admin_id";
    $itemquery = $connection->query($items);
    if ($itemquery->num_rows > 0) {
        $row = $itemquery->fetch_assoc();
        $selected_quantity1 = $row['item_quantity'] + $selected_quantity;
        $item_total = $selected_quantity1 * $row['item_price'];
        $date_added = date("Y.m.d");
        $newquery = "UPDATE `item` SET `item_quantity`='$selected_quantity1',`item_total`='$item_total',`date_added`= '$date_added' WHERE item_name = '$itemselected' AND admin_id = $admin_id";
        $purchase = $connection->query($newquery);
    }
    $getadmin = "SELECT * FROM `users` WHERE id = '$admin_id'";
    $admininfo = $connection->query($getadmin);
    if ($admininfo->num_rows > 0) {
       $details = $admininfo->fetch_assoc();
       $username = $details['fullname'];
       $trans = $username .' purchased ' .$selected_quantity .' ' .$itemselected .' on the ' .$date_added;
       $history = "INSERT INTO `history`(`name`, `transaction`) VALUES ('$username', '$trans')";
        $histsql = $connection->query($history);
        if ($histsql) {
           echo 'yes';
        }
    }
    $_SESSION['purchase_item'] = $itemselected;
    $_SESSION['purchase_quantity'] = $selected_quantity;
    header("location: ../ManagementAdmin/transactions.php?id=" .$admin_id);

}

if (isset($_POST['removetrans'])) {
    $admin_id = $_GET['id'];
    $itemselected = $_POST['item'];
    $selected_quantity = $_POST['Item_quantity'];
    $date_added = date("Y.m.d");
    $items =  "SELECT * FROM `item` WHERE item_name = '$itemselected' AND admin_id = $admin_id";
    $itemquery = $connection->query($items);
    if ($itemquery->num_rows > 0) {
        $row = $itemquery->fetch_assoc();
        $selected_quantity1 = $row['item_quantity'] - $selected_quantity;
        $item_total = $selected_quantity1 * $row['item_price'];
        $date_added = date("Y.m.d");
        $newquery = "UPDATE `item` SET `item_quantity`='$selected_quantity1',`item_total`='$item_total',`date_added`= '$date_added' WHERE item_name = '$itemselected' AND admin_id = $admin_id";
        $purchase = $connection->query($newquery);
        
    }
    $getadmin = "SELECT * FROM `users` WHERE id = '$admin_id'";
    $admininfo = $connection->query($getadmin);
    if ($admininfo->num_rows > 0) {
       $details = $admininfo->fetch_assoc();
       $username = $details['fullname'];
       $trans = $username .' sold ' .$selected_quantity .' ' .$itemselected .' on the ' .$date_added;
       $history = "INSERT INTO `history`(`name`, `transaction`) VALUES ('$username', '$trans')";
        $histsql = $connection->query($history);
    }
    $_SESSION['sold_item'] = $itemselected;
    $_SESSION['sold_quantity'] = $selected_quantity;
    header("location: ../ManagementAdmin/transactions.php?id=" .$admin_id);

}


?>

