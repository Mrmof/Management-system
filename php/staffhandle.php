<?php 
session_start();
include('connection.php');
if (isset($_POST['addtrans'])) {
    $staff_id = $_GET['id'];
    $gettingadmin = "SELECT * FROM `staff` WHERE staff_id = '$staff_id'";
    $querytogetadmin = $connection->query($gettingadmin);
    if ($querytogetadmin->num_rows > 0) {
    $adminrow = $querytogetadmin->fetch_assoc();
    $admin_id = $adminrow['admin_id'];
    }
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
    $username = $adminrow['staff_fullname'];;
       $trans = $username .' purchased ' .$selected_quantity .' ' .$itemselected .' on the ' .$date_added;
       $history = "INSERT INTO `history`(`name`, `transaction`) VALUES ('$username', '$trans')";
        $histsql = $connection->query($history);
    $_SESSION['purchase_item'] = $itemselected;
    $_SESSION['purchase_quantity'] = $selected_quantity;
    header("location: ../ManagementStaff/transactions.php?id=" .$staff_id);

}

if (isset($_POST['removetrans'])) {
    $admin_id = $_GET['id'];
    $staff_id = $_GET['id'];
    $gettingadmin = "SELECT * FROM `staff` WHERE staff_id = '$staff_id'";
    $querytogetadmin = $connection->query($gettingadmin);
    if ($querytogetadmin->num_rows > 0) {
    $adminrow = $querytogetadmin->fetch_assoc();
    $admin_id = $adminrow['admin_id'];
    // echo $admin_id;
    
    }
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

       $username = $adminrow['staff_fullname'];;
       $trans = $username .' sold ' .$selected_quantity .' ' .$itemselected .' on the ' .$date_added;
       $history = "INSERT INTO `history`(`name`, `transaction`) VALUES ('$username', '$trans')";
        $histsql = $connection->query($history);
    $_SESSION['sold_item'] = $itemselected;
    $_SESSION['sold_quantity'] = $selected_quantity;
    header("location: ../ManagementStaff/transactions.php?id=" .$staff_id);

}

?>