<?php
    session_start();
    $UserName = $_GET['UserName'];
    $id = $_GET['id'];
    $hostname = "localhost";
    if ( $UserName == $_SESSION['UserName']){
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "accessories";
        $conn = mysqli_connect( $hostname, $username, $password );
        if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้" );
        mysqli_select_db ( $conn,$dbname  )or die ( "ไม่สามารถเลือกฐานข้อมูล bookstore ได้" );
        mysqli_query($conn,"SET character_set_results=utf8");
        mysqli_query($conn,"SET character_set_client=utf8");
        mysqli_query($conn,"SET character_set_connection=utf8");
        mysqli_select_db ( $conn,$dbname)or die ( "ไม่ÿามารถเลือกฐานข้อมูล bookstore ได้" );
        $sql = "DELETE FROM acces WHERE accesID = '$id' ";
        mysqli_query($conn,$sql) or die ( "DELETE จาตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error());
        mysqli_close ( $conn );
        $str = "ลบบัญชีผู้ใช้เรียบร้อย";
        header("Location:Stock.php?&UserName=$UserName");
    }else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>