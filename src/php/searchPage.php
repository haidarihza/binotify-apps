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
    <title>Search</title>
    <link rel="stylesheet" href="../resources/css/searchPage.css">
    <link rel="stylesheet" href="../resources/css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap');
    </style>
    <script src="/resources/test.js"></script>
</head>

<?php require('./navbar.php'); ?>
<body id="search2">
    <h1>Daftar Lagu</h1>
    <div class='search-result'>
        <?php include_once 'Backend_searchLagu.php';
        $searchInput = "";
        $searchInput = $_SESSION['search'];
        echo "<h3>Song Result for  '$searchInput'</h3>";?>
    </div>
    <div class='sort'>
        <h3>Sort By &nbsp</h3>
        <form action=''>
            <li class='form-search'><input type="submit" class="sort_button" name="judul_button" value="Judul"></li>
        </form>
        <form action=''>
            <li class='form-search'><input type="submit" class="sort_button" name="tahun_button" value="Tahun"></li>
        </form>
    </div>
    <div class='filter'>
        <h3>Filter By</h3>

            <?php 
            if ($_GET['filter_button'] == "All"){
                echo "<form action=''>
                <li class='form-search'><input type='submit' class='filter_button active_filter' name='filter_button' value='All';></li>
                </form>";
            } else {
                echo "<form action=''>
                <li class='form-search'><input type='submit' class='filter_button' name='filter_button' value='All';></li>
                </form>";
            }
            ?>
        
        <?php 
            include_once 'Backend_daftarLagu.php';
            $genres = getAllGenre();
            foreach ($genres as $genre) {
                if ($_GET['filter_button'] == $genre->genre){
                    echo "<form action=''>
                    <li class='form-search'><input type='submit' class='filter_button active_filter' name='filter_button' value='$genre->genre';></li>
                    </form>";
                } else {
                    echo "<form action=''>
                    <li class='form-search'><input type='submit' class='filter_button' name='filter_button' value='$genre->genre';></li>
                    </form>";
                }
            }
         ?>
    </div>
    <script>
            function setButton(value) {
                localStorage.setItem("buttonID", value);
            }
            if (localStorage.All) {
                document.getElementById(localStorage.All).style.backgroundColor = "RED";
            
    </script>

    <table>
        <tr>
            <th class="table-number">#</th>
            <th>Judul</th>
            <th>Penyanyi</th>
            <th>Tahun Terbit</th>
            <th>Genre</th>
        </tr>
        <?php 
            include_once 'Backend_searchLagu.php';
            $searchInput = $_SESSION['search'];
            $songs = search_song($searchInput);
            $i = 1;
            if(isset($_GET["filter_button"])) {
                $_SESSION['filter_button'] = $_GET["filter_button"];
            }
            if (isset($_GET["judul_button"])) {
                $_SESSION['sort_button'] = 'judul';
            };
            if (isset($_GET["tahun_button"])) {
                $_SESSION['sort_button'] = 'tahun';
            };
            if (isset($_GET["filter_button"])) {
                $_SESSION['filter_button'] = $_GET["filter_button"];
            };

            if(isset($_SESSION["filter_button"])) {
                $songs = search_song_genre($searchInput, $_SESSION['filter_button']);
            }
            if ($_SESSION["sort_button"] == 'judul') {
                if(isset($_SESSION["filter_button"])) {
                    if ($_SESSION["filter_button"] == 'All'){
                        $songs = search_song_title($searchInput);                      
                    } else {
                        $songs = search_song_title_genre($searchInput, $_SESSION['filter_button']);
                    }
                } else {
                    $songs = search_song_title($searchInput);
                }
            };
            if ($_SESSION["sort_button"] == 'tahun') {
                if(isset($_SESSION["filter_button"])) {
                    if ($_SESSION["filter_button"] == 'All'){
                        $songs = search_song_year($searchInput);                     
                    } else {
                        $songs = search_song_year_genre($searchInput, $_SESSION['filter_button']);
                    }
                } else {
                    $songs = search_song_year($searchInput);
                }
            };

            if (isset($songs)){
                $data_number = sizeof($songs);
            }
            $number_per_page = 5;
            $page_number = ceil($data_number / $number_per_page);
            if (isset($_GET['page'])) {
                $active_page = $_GET['page'];
            } else {
                $active_page = 1;
            }

            foreach ((array)$songs as $song) {
                if ($i>(($active_page-1)*$number_per_page) &&  $i<=(($active_page)*$number_per_page)){
                    echo "<tr>";
                    echo "<td class='table-number'>$i</td>";
                    echo '<td><img src=" '.$song->image_path.' " alt="gambar" height=45></img> &nbsp &nbsp <a href="detailLagu.php?lagu='.$song->song_id.'"> '. $song->judul .' </a></td>';
                    echo "<td>$song->penyanyi</td>";
                    $year = date('Y', strtotime($song->tanggal_terbit));
                    echo "<td> $year </td>";
                    echo "<td>$song->genre</td>";
                    echo "</tr>";
                }
                $i++;
            }
         ?>
    </table>
    <div class="pagination">
        <?php if ($active_page > 1) : ?>
            <a href="searchPage.php?page=<?= $active_page - 1; ?>">&laquo;</a>
        <?php else : ?>
            <a href="#">&laquo;</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $page_number; $i++) : ?>
            <?php if ($i == $active_page) : ?>
                <a class="activepage" href="searchPage.php?page=<?= $i; ?>"><?= $i; ?></a>
            <?php else : ?>
                <a href="searchPage.php?page=<?= $i; ?>"><?= $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($active_page < $page_number) : ?>
            <a href="searchPage.php?page=<?= $active_page + 1; ?>">&raquo;</a>
        <?php else : ?>
            <a href="#">&raquo;</a>
        <?php endif; ?>
    </div>
</body>
<?php require_once('./footer.php'); ?>

</html>