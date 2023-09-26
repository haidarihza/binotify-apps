<?php 

$host = 'db';
$user = 'MYSQL_USER';
$pass = 'MYSQL_PASSWORD';
$mydatabase = 'binotify';
$conn = new mysqli($host, $user, $pass, $mydatabase);

function getAlluser($start, $limit){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);    
    $sql = "SELECT name, username, email FROM user LIMIT $start, $limit";
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $users[] = $data;
        }
    }
    return $users;
}

function getNumberData(){
    $host = 'db';
    $user = 'MYSQL_USER';
    $pass = 'MYSQL_PASSWORD';
    $mydatabase = 'binotify';
    $conn = new mysqli($host, $user, $pass, $mydatabase);    
    $sql = "SELECT * FROM user";
    return $conn->query($sql)->num_rows;
}


?>