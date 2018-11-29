<?php
# to prevent access from URL
if(!session_start()) {
    header("Location: http://ec2-3-16-213-5.us-east-2.compute.amazonaws.com/error.php");
    exit;
}
if(!$fromRequired) {
    header("Location: http://ec2-3-16-213-5.us-east-2.compute.amazonaws.com/");
    exit;
}
?>

<!-- created by Matt Hudson -hudso- for CS2830 Fall '17 Final Project -->
<div class="navigation">
    <a href="http://ec2-3-16-213-5.us-east-2.compute.amazonaws.com/">Home</a>
        <?php
        $loggedIn = empty($_SESSION['loggedIn']) ? false : $_SESSION['loggedIn'];
        if(!$loggedIn) {
            $username = null;
            print "<a href='http://ec2-3-16-213-5.us-east-2.compute.amazonaws.com/createAccount/'>Create Account</a>
            <a href='http://ec2-3-16-213-5.us-east-2.compute.amazonaws.com/login/'>Login</a>";
        }
        else {
            $username = $_SESSION['username'];
            print "<a href='http://ec2-3-16-213-5.us-east-2.compute.amazonaws.com/addMusic/'>Add Music</a>
            <a href='http://ec2-3-16-213-5.us-east-2.compute.amazonaws.com/logout.php'>Logout</a>";
            print "<a href='http://ec2-3-16-213-5.us-east-2.compute.amazonaws.com/users.php'>View Users</a>";
        }
        if($username != null) print "<div>Welcome <b>" . $username . "</b></div>";
        ?>
    <a href="http://ec2-3-16-213-5.us-east-2.compute.amazonaws.com/searchUser/">Search Users</a>
    <a href='http://ec2-3-16-213-5.us-east-2.compute.amazonaws.com/aboutSinfonia/'>About ΦΜΑ</a>
    <a href="http://missouri.sinfonia.org/">Zeta Chapter</a>
    <a href="https://www.sinfonia.org"><img src='http://ec2-3-16-213-5.us-east-2.compute.amazonaws.com/images/coatOfArms.png' alt='ΦΜΑ'></a>
    </div>