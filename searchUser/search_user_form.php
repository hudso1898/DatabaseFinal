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
	<title>Search User - ΦΜΑ Music </title>
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
        <h1>Search for User</h1>
        <?php
            if ($error) {
                print "<div class='errorMessage'>$error</div>\n";
            }
        ?>
        
        <form action="search_users.php" method="GET">
            
            <input type="hidden" name="action" value="search_user">
            
            <div class="textfield">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="ui-widget-content ui-corner-all textinput" autofocus value="<?php print $username; ?>">
            </div>
           
            <div class="submitButton">
                <input type="submit" value="Search">
            </div>
        </form>
    </div>
</body>
</html>