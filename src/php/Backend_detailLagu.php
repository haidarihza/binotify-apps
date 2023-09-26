<?php

function getSong($song_id){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $sql = 'SELECT * FROM song WHERE song_id = ' . $song_id;
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $song = $data;
        }
    }
    return $song;
}

function getLastIDSong(){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase); 
    $sql = 'SELECT song_id FROM song ORDER BY song_id DESC LIMIT 1';
    return $conn->query($sql)->fetch_object()->song_id;
}

function isExist($song_id){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $sql = 'SELECT * FROM song WHERE song_id = ' . $song_id;
    if ($result = $conn->query($sql)) {
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
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
?>