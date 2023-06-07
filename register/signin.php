<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../icofont/icofont.css">
    <link rel="stylesheet" href="../icofont/icofont.min.css">
    <title>Management System | Signin</title>
</head>
<body>
        <h3 class="mgt-heading">Management System Sign in</h3>
        <div class="signinFormMgt">
            <form action="../php/users.php" method="post">
                <div class="mgtFormDivs">
                    <input type="email" placeholder="Enter your valid Email" name="email"> <span class="icofont-email"></span>
                </div>
                <div class="mgtFormDivs">
                    <input type="password" placeholder="Enter your password" id="psw" name="password"> <span class="icofont-eye-alt" onclick="showpassword()" id="spanicon"></span>
                    <p id="validate" style="color: red;"></p>
                </div>
                <div class="mgtFormDivs">
                    <input type="submit" value="Sign In" name="signin">
                </div>
            </form>
        </div>
        <script src="../javascript/javascriptefile.js"></script>
</body>
</html>