<?php
    session_start();
    $UserName = $_GET['UserName'];
    $hostname = "localhost";
    if ( $UserName == $_SESSION['UserName']){

    }else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>