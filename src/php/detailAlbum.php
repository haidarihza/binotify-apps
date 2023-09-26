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
    <?php
    include 'Backend_daftarAlbum.php';
    $album_id = $_GET['album'];
    $album = getAlbum($album_id);
    $songs = getsong($album_id);
    $i = 1;
    echo "<title>$album->judul</title>";
    ?>
    <link rel="stylesheet" href="../resources/css/detailAlbum.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;900&display=swap');
    </style>
</head>

<?php $_SESSION['isAdmin'] == 1 ? require_once('navbarAdmin.php') : require_once('navbar.php') ?>

<body>
    <div class="container-judul">
        <div class="grid-item-1">
            <?php
            echo "<img class='' src='$album->image_path' height='250' alt=''>";
            ?>
        </div>
        <div class="grid-item-2">
            <?php
            echo "<h1 class='Judul'>$album->judul</h1>";
            echo "<h2 class='Penyanyi'>$album->penyanyi</h2>";
            // change second to minute and second
            $duration = $album->total_duration;
            $minute = $duration / 60;
            $minute = floor($minute);
            $second = $duration % 60;

            echo "<h2 class='Penyanyi'>$minute min $second sec </h2>";
            ?>
        </div>
    </div>
    <div class="list-album">
        <table>
            <tr>
                <th class="table-number">#</th>
                <th>Judul Album</th>
            </tr>
            <?php
            if ($songs != null) {
                foreach ($songs as $song) {
                    echo "<tr>";
                    echo "<td class='table-number'>$i</td>";
                    echo '<td><img src=" ' . $album->image_path . ' " alt="gambar" height=45></img> <a href="detailLagu.php?lagu='.$song->song_id.'  "> ' . $song->judul . ' </a></td>';
                    echo "</tr>";
                    $i++;
                }
            }
            ?>

        </table>
    </div>
    <div class="form-center" style="<?php echo ($_SESSION['isAdmin'] == 1) ? 'display:block' : 'display:none'; ?>">
        <h3>Edit</h3>
        <form action="Backend_Tambah.php" method="POST" enctype="multipart/form-data" name="editAlbumForm">
            <input type="text" id="judul" name="judul" placeholder="Judul"><br>
            <input type="text" id="penyanyi" name="penyanyi" placeholder="Penyanyi"><br>
            <h3>Upload Image</h3>
            <input type="file" id="image" name="image" accept="image/*"><br>
            <input type="text" name="album_id" id="album_id" style="display:none" value="<?php echo $album_id; ?>">
            <button type="submit" name="action" value="editAlbum">Save</button>
        </form>
        <script>
            function submitForm() {
                var fd = new FormData(document.forms["editAlbumForm"]);
                fd.append("action", "editALbum");
                fd.append("albumId", <?php echo $album_id; ?>);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'Backend_Tambah.php', true);
                console.log(fd);
                xhr.send(fd);
                console.log(<?php echo $album_id; ?>)
                alert("masuk")
            }
        </script>
    </div>

</body>
<?php require_once('./footer.php'); ?>

</html>