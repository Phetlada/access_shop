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
        $r = false ;
        $str = "SELECT acces.*,basket.count FROM acces JOIN basket ON acces.accesID = basket.acessID";
        $result1 = mysqli_query ($conn,$str) or die( mysqli_error($conn));
        $a=1;
        $all = 0;
        $num = 0;
        $id ='';
        while ( $rs1 = mysqli_fetch_array ( $result1 ) )
        {
                    if($rs1[7]-$rs1[9] < 0){
                        $num = $rs1[9]-$rs1[7];
                        $r = true;
                        $id = $rs1[0];
                        break;
                    }
        }
        if($r == true){
            $_SESSION['sold'] = "ไม่สามารถซื้อสินค้าได้ เนื่องจากขาดสินค้า $id จำนวน $num";
            header("Location: showbasket.php?UserName=$UserName");
        }else{
            $str1 = "SELECT acces.*,basket.count FROM acces JOIN basket ON acces.accesID = basket.acessID";
            $result2 = mysqli_query ($conn,$str1) or die( mysqli_error($conn));
            while ( $rs2 = mysqli_fetch_array ( $result2 ) )
            {
                    $all += $rs2[5]*$rs2[9];
                    $StockNew = $rs2[7]-$rs2[9];
                    $sql1 = "UPDATE `acces` SET `Stock` = '$StockNew' WHERE `acces`.`accesID` = $rs2[0]";
                    mysqli_query($conn,$sql1) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn)); 
            }
            if($rs['status']=="user"){  
                if($all >= 5000){
                    $ID = $_GET['id'];
                    $sql = "";
                    $sql = "UPDATE `login` SET `status` = 'userVIP' WHERE `login`.`userID` = $ID";
                    mysqli_query($conn,$sql) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
            }
            }
        header("Location: report_user.php?UserName=$UserName");
        }
        
    }else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>