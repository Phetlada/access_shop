<?php
session_start();
$UserName = $_GET['UserName'];
if ( $UserName == $_SESSION['UserName']){
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "accessories";
    $conn = mysqli_connect( $hostname, $username, $password );
    if (!$conn ) die ( "ไม่ÿามารถติดต่อกับ MySQL ได้" );
    mysqli_select_db ($conn ,  $dbname)or die ( "ไม่ÿามารถเลือกฐานข้อมูล itbookได้" );

    $UserName1 = $_POST['username'];
    $Password = md5($_POST['Password']);
    $Name = $_POST['name'];
    $SurName = $_POST['surname'];
    $Sex = $_POST['sex'];
    $ID = $_GET['id'];

    $sql = "UPDATE `login` SET `username` = '$UserName1', `password` = '$Password', `name` = '$Name', `surname` = '$SurName', `sex` = '$Sex' WHERE `login`.`userID` = $ID";
    mysqli_query($conn,$sql) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
    
    echo "แก้ไขสำเร็จ";
    echo "<br><a href='rist_user.php?UserName=$UserName'>คลิก กลับไป</a>";
    mysqli_close($conn); 
}else {
    echo "You not login.";
    echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
}