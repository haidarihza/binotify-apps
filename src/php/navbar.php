<?php
require 'Backend_searchLagu.php';
session_start();

if (isset($_GET["search_button"])) {
    $_SESSION['search'] = $_GET['search'];
    $lagu = search_song($_SESSION["search"]);
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="../resources/css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;900&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;900&display=swap');
    </style>
</head>

<body>
    <div class="navbar">
        <ul>
            <?php
            $result = "";
            if ($_SESSION['username'] == "Guest"){
                $result = "Please Log in";
            } else{
                $result = "Log Out";
            }?>
            <li><a class="active"><?php echo $_SESSION['username'] ?></a></li>
            <li><a class="deactive" href="./logout.php"> <?php echo $result ?></a></li>
            <li><a class="deactive" href='./daftarAlbum.php'>Album</a></li>

            <li class="titl"><a class="title" href="./homePage.php">Binotify</a></li>
            <form action='./searchPage.php' method="get">
                <li class='form-search'><input type="text" id="search" name="search" placeholder="What do you want to listen"><br></li>
                <li class='form-search'><input type="submit" class="search_2" name="search_button" value="Search"></li>
            </form>
        </ul>

    </div>
</body>

</html>