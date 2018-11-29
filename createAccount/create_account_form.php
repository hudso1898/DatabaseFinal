<?php
if(!session_start()) {
    header("Location: ../error.php");
    exit;
}
else {
    $loggedIn = empty($_SESSION['loggedIn']) ? false : $_SESSION['loggedIn'];
    if($loggedIn) {
        header("Location: ../index.php");
        exit;
    }
}

?>

<!-- Created by Matt Hudson -hudso- for CS2830 Fall '17 Final Project -->
<!DOCTYPE html>
<html>
<head>
	<title>Create Account - ΦΜΑ Music </title>
	<link href="../app.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="../jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script src="../jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
    <script src="../jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $("input[type=submit]").button();
            $("#genre").selectmenu();
        });
    </script>
</head>
<body>
    <?php $fromRequired = true; require '../navigation.php'; ?>
    <div>
        <h1>Create Account</h1>
        <?php
            if ($error) {
                print "<div class='errorMessage'>$error</div>\n";
            }
            print "<div>$username</div>";
        ?>
        
        <form action="create_account.php" method="POST">
            
            <input type="hidden" name="action" value="create_account">
            
            <div class="textfield">
                <label for="firstname">First name:</label>
                <input type="text" id="firstname" name="firstname" class="ui-widget-content ui-corner-all textinput" autofocus value="<?php print $firstname; ?>">
            </div>
            <div class="textfield">
                <label for="lastname">Last name:</label>
                <input type="text" id="lastname" name="lastname" class="ui-widget-content ui-corner-all textinput" value="<?php print $lastname; ?>">
            </div>
            <div class="textfield">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="ui-widget-content ui-corner-all textinput" value="<?php print $username; ?>">
            </div>
            <div class="textfield">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="ui-widget-content ui-corner-all textinput">
            </div>
            <div class="textfield">
                <label for="passwordConfirm">Confirm Password:</label>
                <input type="password" id="passwordConfirm" name="passwordConfirm" class="ui-widget-content ui-corner-all textinput">
            </div>
            <div class='centered'>
                <label for="genre" class='selectorText'>Favorite Genre:</label>
                <select name="genre" id="genre" class="selectmenu">
        <option value="Rock" selected>Rock</option>
            <option value="Pop" >Pop</option>
            <option value="Jazz">Jazz</option>
            <option value="Classical">Classical</option>
            <option value="LoFi/Vaporwave">LoFi/Vaporwave</option>
            <option value="Blues">Blues</option>
            <option value="Rap">Rap</option>
            <option value="R&B">R&B</option>
            <option value="Funk">Funk</option>
            <option value="Reggae">Reggae</option>
            <option value="Metal">Metal</option>
            <option value="Country">Country</option>
            <option value="Film">Film</option>
            <option value="Gaming">Gaming</option>
            <option value="Other">Other</option>
        </select>
            </div>
            
            
            <div class="submitButton">
                <input type="submit" value="Create Account">
            </div>
        </form>
    </div>
</body>
</html>