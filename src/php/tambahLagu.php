<?php session_start();
 if ($_SESSION ['isLogin'] != 1){
    header ("location: login.php");
 }
if ($_SESSION['isAdmin'] == 0) {
    header("Location: homePage.php");
}
include 'Backend_detailLagu.php';
$albums = getAllAlbum();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/tambahLagu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;900&display=swap');
    </style>
    <title>Tambah Lagu</title>
</head>
<?php require_once('./navbarAdmin.php'); ?>

<body>
    <div class="form-center">
        <form enctype="multipart/form-data" method="POST" name="laguForm" id="laguForm" onsubmit="dur(); return false;">
            <input type="text" id="judul" name="judul" placeholder="Judul"><br>
            <input type="text" id="penyanyi" name="penyanyi" placeholder="Penyanyi"><br>
            <input type="date" id="tanggal" name="tanggal" placeholder="Tanggal Terbit"><br>
            <input type="text" id="genre" name="genre" placeholder="Genre"><br>
            <select class="select" id="album" name="album">
                <option value="" disabled selected hidden>Pilih Album</option>
                <?php foreach ($albums as $album) : ?>
                    <option value='<?php echo $album->album_id ?>'> <?php echo $album->judul ?></option>
                <?php endforeach; ?>
            </select><br>
            <h3>Upload Image</h3>
            <input type="file" id="image" name="image" accept="image/*"><br>
            <h3>Upload Song</h3>
            <input type="file" id="audio" name="audio" accept="audio/mp3"><br>
            <input type="text" name="duration" id="duration" style="display:none">
            <button type="submit" name="action" value="addLagu">Add Song</button>
        </form>
    </div>
    <script>
        // submit form

        async function getDuration(file) {
            const url = URL.createObjectURL(file);

            return new Promise((resolve) => {
                const audio = document.createElement("audio");
                audio.muted = true;
                const source = document.createElement("source");
                source.src = url; //--> blob URL
                audio.preload = "metadata";
                audio.appendChild(source);
                audio.onloadedmetadata = function() {
                    resolve(audio.duration)
                };
            });
        }

        async function dur() {
            var song = document.getElementById("audio").files[0];
            var duration = document.getElementById('duration');
            var songdur = await getDuration(song);
            duration.value = songdur;

            // post using xmlhttprequest:
            var fd = new FormData(document.forms["laguForm"]);
            fd.append("duration", duration.value);
            fd.append("action", "addLagu");

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "Backend_Tambah.php", true);

            xhr.send(fd);
            document.getElementById("laguForm").reset();
        }
    </script>
</body>
<?php require_once('./footer.php'); ?>

</html>