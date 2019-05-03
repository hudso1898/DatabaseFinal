<?php
if(!session_start()) {
    header("Location: ../error.php");
    exit;
}
?>

<!-- Created by Matt Hudson -hudso- for CS2830 Fall '17 Final Project -->
<!DOCTYPE html>
<html>
<head>
	<title>Update Password</title>
	<link href="../app.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="../jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script src="../jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
    <script src="../jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $("input[type=submit]").button();
        });
    </script>
</head>
<body>
    <?php $fromRequired = true; require '../navigation.php'; ?>
    <div>
        <h1>Update Password</h1>
        <?php
            if ($error) {
                print "<div class='errorMessage'>$error</div>\n";
            }
        ?>
        
        <form action="search_users.php" method="POST">
            
            <input type="hidden" name="action" value="update_password">
            
            <div class="textfield">
                <label for="opassword">Old Password:</label>
                <input type="password" id="opassword" name="opassword" class="ui-widget-content ui-corner-all textinput" autofocus value="">
            </div>
            <div class="textfield">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" class="ui-widget-content ui-corner-all textinput" autofocus value="">
            </div>
            
            <div class="textfield">
                <label for="cpassword">Confirm Password:</label>
                <input type="password" id="cpassword" name="cpassword" class="ui-widget-content ui-corner-all textinput" autofocus value="">
            </div>
           
            <div class="submitButton">
                <input type="submit" value="Update">
            </div>
        </form>
    </div>
</body>
</html>