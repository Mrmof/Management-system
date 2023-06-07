<?php 
session_start();
include '../php/connection.php';
if (!$_SESSION['staff_id']) {
  header('location: ../register/signin.php');
}
$staff_id = $_GET['id'];
$gettingadmin = "SELECT * FROM `staff` WHERE staff_id = '$staff_id'";
$querytogetadmin = $connection->query($gettingadmin);
if ($querytogetadmin->num_rows > 0) {
  $row = $querytogetadmin->fetch_assoc();
  $admin_id = $row['admin_id'];
}
$items =  "SELECT * FROM `item`WHERE admin_id = '$admin_id'";
$itemquery = $connection->query($items);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Items</title>
    <style>
      .h2{
        color: red;
      }
      .mgtsystem{
        width: 100%;
        border: 2px solid black;
        display: flex;
        justify-content: space-between;
      }
      .h3{
        border: 2px solid black;
        padding: 20px;
        width:646%;
        border-right: none;
        border-top: none;
        border-left: none;
      }
      .h3t{
        padding: 20px;
        text-align: right;
      }
      .mgta{
        width: 20%;
      }
      .mgta2{
        width: 80%;
      }
      .mgta li{
        list-style-type: none;
        color: black;
        border: 2px solid black;
        width: 70%;
        margin-left: -40px;
        border-left: none;
        border-top: none;
        padding: 40px;
        margin-top: -19px;
      }
      .mgta a{
        text-decoration: none;
      }
      .li{
        margin-bottom: -18px;
      }
    </style>
</head>
<body>
    <h2 class="h2">Admin Dashboard</h2>
    <div class="mgtsystem">
      <div class="mgta">
        <h3 class="h3">Management System</h3>
        <ul>
            <li><a href="staffdashboard.php?<?php echo 'id='.
          $staff_id ;?>">Staff Details</a></li>
            <li><a href="transactions.php?<?php echo 'id='.
          $staff_id ;?>">Transaction</a></li>
            <li><a href="records.php?<?php echo 'id='.
          $staff_id ;?>">Record</a></li>
            <li><a href="../php/logout.php">Logout</a></li>
        </ul>
        
      </div>
      <div class="mgta2">
          <h3>Items in Store | Records</h3>

          <table>
            <tr>
                <td>S/N</td>
                <td>Items</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Total</td>
                <td>Delete</td>
            </tr>
            <?php
            $i = 1;
            while ($row = $itemquery->fetch_assoc())  {
                
                echo '<tr>';
                echo      '<td>' .$i++ .'</td>';
                echo      '<td>' .$row['item_name'] .'</td>';
                echo      '<td>' .$row['item_quantity'].'</td>';
                echo      '<td>' .$row['item_price'] .'</td>';
                echo      '<td>' .$row['item_total'] .'</td>';
              ?> 
                          <td><span>delete</span></td>
               
                <?php echo  '</tr>';

                }
              ?>
            
            
          </table>
      </div>
    </div>
    
</body>
</html>