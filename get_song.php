<?php
$title = empty($_GET['title']) ? '' : $_GET['title'];
$mysqli = new mysqli('localhost', 'stnd', 'zeta1907', 'songapp');
    if ($mysqli->connect_error) {
        header("error.php");
        exit;
    }
    $titleq = $mysqli->real_escape_string($title);
    $query = "SELECT * FROM songs WHERE title='$titleq'";
    $mysqlResult = $mysqli->query($query);
    if($mysqlResult) {
        $match = $mysqlResult->num_rows;
        if($match == 1) {
            $song = $mysqlResult->fetch_assoc();
            $artist = $song['artist'];
            $genre = $song['genre'];
            $decade = $song['decade'];
            $category = $song['category'];
            $user = $song['addedBy'];
            $date = $song['addDate'];
            print "<div class='title'>$title</div>
            <div class='info'>Artist: $artist</div>
            <div class='info'>Genre: $genre</div>
            <div class='info'>Decade: $decade</div>
            <div class='info'>Category: $category</div>
            <div class='info'>Added by $user on: $date</div>";
        }
    }
?>