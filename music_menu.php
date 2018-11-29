<?php
    function findByValue($what, $value) {
        $mysqli = new mysqli('localhost', 'stnd', 'zeta1907', 'songapp');
        if($mysqli->connect_error) {
            header("Location: error.php");
            exit;
        }
        $query = "select * from songs where $what='$value' order by title;";
        $result = $mysqli->query($query);
        if($result) { 
            while($song = $result->fetch_assoc()) {
                if($song[$what] == $value) {
                    
                    $filePath = $song['filepath'];
                    $imagePath = $song['imagepath'];
                    $title = $song['title'];
                     print '<li><div class="song" onClick="playSong(this, ';
                    print "'$filePath', '$imagePath')";
                    print '")>';
                    print "$title</div></li>";
                    
                }
            }
            $mysqli->close();
        }
        else {
            header("Location: error.php");
            exit;
        }
    }
    function findArtists() {
       $mysqli = new mysqli('localhost', 'stnd', 'zeta1907', 'songapp');
        if($mysqli->connect_error) {
            header("Location: error.php");
            exit;
        }
        $query = "select artist from songs order by artist;";
        $result = $mysqli->query($query);
        if($result) { 
            while($song = $result->fetch_assoc()) {
                $artist = $song['artist'];
                print "<li><div>$artist</div>";
                print "<ul>";
                findByValue("artist", "$artist");
                print "</ul></li>";
            }
            $mysqli->close();
        }
        else {
            header("Location: error.php");
            exit;
        } 
    }

    function getAllSongs() {
       $mysqli = new mysqli('localhost', 'stnd', 'zeta1907', 'songapp');
        if($mysqli->connect_error) {
            header("Location: error.php");
            exit;
        }
        $query = "select * from songs order by title;";
        $result = $mysqli->query($query);
        if($result) { 
            while($song = $result->fetch_assoc()) {
                $filePath = $song['filepath'];
                $imagePath = $song['imagepath'];
                $title = $song['title'];
                print '<li><div class="song" onClick="playSong(this, ';
                print "'$filePath', '$imagePath')";
                print '")>';
                print "$title</div></li>";
            $mysqli->close();
            }
        }
        else {
            header("Location: error.php");
            exit;
        } 
    }

?>



<ul id='musicMenu'>
    <li><div>Genres</div>
        <ul>
    <li><div>Rock</div>
            <ul>
        <?php findByValue("genre", "Rock"); ?>
        </ul></li>
    <li><div>Pop</div>
            <ul>
        <?php findByValue("genre", "Pop"); ?>
        </ul></li>
    <li><div>Jazz</div>
            <ul>
        <?php findByValue("genre", "Jazz"); ?>
        </ul></li>
    <li><div>Classical</div>
            <ul>
        <?php findByValue("genre", "Classical"); ?>
        </ul></li>
    <li><div>LoFi/Vaporwave</div>
            <ul>
        <?php findByValue("genre", "LoFi/Vaporwave"); ?>
        </ul></li>
    <li><div>Blues</div>
            <ul>
        <?php findByValue("genre", "Blues"); ?>
        </ul></li>
    <li><div>Rap</div>
            <ul>
        <?php findByValue("genre", "Rap"); ?>
        </ul></li>
    <li><div>R&B</div>
            <ul>
        <?php findByValue("genre", "R&B"); ?>
        </ul></li>
    <li><div>Funk</div>
            <ul>
        <?php findByValue("genre", "Funk"); ?>
        </ul></li>
    <li><div>Reggae</div>
        <ul>
        <?php findByValue("genre", "Reggae"); ?>
        </ul></li>
    <li><div>Metal</div>
            <ul>
        <?php findByValue("genre", "Metal"); ?>
        </ul></li>
    <li><div>Country</div>
            <ul>
        <?php findByValue("genre", "Country"); ?>
        </ul></li>
    <li><div>Film</div>
            <ul>
        <?php findByValue("genre", "Film"); ?>
        </ul></li>
    <li><div>Gaming</div>
            <ul>
        <?php findByValue("genre", "Gaming"); ?>
        </ul></li>
    <li><div>Other</div><ul>
        <?php findByValue("genre", "Other"); ?>
        </ul></li>
        </ul>
    
    </li>

    <li><div>Decades</div>
        <ul>
    <li><div>2010s</div>
            <ul>
        <?php findByValue("decade", "2010s"); ?>
        </ul></li>
    <li><div>2000s</div>
            <ul>
        <?php findByValue("decade", "2000s"); ?>
        </ul></li>
    <li><div>1990s</div>
            <ul>
        <?php findByValue("decade", "1990s"); ?>
        </ul></li>
    <li><div>1980s</div>
            <ul>
        <?php findByValue("decade", "1980s"); ?>
        </ul></li>
    <li><div>1970s</div>
            <ul>
        <?php findByValue("decade", "1970s"); ?>
        </ul></li>
    <li><div>1960s</div>
            <ul>
        <?php findByValue("decade", "1960s"); ?>
        </ul></li>
    <li><div>1950s</div>
            <ul>
        <?php findByValue("decade", "1950s"); ?>
        </ul></li>
    <li><div>1900-1950</div>
            <ul>
        <?php findByValue("decade", "1900-1950"); ?>
        </ul></li>
    <li><div>1800-1900</div>
            <ul>
        <?php findByValue("decade", "1800-1900"); ?>
        </ul></li>
    <li><div>1700-1800</div>
            <ul>
        <?php findByValue("decade", "1700-1800"); ?>
        </ul></li>
    <li><div>1600-1700</div>
            <ul>
        <?php findByValue("decade", "1600-1700"); ?>
        </ul></li>
    <li><div>Before 1600</div>
            <ul>
        <?php findByValue("decade", "Before 1600"); ?>
        </ul></li>
        </ul>
</li>

    <li><div>Categories</div>
        <ul>
    <li><div>Popular</div>
            <ul>
        <?php findByValue("category", "Popular"); ?>
        </ul></li>
    <li><div>Fine Art</div>
            <ul>
        <?php findByValue("category", "Fine Art"); ?>
        </ul></li>
    <li><div>Folk</div>
            <ul>
        <?php findByValue("category", "Folk"); ?>
        </ul></li>
    <li><div>Meme</div>
            <ul>
        <?php findByValue("category", "Meme"); ?>
        </ul></li>
    <li><div>Media</div>
            <ul>
        <?php findByValue("category", "Media"); ?>
        </ul></li>
    <li><div>Other</div>
            <ul>
        <?php findByValue("category", "Other"); ?>
        </ul></li>
        </ul>

</li>
    <li><div>Artists</div>
    <ul>
        <?php findArtists(); ?>
        </ul>
    </li>
    <li><div>All Songs</div>
    <ul>
        <?php getAllSongs(); ?>
        </ul></li>
    </ul>
