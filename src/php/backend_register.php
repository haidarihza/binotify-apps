<?php
    $host = 'db';
    // Database use name
    $user = 'MYSQL_USER';
    //database user password
    $pass = 'MYSQL_PASSWORD';
    // database name
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $login_err = "";

    //AJAX Section
    if (!empty($_GET)){
        if ($_GET['sector'] == 1){
            if (!empty($_GET['name'])){
                $name = $_GET['name'];
                if (strlen($name) > 0){
                    echo "";
                }
            }
            else {
                echo "Name must be filled";
            }
        }
        else if ($_GET['sector'] == 2){
            if (!empty($_GET['username'])){
                $username = $_GET['username'];
                $sql = "SELECT * FROM user WHERE username = '$username'";
                if ($result = $conn->query($sql)) {
                    if ($result->num_rows > 0) {
                        echo "This username is already exist";
                    } else if ($_GET['username'] == "Guest"){
                        echo "This username is already exist";
                    }else {
                        //check for the regex
                        if ((preg_match("/^[a-zA-Z0-9_]*$/", $username)) && ($username != '') && (strlen($username) > 5)) {
                            echo "";
                        } else {
                            echo "Username must be alphanumeric and underscores only. Minimum 6 characters";
                        }
                    }
                }
            }
            else {
                echo "Username must be filled";
            }
        } else if ($_GET['sector'] == 3){
            if (!empty($_GET['email'])){
                $email = $_GET['email'];
                $sql = "SELECT * FROM user WHERE email = '$email'";
                if ($result = $conn->query($sql)) {
                    if ($result->num_rows > 0) {
                        echo "This email is already used";
                    } else {
                        //check for the regex
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo "";
                        } else {
                            echo "Email is not valid";
                        }
                    }
                }
            }
            else {
                echo "Email must be filled";
            }
        } else if ($_GET['sector'] == 4){
            if (!empty($_GET['pass'])){
                $password = $_GET['pass'];
                if (strlen($password) > 0){
                    echo "";
                }
            }
            else {
                echo "Password must be filled";
            }
        } else if ($_GET['sector'] == 5){
            if (!empty($_GET['confirmpass'])){
                $password = $_GET['pass'];
                $confirm_pass = $_GET['confirmpass'];
                if ($password == $confirm_pass){
                    echo "";
                }
                else {
                    echo "Password and Confirm Password must be same";
                }
            }
            else {
                echo "Confirm Password must be filled";
            }
        }
    }
    
    //Registration Section
    $name_valid = false;
    $username_valid = false;
    $email_valid = false;
    $password_valid = false;
    $confirm_pass_valid = false;

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm-pass'];
    $isAdmin = 0;

    if (strlen($name) > 0){
        $name_valid = true;
    }
    if ((preg_match("/^[a-zA-Z0-9_]*$/", $username)) && ($username != '') && (strlen($username) > 5)) {
        $username_valid = true;
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_valid = true;
    }
    if (strlen($password) > 0){
        $password_valid = true;
    }
    if ($password == $confirm_pass){
        $confirm_pass_valid = true;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    if($_POST['action'] == 'Register'){
        if ($name_valid && $username_valid && $email_valid && $password_valid && $confirm_pass_valid){
            $sql = "INSERT INTO user(email, password, username, isAdmin, name) VALUES ('$email', '$password_hash', '$username', $isAdmin, '$name')";
            mysqli_query($conn, $sql);
            if (mysqli_affected_rows($conn)){
                echo '<script> alert("Your account has been created. Please login to continue.");
                window.location.href="login.php";
                </script>';
            } else{
                echo '<script>Oops! Something went wrong. Please try again later.</script>';
            };
        }
        else{
            echo '<script>Gagal, masih ada kesalahan</script>';
        }
    }

    //Login Section
    if($_POST['action'] == 'Log in'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        if ($result = $conn->query($sql)) {
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $hashed_password = $row['password'];
                if (password_verify($password, $hashed_password)){
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['isAdmin'] = $row['isAdmin'];
                    $_SESSION['isLogin'] = 1;
                    header("location: homePage.php");
                } else{
                    $login_err = "Invalid username or password.";
                    header("location: login.php?login_err=$login_err");
                }
            } else{
                $login_err = "Invalid username or password.";
                header("location: login.php?login_err=$login_err");
            }
        }
    }
    //Continue without Login Section
    if($_POST['action'] == 'Continue Without Log in'){
        session_start();
        $_SESSION['username'] = 'Guest';
        $_SESSION['isAdmin'] = 0;
        $_SESSION['isLogin'] = 1;
        $_SESSION['playAsGuest'] = 0;
        $_SESSION['date'] = date("Y-m-d");
        header("location: homePage.php");
    }
    mysqli_close($conn);
?>