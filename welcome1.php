<?php
    session_start();
    $UserName = $_GET['UserName'];

    if ( $UserName == $_SESSION['UserName'])
    {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login";

        $conn = mysqli_connect( $hostname, $username, $password );
        if ( ! $conn ) die ( "ไม่สํามํารถติดต่อกับ MySQL ได ้");

        mysqli_select_db ( $conn ,$dbname)or die ( "ไม่สํามํารถเลือกฐํานข ้อมูล test ได ้" );
        $sqltxt = "SELECT * FROM login where UserName = '$UserName'";
        $result = mysqli_query ( $conn,$sqltxt );
        $rs = mysqli_fetch_array ( $result );

        echo "<table border=1 align=center bgcolor=#FFCCCC width=400>";
        echo "<tr><td align=center colspan=2 bgcolor =#FF99CC>";
        echo "<B>แสดงรํายละเอยีดผใู้ช</B></td></tr>";
        echo "<tr><td> UserName : </td><td>".$rs["UserName"]."</td></tr>";
        echo "<tr><td> Password : </td><td>".$rs["Password"]."</td></tr>";
        echo "<tr><td> Status : </td><td>".$rs["Status"]."</td></tr>";
        echo "</table>";
        echo "<br><a href='logout.php?UserName=$UserName'> logout </a>";
    }
    else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>