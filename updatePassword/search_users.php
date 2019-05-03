<?php
	if(!session_start()) {
		header("Location: ../error.php");
		exit;
	}
	$action = empty($_POST['action']) ? '' : $_POST['action'];

	if ($action == 'update_password') {
		update();
	} else {
		form();
	}
	
	function update() {
		$username = empty($_SESSION['username']) ? false : $_SESSION['username'];
        if(!$username) {
            $error = 'Unknown user';
            require "search_user_form.php";
            exit;
        }
        
        $mysqli = new mysqli('localhost', 'stnd', 'zeta1907', 'songapp');

        if ($mysqli->connect_error) {
            $error = 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
			require "search_user_form.php";
            exit;
        }
        
        $opassword=empty($_POST['opassword']) ? false : $_POST['opassword'];
        $password=empty($_POST['password']) ? false : $_POST['password'];
        $cpassword=empty($_POST['cpassword']) ? false : $_POST['cpassword'];
        
        # hash the passwords
        $opassword = sha1($opassword);
        $password = sha1($password);
        $cpassword = sha1($cpassword);
        
        $username = $mysqli->real_escape_string($username);  
        
		$query = "SELECT * FROM users WHERE username = '$username';";
		$result = $mysqli->query($query);
        
		
        if ($result) {
            $match = $result->num_rows;
            
  		    if ($match == 1) {
                $userData = $result->fetch_assoc();
                if($opassword == $userData['password']) {
                    if ($password == $cpassword) {
                        $query = "UPDATE users SET password='$password' WHERE username='$username';";
                        $result->close();
                        $mysqli->close();
                        $mysqli = new mysqli('localhost', 'stnd', 'zeta1907', 'songapp');
                        
                        $result = $mysqli->query($query);
                        header("Location: ../index.php");
                        exit;
                    }
                    else {
                         $result->close();
                        $mysqli->close();
                        $error = 'Error: new passwords do not match!';
                        require "search_user_form.php";
                        exit;
                    }
                }
                else {
                    $result->close();
                    $mysqli->close();
                    $error = 'Error: current passwords do not match!';
                    require "search_user_form.php";
                    exit;
                }
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