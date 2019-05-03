<?php

if (!session_start()) {
    header("Location: error.php");
    exit;
}
    $mysqli = new mysqli('localhost', 'stnd', 'zeta1907', 'songapp');

        if ($mysqli->connect_error) {
            $error = 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
			require "login_form.php";
            exit;
        }
    $username = $_SESSION['username'];

    $query = "DELETE FROM users WHERE username = '$username';";
    
    $mysqliResult = $mysqli->query($query);

    require("logout.php");
    exit;
?>