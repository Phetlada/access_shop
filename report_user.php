<html>
<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
<link rel="stylesheet" href="mystyle.css">
<head>
<style>
img.resize  {
    width: 150px;
    height:150px;
    border: 0;
}
img:hover.resize  {
    width: 200px;
    height: 200px;
    border: 0;
}
img.size  {
    width: 100px;
    height: 100px;
    border: 0;
}
</style>
</head>
<body>
<?php
    session_start();
    $_SESSION["basket_count"] = 0;
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
    {?>
        <ul>
        <?php echo "<li><a href='welcome_admin.php?UserName=$UserName'>Home</a></li>"; ?>
        <li><a href="login.php">Logout</a></li>
        <li><a class='active' href="showbasket.php?UserName=<?php echo $UserName ?>">Basket :<?php echo " ",$count ?></a> </li>
        <ri>username :<?php echo " ",$UserName ?> </ri>
        <ri>Status :<?php echo " ",$rs['status'] ?> </ri>
        
        </ul>
        <?php
        $str = "SELECT acces.*,basket.count FROM acces JOIN basket ON acces.accesID = basket.acessID";
        $result1 = mysqli_query ($conn,$str) or die( mysqli_error($conn));
        $Path="image/"; //ระบุ path ของไฟล์รูปภาพที่จัดเก็บไว้ใน server
        $num = rand(200000,300000);
        echo "<center><h1>ใบสั่งสินค้า</h1>";
        echo "เลขใบสั่งซื้อที่  ". $num. " ";
        echo "วันที่สั่งซื้อ ".date( "d-M-Y"." ");
        echo "<br>ชื่อผู้สั่ง ".$rs['username'];
        echo "";
        echo "</center>";
        echo "<table width='80%' border='1' align='center'>";
        echo "<tr><td>ลำดับที่ </td> <td>รหัสสินค้า</td><td>ชื่อสินค้า</td>";
        echo "<td>ราคา/ชิ้น</td><td>จำนวนสินค้า</td><td>ราคารวม</td>";
        $a=1;
        $all = 0;
        $Cost = 0;
        while ( $rs1 = mysqli_fetch_array ( $result1 ) )
        {
            echo "<form>";   
            echo "<tr><td> $a </td>";
            for($n = 0; $n < 5 ; $n++){
                if($n == 2){
                    echo "<td>" . $rs1[ 5 ] . "</td>";
                }
                else if($n == 3)echo "<td>" . $rs1[ 9 ] . "</td>";
                else if($n == 4){
                    echo "<td>".$rs1[5]*$rs1[9]."</td>";
                    $all += $rs1[5]*$rs1[9];
                    $Cost += $rs1[6]*$rs1[9];
                    
                }
                else echo "<td>" . $rs1[ $n ] . "</td>";
                
            }
        echo "</tr>";
        $a++;
        }
        $day = date( "d-M-Y");
        $vip = $all-($all*0.1);
        if($rs['status']=="user"){
            echo"<tr><td colspan = '12' align = 'right'> ราคารวม ". $all ."  บาท</td></tr>";
            $sql = "INSERT INTO `report` (`reportID`, `name`, `cost`, `price`, `day`)VALUES('$num', '$UserName', '$Cost', '$all','$day')";
            mysqli_query($conn,$sql) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
        } 
        else {
            echo"<tr><td colspan = '12' align = 'right'>(ส่วนลด 10%) ราคารวม <strike>". $all ."</strike> ลดเหลือ ".$vip." บาท</td></tr>";
            $sql = "INSERT INTO `report` (`reportID`, `name`, `cost`, `price`, `day`)VALUES('$num', '$UserName', '$Cost', '$vip','$day')";
            mysqli_query($conn,$sql) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
        }
        echo "</table></from>";
        $sql = "DELETE FROM `basket`";
        mysqli_query($conn,$sql) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
        //echo "<a href='checkbasket.php?id=$rs[0]&UserName=$UserName' >ยืนยันสั่งซื้อสินค้า</a>";
        echo "</font_page></body></html>";
    }
    else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>