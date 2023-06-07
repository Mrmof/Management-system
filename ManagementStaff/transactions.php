<?php 
session_start();
include '../php/connection.php';
if (!isset($_SESSION['staff_id'])) {
  header('location: ../register/signin.php');
}
$staff_id = $_GET['id'];
$gettingadmin = "SELECT * FROM `staff` WHERE staff_id = '$staff_id'";
$querytogetadmin = $connection->query($gettingadmin);
if ($querytogetadmin->num_rows > 0) {
  $row = $querytogetadmin->fetch_assoc();
  $admin_id = $row['admin_id'];
}
$transactions =  "SELECT * FROM `item` WHERE admin_id = '$admin_id'";
$transquery = $connection->query($transactions);
// if ($transquery->num_rows > 0) {
//     echo 'yes';
// }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Transactions</title>
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
    <h2 class="h2">Staff Dashboard</h2>
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
          <h3>Transactions</h3>
          <form action="../php/staffhandle.php?<?php echo 'id='.
          $staff_id ;?>" method="post">
              <select name="item" id="">
                <option value="">Select an Item</option>
              <?php

               while ($row = $transquery->fetch_assoc())  {
              ?>
              <option value="<?php echo $row['item_name'];?>"> <?php echo $row['item_name'];?> </option>;
                <?php }?>
              </select>
            <input type="number" name="Item_quantity" placeholder="Quantity">
            <input type="submit" value="Purchase" name="addtrans">
            <input type="submit" value="Sell" name="removetrans">
          </form>

          <div><p> <?php 
          if (isset($_SESSION['purchase_item'])) {
            session_destroy();
            echo 'You just made a restock of ' .$_SESSION['purchase_quantity'] .' items  on ' .$_SESSION['purchase_item'];
;          }
          ?></p></div>
          <div><p> <?php 
          
          if (isset($_SESSION['sold_item'])) {
            session_destroy();
            echo 'You just made a sales of ' .$_SESSION['sold_quantity'] .' items  on ' .$_SESSION['sold_item'];
;          }
          ?></p></div>
      </div>
    </div>
    
    
</body>
</html>