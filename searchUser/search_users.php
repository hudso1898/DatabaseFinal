<?php
	if(!session_start()) {
		header("Location: ../error.php");
		exit;
	}
	$action = empty($_GET['action']) ? '' : $_GET['action'];

	if ($action == 'search_user') {
		search();
	} else {
		form();
	}
	
	function search() {
		$username = empty($_GET['username']) ? false : $_GET['username'];
        if(!$username) {
            $error = 'Error: enter a username to search for.';
            require "search_user_form.php";
            exit;
        }
        
        $mysqli = new mysqli('localhost', 'stnd', 'zeta1907', 'songapp');

        if ($mysqli->connect_error) {
            $error = 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
			require "search_user_form.php";
            exit;
        }
        $username = $mysqli->real_escape_string($username);  
        
		$query = "SELECT * FROM users WHERE username = '$username';";
		$result = $mysqli->query($query);
		
        if ($result) {
            $match = $result->num_rows;
            
  		    if ($match == 1) {
                $userData = $result->fetch_assoc();
                $first = $userData['firstName'];
                $last = $userData['lastName'];
                $date = $userData['addDate'];
                $genre = $userData['favGenre'];
                require "show_user.php";
                exit;
            }
            else {
                $result->close();
                $mysqli->close();
                $error = 'User not found.';
                require "search_user_form.php";
                exit;
            }
        }
        else {
          $error = 'Search error: Please contact the system administrator.';
          require "search_user_form.php";
          exit;
        }
	}
	
	function form() {
		$error = "";
		require "search_user_form.php";
        exit;
	}
	
?>