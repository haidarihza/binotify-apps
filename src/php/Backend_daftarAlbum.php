<?php



$host = 'db';
$user = 'MYSQL_USER';
$pass = 'MYSQL_PASSWORD';
$mydatabase = 'binotify';
$conn = new mysqli($host, $user, $pass, $mydatabase);




function getAllAlbum(){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $sql = 'SELECT * FROM album';
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $albums[] = $data;
        }
    }
    return $albums;
}

function getAlbum($album_id){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $sql = 'SELECT * FROM album WHERE album_id = '.$album_id;
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $album = $data;
        }
    }
    return $album;
}

function getsong($album_id){
    // get song from database by album 
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $sql = "SELECT * FROM song WHERE album_id = $album_id";
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $songs[] = $data;
        }
    }
    return $songs;
}
?>