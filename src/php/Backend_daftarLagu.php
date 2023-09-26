<?php

function getAllSong(){
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
    $sql = 'SELECT * FROM (SELECT * FROM song ORDER BY song_id DESC LIMIT 10)Var1 ORDER BY judul';
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $songs[] = $data;
        }
    }
    return $songs;
}
?>