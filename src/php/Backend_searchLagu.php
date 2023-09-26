<?php

$host = 'db';
// Database use name
$user = 'MYSQL_USER';
//database user password
$pass = 'MYSQL_PASSWORD';
// database name
$mydatabase = 'binotify';
// check the mysql connection status
$conn = new mysqli($host, $user, $pass, $mydatabase);
// select query

function search_song($search){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $sql = "SELECT * FROM song WHERE penyanyi LIKE '%$search%' or judul LIKE '%$search%'";
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $songs[] = $data;
        }
    }
    return $songs;
}

function search_song_genre($search, $genre){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $sql = "SELECT * FROM song WHERE (penyanyi LIKE '%$search%' or judul LIKE '%$search%') AND genre = '$genre'";
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $songs[] = $data;
        }
    }
    return $songs;
}

function search_song_title($search){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $sql = "SELECT * FROM song WHERE penyanyi LIKE '%$search%' or judul LIKE '%$search%' ORDER BY judul";
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $songs[] = $data;
        }
    }
    return $songs;
}

function search_song_year($search){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $sql = "SELECT * FROM song WHERE penyanyi LIKE '%$search%' or judul LIKE '%$search%' ORDER BY tanggal_terbit";
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $songs[] = $data;
        }
    }
    return $songs;
}

function search_song_title_genre($search, $genre){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $sql = "SELECT * FROM song WHERE genre = '$genre' AND (penyanyi LIKE '%$search%' or judul LIKE '%$search%') ORDER BY judul";
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $songs[] = $data;
        }
    }
    return $songs;
}

function search_song_year_genre($search, $genre){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $sql = "SELECT * FROM song WHERE genre = '$genre' AND (penyanyi LIKE '%$search%' or judul LIKE '%$search%') ORDER BY tanggal_terbit";
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $songs[] = $data;
        }
    }
    return $songs;
}


function getAllGenre(){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);
    $sql = "SELECT DISTINCT genre FROM song";
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $genres[] = $data;
        }
    }
    return $genres;
}
?>