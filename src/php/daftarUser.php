<?php session_start();
 if ($_SESSION ['isLogin'] != 1){
    header ("location: login.php");
 }
 if ($_SESSION['isAdmin'] == 0) {
    header("Location: homePage.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
    <link rel="stylesheet" href="../resources/css/daftarUser.css">
    <link rel="stylesheet" href="../resources/css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap');
    </style>
</head>

<?php require_once('./navbarAdmin.php'); ?>
<body>
    <h1>Daftar User</h1>
    <table>
        <tr>
            <th></th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
        <?php
        //15 adalah jumlah user per halaman
        include 'Backend_daftarUser.php';
        $data_number = getNumberData();
        $number_per_page = 15;
        $page_number = ceil($data_number / $number_per_page);
        if (isset($_GET['page'])) {
            $active_page = $_GET['page'];
        } else {
            $active_page = 1;
        }
        $users = getAlluser(($active_page - 1)*$number_per_page, $number_per_page);
        $i = 1;
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>$user->name</td>";
            echo "<td>$user->username</td>";
            echo "<td>$user->email</td>";
            echo "</tr>";
            $i++;
        }
        ?>
    </table>
    <div class="pagination">
        <?php if ($active_page > 1) : ?>
            <a href="daftarUser.php?page=<?= $active_page - 1; ?>">&laquo;</a>
        <?php else : ?>
            <a href="#">&laquo;</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $page_number; $i++) : ?>
            <?php if ($i == $active_page) : ?>
                <a class="activepage" href="daftarUser.php?page=<?= $i; ?>"><?= $i; ?></a>
            <?php else : ?>
                <a href="daftarUser.php?page=<?= $i; ?>"><?= $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($active_page < $page_number) : ?>
            <a href="daftarUser.php?page=<?= $active_page + 1; ?>">&raquo;</a>
        <?php else : ?>
            <a href="#">&raquo;</a>
        <?php endif; ?>
    </div>
</body>

</html>