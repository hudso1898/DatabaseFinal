<?php
// Created by Professor Wergeles for CS2830 at the University of Missouri
// edited and expanded by Matt Hudson -hudso- for CS2830 Fall '17 Final Project

	if(!session_start()) {
		header("Location: ../error.php");
		exit;
	}
	$loggedIn = empty($_SESSION['loggedIn']) ? false : $_SESSION['loggedIn'];
	
	if ($loggedIn) {
		header("Location: ../index.php");
		exit;
	}
	$action = empty($_POST['action']) ? '' : $_POST['action'];

	if ($action == 'do_login') {
		handle_login();
	} else {
		login_form();
	}
	
	function handle_login() {
		$username = empty($_POST['username']) ? '' : $_POST['username'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];
        
        $mysqli = new mysqli('localhost', 'stnd', 'zeta1907', 'songapp');

        if ($mysqli->connect_error) {
            $error = 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
			require "login_form.php";
            exit;
        }
        $username = $mysqli->real_escape_string($username);
        $password = $mysqli->real_escape_string($password);
        
        $password = sha1($password); 
        
		$query = "SELECT username FROM users WHERE username = '$username' AND password = '$password'" . ";";

        
		$mysqliResult = $mysqli->query($query);
		
        if ($mysqliResult) {
            $match = $mysqliResult->num_rows;
            
            
  		    if ($match == 1) {
                print $username;
                
                $_SESSION['loggedIn'] = $username;
                $_SESSION['username'] = $username;
                
                $mysqliResult->close();
                $mysqli->close();
                
                header("Location: ../index.php");
                exit;
            }
            else {
                $mysqliResult->close();
                $mysqli->close();
                $error = 'Error: Incorrect username or password';
                require "login_form.php";
                exit;
            }
        }
        else {
          $error = 'Login Error: Please contact the system administrator.';
          require "login_form.php";
          exit;
        }
	}
	
	function login_form() {
		$username = "";
		$error = "";
		require "login_form.php";
        exit;
	}
	
?>