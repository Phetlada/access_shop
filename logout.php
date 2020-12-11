<?php
    session_start();
    $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "accessories";
        $conn = mysqli_connect( $hostname, $username, $password );
        if ( ! $conn ) die ( "ไม่สํามํารถติดต่อกับ MySQL ได ้");
        mysqli_query($conn,"SET character_set_results=utf8");
        mysqli_query($conn,"SET character_set_client=utf8");
        mysqli_query($conn,"SET character_set_connection=utf8");
        mysqli_select_db ( $conn ,$dbname)or die ( "ไม่สํามํารถเลือกฐํานข ้อมูล test ได ้" ); 
    $_SESSION["basket_count"] = 0;
    $sql = "DELETE FROM `basket`";
    mysqli_query($conn,$sql) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
    //echo "User : " . $UserName . " now logout.";
    header("Location: login.php");
    
?>