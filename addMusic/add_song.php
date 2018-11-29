<?php
if (!session_start()) {
    header("Location: ../error.php");
    exit;
}

$loggedIn = empty($_SESSION['loggedIn']) ? false : $_SESSION['loggedIn'];
if(!$loggedIn) {
    header("Location: ../index.php");
    exit;
}

$action = empty($_POST['action']) ? '' : $_POST['action'];
if($action == 'add_song') {
    add_song();
}
else {
    $error = '';
    require "song_form.php";
    exit;
}

function add_song() {
    $title = empty($_POST['title']) ? '' : $_POST['title'];
    if($title == '') {
        $error = "Error: Please enter the song's title.";
        require "song_form.php";
        exit;
    }
    $artist = empty($_POST['artist']) ? '' : $_POST['artist'];
    if($artist == '') {
        $error = "Error: Please enter the song's artist.";
        require "song_form.php";
        exit;
    }    
    $mysqli = new mysqli('localhost', 'stnd', 'zeta1907', 'songapp');
    if ($mysqli->connect_error) {
       $error = 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
       require "song_form.php";
        exit;
    }
    $query = "SELECT title FROM songs WHERE title='$title'";
    $mysqlResult = $mysqli->query($query);
    if($mysqlResult) {
        $match = $mysqlResult->num_rows;
        if($match == 1) {
            $error = 'Error: that song is already added.';
            require "song_form.php";
            exit;
        }
    }
    $genre = empty($_POST['genre']) ? '' : $_POST['genre'];
    $decade = empty($_POST['decade']) ? '' : $_POST['decade'];
    $category = empty($_POST['category']) ? '' : $_POST['category'];
    $addedBy = $_SESSION['username']; # session variable set to username upon login
    $music_target_dir = "music/";
    $music_file_path = $music_target_dir . basename($_FILES['musicFile']['name']);
    $music_type = pathinfo($music_file_path, PATHINFO_EXTENSION);
    $file_dest = "/var/www/html/" . $music_file_path;
    if($music_type != "mp3") {
        $error = 'Error: song file MUST be a .mp3 file.';
        require "song_form.php";
        exit;
    }
    if(file_exists($music_file_path)) {
        $error = 'Error: song file already exists on the server.';
        require "song_form.php";
        exit;
    }
    if($_FILES['imageFile']['error'] == 4) {
        $isImage = false;
    }
    else {
        $isImage = true;
    }
    $image_file_path = 'images/songs/default.png'; // default file path for image
    if ($isImage) {
        $image_target_dir = "images/songs/";
        $image_file_path = $image_target_dir . basename($_FILES['imageFile']['name']);
        $image_type = pathinfo($image_file_path, PATHINFO_EXTENSION);
        if($image_type != 'png' && $image_type != 'jpg' && $image_type != 'PNG') {
            $error = 'Error: image file MUST be a .png or .jpg file.';
            require "song_form.php";
            exit;
        }
        if(file_exists($image_file_path)) {
            $isImage = false; # if image is already on the server, just use it and
            # don't bother with overwriting it.
        }
    }
    if(!move_uploaded_file($_FILES['musicFile']['tmp_name'], $file_dest)) {
        
        $error = "Error: unable to upload music file. " . $_FILES['musicFile']['tmp_name'] . $file_dest;
        require "song_form.php";
        exit;
    }
    if ($isImage) {
        if(!move_uploaded_file($_FILES['imageFile']['tmp_name'], '../' . $image_file_path)) {
            $error = "Error: unable to upload image file.\n";
            require "song_form.php";
            exit;
        }
    }
        
    $title = $mysqli->real_escape_string($title);
    $artist = $mysqli->real_escape_string($artist);
    $genre = $mysqli->real_escape_string($genre);
    $category = $mysqli->real_escape_string($category);
    $addedBy = $mysqli->real_escape_string($addedBy);
    $query = "INSERT INTO songs (title, artist, genre, decade, category, addedBy, 
    filepath, imagepath, addDate) values ('$title', '$artist', '$genre', '$decade', '$category',
    '$addedBy', '$music_file_path', '$image_file_path', now());";
    if(!$mysqli->query($query)) {
        $error = 'System error: please contact the system administrator.';
        require "song_form.php";
        exit;
    }
    else {
        $mysqli->close();
        header("Location: ../index.php");
        exit;
    }
   
}


?>