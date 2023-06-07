<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../icofont/icofont.css">
    <link rel="stylesheet" href="../icofont/icofont.min.css">
    <title>Management System | Sign up</title>
</head>
<body>
        <h3 class="mgt-heading">Management System Sign up</h3>
        <div class="signinFormMgt">
            <form action="../php/users.php" method="post">
                <div class="mgtFormDivs">
                    <input type="text" placeholder="Fullname" name="fullname"> <span class="icofont-email"></span>
                    <p style="color: red;"><?php if (isset($_SESSION['errorMessage']['name'])) {
                        echo $_SESSION['errorMessage']['name'];
                    }?></p>
                </div>
                <div class="mgtFormDivs">
                    <input type="email" placeholder="Enter your valid Email" name="email"> <span class="icofont-email"></span>
                    
                </div>
                <div class="mgtFormDivs">
                    <input type="text" placeholder="Company Name" name="companyname"> <span class="icofont-email"></span>
                    <p style="color: red;"><?php if (isset($_SESSION['errorMessage']['company'])) {
                        echo $_SESSION['errorMessage']['company'];
                    }?></p>
                </div>
                <div class="mgtFormDivs">
                    <input type="text" placeholder="Description" name="description"> <span class="icofont-email"></span>
                    <p style="color: red;"><?php if (isset($_SESSION['errorMessage']['description'])) {
                        echo $_SESSION['errorMessage']['description'];
                    }?></p>
                </div>
                <div class="mgtFormDivs">
                    <input type="password" placeholder="Enter your password" id="psw" name="password"> <span class="icofont-eye-alt" onclick="showpassword()" id="spanicon"></span>
                    <p id="validate" style="color: red;"></p>
                    <p style="color: red;"><?php if (isset($_SESSION['errorMessage']['password'])) {
                        echo $_SESSION['errorMessage']['password'];
                    }?></p>
                </div>
                <div class="mgtFormDivs">
                    <input type="password" placeholder="Confirm password" id="psw" name="confirmpassword"> <span class="icofont-eye-alt" onclick="showpassword()" id="spanicon"></span>
                    <p id="validate" style="color: red;"></p>
                    <p style="color: red;"><?php if (isset($_SESSION['errorMessage']['confirmP'])) {
                        echo $_SESSION['errorMessage']['confirmP'];
                    }?></p>
                </div>
                <div class="mgtFormDivs">
                    <input type="submit" value="Sign in" name="submit">
                </div>
            </form>
        </div>
        <script src="../javascript/javascriptefile.js"></script>
</body>
</html>