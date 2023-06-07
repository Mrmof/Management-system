<?php
// this is a connection to our database
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'management_system';

$connection = new mysqli($server, $username, $password, $database);

// if ($connection == true) {
//     echo 'Connected Successfully';
// } else {
//     die('Connection Failed' . $connection->connect_error);
// }



?>