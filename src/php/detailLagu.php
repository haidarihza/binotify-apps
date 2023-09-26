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
    include 'Backend_detailLagu.php';
    $song_id = $_GET['lagu'];
    $song = getSong($song_id);
    $albums = getAllAlbum();
    $lastIDSong = getLastIDSong();
    $random_next = rand(1, $lastIDSong);
    while (!isExist($random_next) || $random_next == $song_id) {
        $random_next = rand(1, $lastIDSong);
    }
    $random_prev = rand(1, $lastIDSong);
    while (!isExist($random_prev) || $random_prev == $song_id) {
        $random_prev = rand(1, $lastIDSong);
    }
    $info_album = getAlbum($song->album_id);
    echo "<title>$song->judul</title>";
    ?>
    <link rel="stylesheet" href="../resources/css/detailLagu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap');
    </style>
</head>

<?php $_SESSION['isAdmin'] == 1 ? require_once('navbarAdmin.php') : require_once('navbar.php') ?>

<body>
    <div id ="header-alert" class="alert" style="display:none">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        Please login to play more song.
    </div>

    <div class="container-judul">
        <div class="grid-item-1">
            <?php
                echo "<img class='' src='$song->image_path' height='250' alt=''>";
            ?>
        </div>
        <div class="grid-item-2">
            <h1 class="Judul">
                <?php echo $song->judul?>
            </h1>
            <h2 class="Penyanyi">
                <?php echo $song->penyanyi . '. ' . $song->tanggal_terbit . '. ' . $song->genre?>
            </h2>
            <h2 class="Penyanyi">
                <?php echo floor($song->duration/60) . ' min ' . ($song->duration%60) . ' sec'?>
            </h2>
            <h2 class="Penyanyi">
                Dari album : <?php echo '<a href=detailAlbum.php?album=' . $song->album_id . '>' . $info_album->judul . '</a>'?>
            </h2>
        </div>
    </div>
    <div class="player">
        <div class="buttons">
            <div class="prev-track" onclick="prevTrack()"><a href="detailLagu.php?lagu=<?= $random_next; ?>"><img class ="prev" src="assets/prev.png"></a></div>
            <div class="playpause-track" onclick="playpauseTrack()"><img class="play" src="assets/play.png" height="50" alt=""></div>
            <div class="next-track" onclick="nextTrack()"><a href="detailLagu.php?lagu=<?= $random_prev; ?>"><img class ="next" src="assets/next.png"></a></div>
        </div>
        <div class="slider_container">
            <input type="range" min="1" max="100" value="0" class="seek_slider" onchange="seekTo()">
            <div class="current-time">00:00</div>
        </div>
        <div class="slider_container">
            <input type="range" min="1" max="100" value="99" class="volume_slider" onchange="setVolume()">
            <p> </p>
            <img class ="vol-up" src="assets/volume_up.png" height="20" alt="">
        </div>
    </div>


    <div class="form-center" style="<?php echo ($_SESSION['isAdmin'] == 1) ? 'display:block' : 'display:none'; ?>">
        <h3>Edit</h3>
        <form action="Backend_Tambah.php" method="post" enctype="multipart/form-data" name="editLaguForm">
            <input type="text" id="judul" name="judul" placeholder="Judul"><br>
            <input type="text" id="penyanyi" name="penyanyi" placeholder="Penyanyi"><br>
            <input type="text" id="tanggal-terbit" name="tanggal-terbit" placeholder="Tanggal Terbit"><br>
            <p class=warning>Format: YYYY-MM-DD. Example: 2021-11-28</p>
            <input type="text" id="genre" name="genre" placeholder="Genre"><br>
            <select class="select" id="album" name="album">
                <option value="" disabled selected hidden>Pilih Album</option>
                <?php foreach ($albums as $album) : ?>
                    <option value='<?php echo $album->album_id ?>'> <?php echo $album->judul ?></option>
                <?php endforeach; ?>
            </select><br>
            <h3>Upload Image</h3>
            <input type="file" id="image" name="image" accept="image/*"><br>
            <input type="text" name="song_id" id="song_id" style="display:none" value="<?php echo $song_id; ?>">
            <button type="submit" class = "save-btn" name="action" value="editLagu">Save</button>        
        </form>
        <form action="Backend_Tambah.php" method="post" enctype="multipart/form-data" name="deleteForm">
            <h3>Delete</h3>
            <input type="text" name="song_id" id="song_id" style="display:none" value="<?php echo $song_id; ?>">
            <button type="submit" id="delete-btn" class = "delete-btn" name="action" value="deleteLagu">Delete</button>                               
        </form>
        <script type=text/javascript>
            function submitForm() {
                var fd = new FormData(document.forms["editLaguForm"]);
                fd.append("action", "editLagu");
                fd.append("songId", <?php echo $song_id; ?>);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'Backend_Tambah.php', true);
                console.log(fd);
                xhr.send(fd);
                console.log(<?php echo $song_id; ?>)
                alert("masuk")
            }

            delBtn = document.getElementById("delete-btn");
            delBtn.addEventListener("click", function() {
                var fd = new FormData(document.forms["deleteForm"]);
                fd.append("action", "deleteLagu");
                fd.append("songId", <?php echo $song_id; ?>);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'Backend_Tambah.php', true);
                console.log(fd);
                xhr.send(fd);
                console.log(<?php echo $song_id; ?>)
            })

            let playpause_btn = document.querySelector(".playpause-track");
            let next_btn = document.querySelector(".next-track");
            let prev_btn = document.querySelector(".prev-track");

            let seek_slider = document.querySelector(".seek_slider");
            let volume_slider = document.querySelector(".volume_slider");
            let curr_time = document.querySelector(".current-time");

            let track_index = 0;
            let isPlaying = false;
            let updateTimer;

            var alert_guest = document.getElementById('header-alert');
            // Create new audio element
            let curr_track = document.createElement('audio');

            function loadTrack(audio_path) {
                clearInterval(updateTimer);
                resetValues();

                // Load a new track
                curr_track.src =  audio_path;
                console.log(curr_track.src);
                curr_track.load();

                // Set an interval of 1000 milliseconds for updating the seek slider
                updateTimer = setInterval(seekUpdate, 1000);
            }

            // Reset Values
            function resetValues() {
                curr_time.textContent = "00:00";
                seek_slider.value = 0;
            }

            function playpauseTrack() {
                if (!isPlaying) playTrack();
                else pauseTrack();
                <?php
                if ($_SESSION['username'] == 'Guest') {
                    if (!isset($_SESSION['prev_song_id'])){
                        $_SESSION['prev_song_id'] = $song_id;
                        $_SESSION['playAsGuest'] += 1;
                    }
                    else{
                        if ($_SESSION['prev_song_id'] != $song_id){
                            $_SESSION['prev_song_id'] = $song_id;
                            $_SESSION['playAsGuest'] += 1;
                        }
                    }
                }
                ?>
            }

            function playTrack() {
                curr_track.play();
                isPlaying = true;
                // Replace icon with the pause icon
                playpause_btn.innerHTML = '<img class="play" src="assets/pause.png" height="50" alt="">';
            }

            function pauseTrack() {
                curr_track.pause();
                isPlaying = false;

                // Replace icon with the play icon
                playpause_btn.innerHTML = '<img class="play" src="assets/play.png" height="50" alt="">';
            }

            function seekTo() {
                seekto = curr_track.duration * (seek_slider.value / 100);
                curr_track.currentTime = seekto;
            }

            function setVolume() {
                curr_track.volume = volume_slider.value / 100;
            }

            function seekUpdate() {
                let seekPosition = 0;

                // Check if the current track duration is a legible number
                if (!isNaN(curr_track.duration)) {
                    seekPosition = curr_track.currentTime * (100 / curr_track.duration);
                    seek_slider.value = seekPosition;

                    // Calculate the time left and the total duration
                    let currentMinutes = Math.floor(curr_track.currentTime / 60);
                    let currentSeconds = Math.floor(curr_track.currentTime - currentMinutes * 60);
                    let durationMinutes = Math.floor(curr_track.duration / 60);
                    let durationSeconds = Math.floor(curr_track.duration - durationMinutes * 60);

                    // Adding a zero to the single digit time values
                    if (currentSeconds < 10) { currentSeconds = "0" + currentSeconds; }
                    if (durationSeconds < 10) { durationSeconds = "0" + durationSeconds; }
                    if (currentMinutes < 10) { currentMinutes = "0" + currentMinutes; }
                    if (durationMinutes < 10) { durationMinutes = "0" + durationMinutes; }

                    curr_time.textContent = currentMinutes + ":" + currentSeconds;
                }
            }
            <?php
            if ($_SESSION['username'] == 'Guest'){
                if ($_SESSION['playAsGuest'] > 3){
                    echo "loadTrack('');";
                    echo "alert_guest.style.display = 'block';";
                }
                else{
                    echo "loadTrack('$song->audio_path');";
                }
            }
            else{
                echo "loadTrack('$song->audio_path');";
            }
            ?>
        </script>
    </div>

</body>

</html>