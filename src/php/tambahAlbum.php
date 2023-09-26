<?php session_start();
 if ($_SESSION ['isLogin'] != 1){
    header ("location: login.php");
 }
if ($_SESSION['isAdmin'] == 0) {
    header("Location: homePage.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/tambahAlbum.css">
    <link rel="stylesheet" href="../resources/css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;900&display=swap');
    </style>
    <title>Tambah Album</title>
</head>
<?php require_once('./navbarAdmin.php'); ?>

<body>
    <div class="form-center">
        <form action="Backend_Tambah.php" enctype="multipart/form-data" method="POST">
            <input type="text" id="judul" name="judul" placeholder="Judul"><br>
            <input type="text" id="penyanyi" name="penyanyi" placeholder="Penyanyi"><br>
            <input type="date" id="tanggal" name="tanggal" placeholder="Tanggal Terbit"><br>
            <input type="text" id="genre" name="genre" placeholder="Genre"><br>
            <h3>Upload Image</h3>
            <input type="file" id="image" name="file" accept="image/*"><br>
            <button type="submit" name="action" value="addAlbum">Add Album</button>
        </form>
    </div>
</body>
<?php require_once('./footer.php'); ?>

</html>