<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../resources/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;900&display=swap" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;900&display=swap');
    </style>
</head>

<body>
    <div>
        <ul>
            <li><a class="active" href="">Login</a></li>
        </ul>
    </div>
    <h1>Binotify</h1>
    <h2>Log in to Continue</h2>
    <div class="alert">
    <?php
        $login_err = $_GET['login_err'];
        if(!empty($login_err)){
            echo $login_err;} ?>
    </div>
    <div class="form-center">
        <form action="backend_register.php" method="post">
            <input type="text" id="username" name="username" placeholder="Username"><br>
            <input type="password" id="password" name="password" placeholder="Password"><br>
            <input type="submit" name="action" class="login" value="Log in"><br>
            <input type="submit" name="action" class="not-login" value="Continue Without Log in">
        </form>
    </div>
    <p>Don't have an account? <a class="refer" href="register.php">Sign Up</a></p>
</body>
<?php require_once('./footer.php'); ?>

</html>