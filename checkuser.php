<?php
    session_start(); 
    $UserName = $_POST['UserName'];
    $_SESSION["password"] = $_POST['Password'];
    $Password = md5($_POST['Password']);

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "accessories";
    $conn = mysqli_connect( $hostname, $username, $password );
    if ( ! $conn ) die ( "ไม่สํามํารถติดต่อกับ MySQL ได ้");
    mysqli_select_db ( $conn ,$dbname )or die ( "ไม่สํามํารถเลือกฐํานข ้อมูล test ได ้" );
        
    $sqltxt = "SELECT * FROM login where username = '$UserName'";
    $str =  "<center><h4>password หรือ username ไม่ถูกต้อง !!</h4></center>";
    $str1 =  "<center><h4>ไม่ได้เป็นสมาชิก !!</h4></center>";
    $result = mysqli_query ( $conn ,$sqltxt );
    $rs = mysqli_fetch_array ( $result );
    if ( $rs ) 
    {
        if ($rs['password'] == $Password) {
            $_SESSION["UserName"] = $UserName;
            $_SESSION["Status"]; 
            if($rs['status'] == "admin")header("Location: welcome_admin.php?UserName=$UserName");
            else if($rs['status'] == "manager")header("Location: welcome_admin.php?UserName=$UserName");
            else header("Location: open.php?UserName=$UserName");
        }
        else {
            $_SESSION["str"] = $str;
            header("Location: login.php?str = $str");
        }
    }
    else {
        $_SESSION["str"] = $str1;
        header("Location: login.php?str = $str1");
    }
?>