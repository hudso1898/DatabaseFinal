<?php
if(!session_start()) {
    header("Location: ../error.php");
    exit;
}
else {
    $loggedIn = empty($_SESSION['loggedIn']) ? false : $_SESSION['loggedIn'];
    if(!$loggedIn) {
        header("Location: ../index.php");
        exit;
    }
}

?>

<!-- Created by Matt Hudson -hudso- for CS2830 Fall '17 Final Project -->
<!DOCTYPE html>
<html>
<head>
	<title>Add Song - ΦΜΑ Music </title>
	<link href="../app.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="../jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script src="../jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
    <script src="../jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $("input[type=submit]").button();
            $("#genre").selectmenu();
            $("#decade").selectmenu();
            $("#category").selectmenu();
        });
    </script>
</head>
<body>
    <?php $fromRequired = true; require '../navigation.php'; ?>
    <div>
        <h1>Add Song</h1>
        <?php
            if ($error) {
                print "<div class='errorMessage'>$error</div>\n";
            }
        ?>
        
        <form action="add_song.php" method="post" enctype="multipart/form-data">
            
            <input type="hidden" name="action" value="add_song">
            
            <div class="textfield">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="ui-widget-content ui-corner-all textinput" autofocus value="<?php print $title; ?>">
            </div>
            <div class="textfield">
                <label for="artist">Artist:</label>
                <input type="text" id="artist" name="artist" class="ui-widget-content ui-corner-all textinput" value="<?php print $artist; ?>">
            </div>
            <?php $fromRequired = true; require "song_data.php" ?>
            <!-- while the accept attribute is used to help limit file types,
            add_song.php contains checking to make sure the file is
            of the right type. -->
            <div class="centered">
            <label for="musicFile">Music file (.mp3 files only):</label>
            <input type="file" id="musicFile" name="musicFile" accept=".mp3">
            </div>
            <div class="centered">
            <label for="imageFile">(optional) Image file (.png and .jpg):</label>
            <input type="file" id="imageFile" name="imageFile" accept=".png, .jpg">
            </div>
            <div class="submitButton">
                <input type="submit" value="Upload">
            </div>
        </form>
    </div>
</body>
</html>