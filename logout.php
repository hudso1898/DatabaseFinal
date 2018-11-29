<?php
    if(!session_start()) {
        header("Location: error.php");
        exit;
    }
    
    $SESSION = array();
    session_destroy();

    header("Location: index.php");  
    exit;

?>