<?php session_start();
 if ($_SESSION ['isLogin'] != 1){
    header ("location: login.php");
 }
 if ($_SESSION['username'] == 'Guest'){
    if ($_SESSION['date'] != date("Y-m-d")){
        $_SESSION['playAsGuest'] = 0;
        $_SESSION['date'] = date("Y-m-d");
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../resources/css/homePage.css">
    <link rel="stylesheet" href="../resources/css/navbar.css">
    <link rel="stylesheet" href="../resources/css/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap');
    </style>
</head>

<?php $_SESSION['isAdmin'] == 1 ? require_once('navbarAdmin.php') : require_once('navbar.php')?>

<body>
    <h1>Daftar Lagu</h1>
    <table>
        <tr>
            <th class="table-number">#</th>
            <th>Judul</th>
            <th>Penyanyi</th>
            <th>Tahun Terbit</th>
            <th>Genre</th>
        </tr>
        <?php
        include_once 'Backend_daftarLagu.php';
        $songs = getAllSong();
        $i = 1;
        foreach ($songs as $song) {
            echo "<tr>";
            echo "<td class='table-number'>$i</td>";
            echo '<td><img src=" ' . $song->image_path . ' " alt="gambar" height=45></img> <a href="detailLagu.php?lagu=' . $song->song_id . '">&nbsp &nbsp' . $song->judul . '</a></td>';
            echo "<td>$song->penyanyi</td>";
            $year = date('Y', strtotime($song->tanggal_terbit));
            echo "<td> $year </td>";
            echo "<td>$song->genre</td>";
            echo "</tr>";
            $i++;
        }
        ?>
    </table>
</body>
<?php require_once('./footer.php'); ?>

</html>