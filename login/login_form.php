<!DOCTYPE html>
<!-- Created by Professor Wergeles for CS2830 at the University of Missouri 
Edited and expanded by Matt Hudson -hudso- for CS2830 Fall '17 Final Project -->
<html>
<head>
	<title>Login - ΦΜΑ Music </title>
	<link href="../app.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="../jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script src="../jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
    <script src="../jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script>
        $( function() {
            $("input[type=submit]").button();
        });
    </script>
</head>
<body>
    <?php $fromRequired = true; require '../navigation.php'; ?>
    <div>
        <h1>Login</h1>
        <?php
            if ($error) {
                print "<div class='errorMessage'>$error</div>\n";
            }
            if ($message) {
                print "<div class='message'>$message</divn";
            }
        ?>
        
        <form action="login.php" method="POST">
            
            <input type="hidden" name="action" value="do_login">
            
            <div class="textfield">
                <label for="username">User name:</label>
                <input type="text" id="username" name="username" class="ui-widget-content ui-corner-all textinput" autofocus value="<?php print $username; ?>">
            </div>
            
            <div class="textfield">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="ui-widget-content ui-corner-all textinput">
            </div>
            
            <div class="submitButton">
                <input type="submit" value="Log in">
            </div>
        </form>
    </div>
</body>
</html>