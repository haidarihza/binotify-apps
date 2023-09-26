<?php session_start();
 if ($_SESSION ['isLogin'] != 1){
    header ("location: login.php");
 }?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Album</title>
    <link rel="stylesheet" href="../resources/css/daftarAlbum.css">
    <link rel="stylesheet" href="../resources/css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap');
    </style>
    <script src="/resources/test.js"></script>
</head>

<?php $_SESSION['isAdmin'] == 1 ? require_once('navbarAdmin.php') : require_once('navbar.php') ?>

<body>
    <h1>Daftar Album</h1>
    <table>
        <tr>
            <th class="table-number">#</th>
            <th>Judul Album</th>
            <th>Penyanyi</th>
            <th>Tahun Terbit</th>
            <th>Genre</th>
        </tr>
        <?php
        include 'Backend_daftarAlbum.php';
        $albums = getAllAlbum();
        $i = 1;
        foreach ($albums as $album) {
            echo "<tr>";
            echo "<td class='table-number'>$i</td>";
            echo '<td><img src=" ' . $album->image_path . ' " alt="gambar" height=45></img> <a href="detailAlbum.php?album=' . $album->album_id . ' ">' . $album->judul . '</a> </td>';
            echo "<td>$album->penyanyi</td>";
            echo "<td>$album->tanggal_terbit</td>";
            echo "<td>$album->genre</td>";
            echo "</tr>";
            $i++;
        }
        ?>

    </table>
</body>
<?php require_once('./footer.php'); ?>

</html>