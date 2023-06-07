<?php

include 'connection.php';
// echo $_POST['fullname'] .$_POST['email'] ;

if (isset($_POST['submit'])) {
    session_start();
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $companyname = $_POST['companyname'];
    $description = $_POST['description'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    
    // security
    $_SESSION['errorMessage'] = []; 
    if (strlen($fullname) < 3 || $fullname == "") {
        echo "<script>window.history.back(); </script>";
        $_SESSION['errorMessage']['name'] = 'Please input your fullname';
        
    } elseif ($companyname == "") {
        echo "<script>window.history.back(); </script>";
        $_SESSION['errorMessage']['company'] = 'Please input your Company Name';
    } elseif ($description == "") {
        echo "<script>window.history.back(); </script>";
        $_SESSION['errorMessage']['description'] = 'Please input your Company Description';
    } elseif ($password == "" || strlen($password) < 7) {
        echo "<script>window.history.back(); </script>";
        $_SESSION['errorMessage']['password'] = 'Please input your password (Password must be above 7 characters)';
    } elseif ($confirmpassword != $password) {
        echo "<script>window.history.back(); </script>";
        $_SESSION['errorMessage']['confirmP'] = 'Please input your correct password';
    } else {
        $sendToTable = "INSERT INTO `users`(`fullname`, `email`, `company_name`, `description`, `password`, `cpassword`) VALUES ('$fullname','$email','$companyname','$description','$password','$confirmpassword')";
        $sqlconnect = $connection->query($sendToTable);
        header("location: ../register/signin.php");

    }



    
    
  
}

if (isset($_POST['signin'])) {
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $checker = "SELECT * FROM `users` WHERE email = '$email'";
    $sqlquery = $connection->query($checker);
   
    //check if connect message was sent
    // if ($sqlquery == true) {
    //     echo 'yes';
    // }else {
    //     echo ' no';
    // }

        // check is the email matches at least 1 row
    // if ($sqlquery->num_rows > 0) {
    //     echo 'yes';
    // } else{
    //     echo 'no';
    // }
    
    // this is the fetch part
    if ($sqlquery->num_rows > 0) {
        $row = $sqlquery->fetch_assoc();
        // $row = [id, fullname, email, company_name, comp, d, pass, cp]
        $_SESSION['id'] = $row['id'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['companyName'] = $row['company_name'];
        header("location: ../ManagementAdmin/admindashboard.php?id=".$_SESSION['id']);
    }  else{
        $checkstaff = "SELECT * FROM `staff` WHERE staff_email = '$email'";
        $sqlquery = $connection->query($checkstaff);
        if ($sqlquery->num_rows > 0) {
            $row = $sqlquery->fetch_assoc();
            // $row = [id, fullname, email, company_name, comp, d, pass, cp]
            $_SESSION['staff_id'] = $row['staff_id'];
            header("location: ../ManagementStaff/staffdashboard.php?id=".$_SESSION['staff_id']);
        } 

    }  
}
// $_SESSION['staff_id'];

?>