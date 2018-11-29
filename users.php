<?php
if(!session_start()) {
    header("Location: error.php");
    exit;
}
$loggedIn = empty($_SESSION['loggedIn']) ? false : true;
if(!$loggedIn) {
    header("Location: index.php");
    exit;
}

print "
<!DOCTYPE html>
<html>
<head>
	<title>Search User - ΦΜΑ Music </title>
	<link href='app.css' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'>
    <link href='jquery-ui-1.12.1.custom/jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui-1.12.1.custom/external/jquery/jquery.js'></script>
    <script src='jquery-ui-1.12.1.custom/jquery-ui.min.js'></script>
</head>
<body>";
    $fromRequired = true;
    require 'navigation.php';

    print "<div class'showuser'>
    <h1>Users</h1>";
    
    $mysqli = new mysqli('localhost', 'stnd', 'zeta1907', 'songapp');

        if ($mysqli->connect_error) {
            $error = 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
			require "search_user_form.php";
            exit;
        }  
		$query = "SELECT * FROM users;";
		$result = $mysqli->query($query);
		
        if ($result) {
            while($userData = $result->fetch_assoc()) {
                $user = $userData['username'];
                $first = $userData['firstName'];
                $last = $userData['lastName'];
                $date = $userData['addDate'];
                $genre = $userData['favGenre'];
                print "<div class='userResult'>";
        print "<div class='info'>Username: $user</div>
    <div class='info'>Name: $first"; print " $last</div>
    <div class='info'>Added: $date</div>
    <div class='info'>Favorite Genre: $genre</div>";
        print "</div>";
            }
        }
        else {
          $error = 'Search error: Please contact the system administrator.';
          require "search_user_form.php";
          exit;
        }

    print "</div>
    <a class='back' href='http://ec2-52-15-151-188.us-east-2.compute.amazonaws.com/FinalProject/'>Back</a>
</body>
</html>";
?>