<?php
if (!session_start()) {
    header("Location: ../error.php");
    exit;
}

$loggedIn = empty($_SESSION['loggedIn']) ? false : $_SESSION['loggedIn'];
if($loggedIn) {
    header("Location: ../index.php");
    exit;
}

$action = empty($_POST['action']) ? '' : $_POST['action'];
if($action == 'create_account') {
    create_account();
}
else {
    create_account_form();
}

function create_account() {
    $username = empty($_POST['username']) ? '' : $_POST['username'];
    $password = empty($_POST['password']) ? '' : $_POST['password'];
    $passwordConfirm = empty($_POST['passwordConfirm']) ? '' :
    $_POST['passwordConfirm'];
    $firstname = empty($_POST['firstname']) ? '' : $_POST['firstname'];
    $lastname = empty($_POST['lastname']) ? '' : $_POST['lastname'];
    $genre = empty($_POST['genre']) ? '' : $_POST['genre'];
    if($username == '' || $password == '') {
        $error = 'Error: enter a username and password';
        require "create_account_form.php";
        exit;
    }
    if($passwordConfirm == '') {
        $error = 'Error: please confirm your password.';
        require "create_account_form.php";
        exit;
    }
    if ($password != $passwordConfirm) {
        $error = 'Error: passwords do not match.';
        require "create_account_form.php";
        exit;
    }
   
   
        
    $mysqli = new mysqli('localhost', 'stnd', 'zeta1907', 'songapp');

    if ($mysqli->connect_error) {
       $error = 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
       require "create_account_form.php";
        exit;
    }
    $username = $mysqli->real_escape_string($username);
    $password = $mysqli->real_escape_string($password);
    $passwordConfirm = $mysqli->real_escape_string($passwordConfirm);
    $firstname = $mysqli->real_escape_string($firstname);
    $lastname = $mysqli->real_escape_string($lastname);
        
    
    $password = sha1($password); 
    
        
		$query = "SELECT username FROM users WHERE username = '$username';";

        
		$mysqliResult = $mysqli->query($query);
		
        if ($mysqliResult) {
            $match = $mysqliResult->num_rows;          
  		    if ($match == 1) {
                $error = 'Error: username already in use.';
                require "create_account_form.php";
                exit;
            }
            $mysqliResult->close();
        }
        else {
          $error = 'System Error: Please contact the system administrator.';
          require "create_account_form.php";
          exit;
        }
    
    $query = "INSERT INTO users (username, password, firstName, lastName, favGenre,
    addDate) values ('$username', '$password', '$firstname', '$lastname', '$genre'
    , now());";
    if(!$mysqli->query($query)) {
        $error = 'System error: please contact the system administrator.';
        require "create_account_form.php";
        exit;
    }
    else {
        
        $mysqli->close();
        header("Location: ../login/");
        exit;
    }
}
function create_account_form() {
    $error = '';
    require "create_account_form.php";
    exit;
}


?>