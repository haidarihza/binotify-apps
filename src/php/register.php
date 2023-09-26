<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../resources/css/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;900&display=swap" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;900&display=swap');
    </style>
</head>

<body>
    <script type="text/javascript" src="backend_register.js"></script>
    <div>
        <ul>
            <li><a class="active" href="">Register</a></li>
        </ul>
    </div>
    <h1>Binotify</h1>
    <h2>Sign Up for Free</h2>
    <div class="form-center">
        <form action="backend_register.php" method="post">
            <input type="text" id="name" name="name" placeholder="Name" onchange="check_name(this.value)"><br>
            <p class="warning" id="name-warn"></p>
            <input type="text" id="username" name="username" placeholder="Username" onchange="check_username(this.value)"><br>
            <p class="warning" id="username-warn"></p>
            <input type="text" id="email" name="email" placeholder="Email" onchange="check_email(this.value)"><br>
            <p class="warning" id="email-warn"></p>
            <input type="password" id="password" name="password" placeholder="Password" onchange="check_pass(this.value)"><br>
            <p class="warning" id="password-warn"></p>
            <input type="password" id="confirmpass" name="confirm-pass" placeholder="Confirm Password" onchange="check_confirmpass(this.value)"><br>
            <p class="warning" id="confirmpass-warn"></p>
            <input type="submit" name="action" value="Register"><br>
        </form>
    </div>
    <p>Already have an account? <a class="refer" href="login.php">Log in</a></p>
</body>
<?php require_once('./footer.php'); ?>

</html>