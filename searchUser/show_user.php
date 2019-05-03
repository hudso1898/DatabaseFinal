<?php
if(!session_start()) {
    header("Location: ../error.php");
    exit;
}
else {
    if(!$username) {
        header("Location: search_users.php");
        exit;
    }
}

$user = $username;

print "<!-- Created by Matt Hudson -hudso- for CS2830 Fall '17 Final Project -->
<!DOCTYPE html>
<html>
<head>
	<title>Search User</title>
	<link href='../app.css' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'>
    <link href='../jquery-ui-1.12.1.custom/jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='../jquery-ui-1.12.1.custom/external/jquery/jquery.js'></script>
    <script src='../jquery-ui-1.12.1.custom/jquery-ui.min.js'></script>
</head>
<body>";
    $fromRequired = true;
    require '../navigation.php';

    print "<div class'showuser'>
        <h1>User Result</h1>
        
        <div class='userResult'>";
        print "<div class='info'>Username: $user</div>
    <div class='info'>Name: $first"; print " $last</div>
    <div class='info'>Added: $date</div>
    <div class='info'>Favorite Genre: $genre</div>";
        print "</div>
    
    
    </div>
    <a class='back' href='search_users.php'>Back</a>
</body>
</html>";


?>

