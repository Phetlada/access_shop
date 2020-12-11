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
        $sql1 = "SELECT * FROM basket WHERE acessID = '$id' ";
        $result = mysqli_query($conn,$sql1) or die ( "DELETE จาตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error());
        $rs1 = mysqli_fetch_array ( $result );
        $i =$rs1[1];
        $_SESSION["basket_count"] -= $i;

        $sql = "DELETE FROM basket WHERE acessID = '$id' ";
        mysqli_query($conn,$sql) or die ( "DELETE จาตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error());
        mysqli_close ( $conn );
        header("Location:showbasket.php?&UserName=$UserName");
    }else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>