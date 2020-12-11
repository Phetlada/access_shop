<?php
    session_start();
    $count = $_SESSION["basket_count"];
    $UserName = $_GET['UserName'];
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
        $sqltxt = "SELECT * FROM login where username = '$UserName'";
        $result = mysqli_query ( $conn,$sqltxt );
        $rs = mysqli_fetch_array ( $result );

    if ( $UserName == $_SESSION['UserName'])
    {
        $str = "SELECT acces.*,basket.count FROM acces JOIN basket ON acces.accesID = basket.acessID";
        $result1 = mysqli_query ($conn,$str) or die( mysqli_error($conn));
        $a=1;
        $all = 0;
        while ( $rs1 = mysqli_fetch_array ( $result1 ) )
        {
                    $all += $rs1[5]*$rs1[9];
                    if($rs1[7] > 0){
                        $StockNew = $rs1[7]-$rs1[9];
                        $sql = "UPDATE `acces` SET `Stock` = '$StockNew' WHERE `acces`.`accesID` = $rs1[0]";
                        mysqli_query($conn,$sql) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn)); 
                    }
                    
        }
        if($rs['status']=="user"){  
            if($all >= 5000){
                $ID = $_GET['id'];
                $sql = "";
                $sql = "UPDATE `login` SET `status` = 'userVIP' WHERE `login`.`userID` = $ID";
                mysqli_query($conn,$sql) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
            }
        }
        header("Location: welcome.php?UserName=$UserName");
    }else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>