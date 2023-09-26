<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavbarAdmin</title>
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
            <li><a class="active"><?php echo $_SESSION['username'] ?></a></li>
            <li><a class="deactive" href="./login.php">Logout</a></li>
            <li><a class="deactive" href='./daftarUser.php'>Daftar User</a></li>
            <li><a class="deactive" href='./daftarAlbum.php'>Album</a></li>
            <li><a class="deactive" href='./tambahAlbum.php'>Tambah Album</a></li>
            <li><a class="deactive" href='./tambahLagu.php'>Tambah Lagu</a></li>
            <li class="titl"><a  class="title"  href="./homePage.php">Binotify</a></li>
        </ul>
    </div>
</body>

</html>