<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $action2 = $_REQUEST['action'];
    if ($action == 'addAlbum') {
        $judul = $_POST['judul'];
        $penyanyi = $_POST['penyanyi'];
        $tanggal_terbit = $_POST['tanggal'];
        $genre = $_POST['genre'];
        $filename = $_FILES['file']['name'];
        $location = "../assets/images/" . $filename;
        move_uploaded_file($_FILES['file']['tmp_name'], $location);
        $path = "../assets/images/" . $filename;
        $host = 'db';
        $user = 'MYSQL_USER';
        $pass = 'MYSQL_PASSWORD';
        $mydatabase = 'binotify';
        $conn = new mysqli($host, $user, $pass, $mydatabase);
        $sql = "INSERT INTO album (judul, penyanyi, total_duration , tanggal_terbit, genre, image_path) VALUES ('$judul', '$penyanyi', 0, '$tanggal_terbit', '$genre', '$path')";
        if ($conn->query($sql) === TRUE) {
            header("Location: tambahAlbum.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    } else if ($action2 == 'addLagu') {
        $judul = $_POST['judul'];
        $penyanyi = $_POST['penyanyi'];
        $tanggal_terbit = $_POST['tanggal'];
        $genre = $_POST['genre'];
        $album_id = $_POST['album'];
        $duration = $_POST['duration'];

        $imagefilename = $_FILES['image']['name'];
        $imagelocation = "../assets/images/" . $imagefilename;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagelocation);
        $imagepath = "../assets/images/" . $imagefilename;

        $audiofilename = $_FILES['audio']['name'];
        $audiolocation = "../assets/audio/" . $audiofilename;
        move_uploaded_file($_FILES['audio']['tmp_name'], $audiolocation);
        $audiopath = "../assets/audio/" . $audiofilename;

        $host = 'db';
        $user = 'MYSQL_USER';
        $pass = 'MYSQL_PASSWORD';
        $mydatabase = 'binotify';
        $conn = new mysqli($host, $user, $pass, $mydatabase);

        $sql = "INSERT INTO song (judul, penyanyi, duration, tanggal_terbit, genre, album_id, image_path, audio_path) VALUES ('$judul', '$penyanyi', '$duration', '$tanggal_terbit', '$genre', '$album_id','$imagepath', '$audiopath')";
        if ($conn->query($sql) === TRUE) {
            header("Location: tambahLagu.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // add song duration to total duration
        $sql = "SELECT * FROM  song WHERE album_id  = '$album_id' ";
        $result = $conn->query($sql);
        $total_duration = 0;
        while ($row = $result->fetch_assoc()) {
            $total_duration += $row['duration'];
        }

        $sql = "UPDATE album SET total_duration = '$total_duration' WHERE album_id = '$album_id'";
        if ($conn->query($sql) === TRUE) {
            header("Location: tambahLagu.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else if ($action == 'editAlbum') {
        $judul = $_POST['judul'];
        $penyanyi = $_POST['penyanyi'];
        $album_id = $_POST['album_id'];

        $imagefilename = $_FILES['image']['name'];
        $imagelocation = "../assets/images/" . $imagefilename;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagelocation);
        $imagepath = "../assets/images/" . $imagefilename;

        $host = 'db';
        $user = 'MYSQL_USER';
        $pass = 'MYSQL_PASSWORD';
        $mydatabase = 'binotify';
        $conn = new mysqli($host, $user, $pass, $mydatabase);
        $sql = "UPDATE album SET ";
        if ($judul != "") {
            $sql .= "judul = '$judul', ";
        }
        if ($penyanyi != "") {
            $sql .= "penyanyi = '$penyanyi', ";
        }
        if ($imagefilename != "") {
            $sql .= "image_path = '$imagepath', ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= " WHERE album_id = '$album_id'";
        if ($conn->query($sql) === TRUE) {
            header("Location: detailAlbum.php?album=" . $album_id);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    } else if ($action == 'editLagu') {
        $judul = $_POST['judul'];
        $penyanyi = $_POST['penyanyi'];
        $tanggal_terbit = $_POST['tanggal-terbit'];
        $genre = $_POST['genre'];
        $album = $_POST['album'];        
        $song_id = $_POST['song_id'];

        $imagefilename = $_FILES['image']['name'];
        $imagelocation = "../assets/images/" . $imagefilename;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagelocation);
        $imagepath = "../assets/images/" . $imagefilename;

        $host = 'db';
        $user = 'MYSQL_USER';
        $pass = 'MYSQL_PASSWORD';
        $mydatabase = 'binotify';
        $conn = new mysqli($host, $user, $pass, $mydatabase);
        $sql = "UPDATE song SET ";
        if ($judul != "") {
            $sql = $sql . "judul = '$judul', ";
        }
        if ($penyanyi != "") {
            $sql = $sql . "penyanyi = '$penyanyi', ";
        }
        if ($tanggal_terbit != "") {
            $sql = $sql . "tanggal_terbit = '$tanggal_terbit', ";
        }
        if ($genre != "") {
            $sql = $sql . "genre = '$genre', ";
        }
        if ($album != "") {
            $sql = $sql . "album_id = '$album', ";
        }
        if ($imagefilename != "") {
            $sql = $sql . "image_path = '$imagepath', ";
        }
        $sql = substr($sql, 0, -2);
        $sql = $sql . " WHERE song_id = '$song_id'";
        if ($conn->query($sql) === TRUE) {
            header("Location: detailLagu.php?lagu=" . $song_id);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    } else if ($action == 'deleteLagu') {
        $host = 'db';
        $user = 'MYSQL_USER';
        $pass = 'MYSQL_PASSWORD';
        $mydatabase = 'binotify';
        $conn = new mysqli($host, $user, $pass, $mydatabase);
        $song_id = $_POST['song_id'];
        $sql = 'SELECT * FROM song WHERE song_id = ' . $song_id;
        if ($result = $conn->query($sql)) {
            while ($data = $result->fetch_object()) {
                $song = $data;
            }
        }
        $album_id = $song->album_id;
        $duration = $song->duration;
        //update duration
        $sql = 'UPDATE album SET total_duration = total_duration - ' . $duration . ' WHERE album_id = ' . $album_id;
        $conn->query($sql);
        //delete image and audio
        $sql = "DELETE FROM song WHERE song_id = '$song_id'";
        if ($conn->query($sql) === TRUE) {
            header("Location: homePage.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
} else {
    echo "Method is not POST";
}
