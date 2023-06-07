<?php  
session_start();
session_unset();
header('location: ../register/signin.php');

?>