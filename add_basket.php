<?php
    session_start();
    $_SESSION["basket_count"];
    $UserName = $_GET['UserName'];
    $hostname = "localhost";
    $ID = $_GET['ID'];
    if ( $UserName == $_SESSION['UserName'])
    {
        $username = "root";
        $password = "";
        $dbname = "accessories";
        $conn = mysqli_connect( $hostname, $username, $password );
        if ( ! $conn ) die ( "ไม่สํามํารถติดต่อกับ MySQL ได ้");
        mysqli_query($conn,"SET character_set_results=utf8");
        mysqli_query($conn,"SET character_set_client=utf8");
        mysqli_query($conn,"SET character_set_connection=utf8");
        mysqli_select_db ( $conn ,$dbname)or die ( "ไม่สํามํารถเลือกฐํานข ้อมูล test ได ้" );
        $strSQL = "SELECT * FROM basket WHERE acessID = '$ID' ";
        $objResult = mysqli_query ( $conn,$strSQL );
        $rs = mysqli_num_rows($objResult); 
        if($rs == 0){
            $_SESSION["basket_count"] += 1;
            $strSQL = "";
            $strSQL = "INSERT INTO `basket` (`acessID`, `count`)VALUES('$ID', '1');";
            mysqli_query($conn,$strSQL) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
            echo "Save Done.";
            header("Location: open.php?UserName=$UserName");
        }else{
                $_SESSION["basket_count"] += 1;
                $strSQL = "SELECT * FROM basket WHERE acessID = '$ID' ";
                $objResult = mysqli_query ( $conn,$strSQL );
                $rs = mysqli_fetch_array ($objResult);
                $new = $rs[1]+1;
                $strSQL = "";
                $strSQL = "UPDATE `basket` SET `count` = $new WHERE `basket`.`acessID` = $ID";
                mysqli_query($conn,$strSQL) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
                header("Location: open.php?UserName=$UserName");            
                mysqli_close($conn);
        }
    }else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>