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
        <li><a href="logout.php">Logout</a></li>
        <li><a class='active' href="showbasket.php?UserName=<?php echo $UserName ?>">Basket :<?php echo " ",$count ?></a> </li>
        <ri>username :<?php echo " ",$UserName ?> </ri>
        <ri>Status :<?php echo " ",$rs['status'] ?> </ri>
        
        </ul>
        <?php
        $sold =  $_SESSION['sold'];
        echo $sold;
        $sold = '';
        $_SESSION['sold'] = $sold;
        $str = "SELECT acces.*,basket.count FROM acces JOIN basket ON acces.accesID = basket.acessID";
        $result1 = mysqli_query ($conn,$str) or die( mysqli_error($conn));
        $Path="image/"; //ระบุ path ของไฟล์รูปภาพที่จัดเก็บไว้ใน server
        echo "<center><h1>ตะกร้าสินค้า</h1></center>";
        echo "<table width='80%' border='1' align='center'>";
        echo "<tr><td>ลำดับที่ </td><td>รูปภาพ</td><td>รหัสสินค้า</td><td>ชื่อสินค้า</td>";
        echo "<td>ราคา/ชิ้น</td><td>จำนวนสินค้า</td><td>ราคารวม</td><td colspan =\"2\" >แก้ไข</td>";
        $a=1;
        $all = 0;
        while ( $rs1 = mysqli_fetch_array ( $result1 ))
        {
            echo "<form>";
            echo "<tr><td> $a </td>";
            for($n = 0; $n < 8 ; $n++) { 
                
                if($n == 0){
                    $image = "<img src=$Path$rs1[8] valign=middle align = center
                    width=\"100\" height = \"100\">";
                    echo "<td>" . $image . "</td>";
                }
                else if($n == 1){
                    echo "<td>" . $rs1[ 0 ] . "</td>";
                }
                else if($n == 2){
                    echo "<td>" . $rs1[ 1 ] . "</td>";
                }
                else if($n == 3){
                    echo "<td>" . $rs1[ 5 ] . "</td>";
                }
                else if($n == 4){
                    echo "<td>" . $rs1[ 9 ] . "</td>";
                }
                else if($n == 5){
                    echo "<td>".$rs1[5]*$rs1[9]."</td>";
                    $all += $rs1[5]*$rs1[9];
                }
                else if($n == 6){
                    echo "<td align=\"center\"> <a href=\"delete_basket1.php?id=$rs1[0]&UserName=$UserName\" ";
                    echo "onclick=\"return confirm(' ยืนยันยกเลิกสินค้า ')\">[ยกเลิก] ";
                    echo "</a></font></td>\n";
                }
                else if($n == 7){
                    echo "<td align=\"center\"> <a href=\"delete_basket.php?id=$rs1[0]&UserName=$UserName\" ";
                    echo "onclick=\"return confirm(' ยืนยันยกเลิกสินค้าทั้งหมด ')\">[ยกเลิกทั้งหมด] ";
                    echo "</a></font></td>\n";
                }
                
            }
        echo "</tr>";
        $a++;
        }
        $vip = $all-($all*0.1);
        if($rs['status']=="user") echo"<tr><td colspan = '12' align = 'right'> ราคาทั้งหมด ". $all ."  บาท</td></tr>";
        else echo"<tr><td colspan = '12' align = 'right'>(ส่วนลด 10%) ราคาทั้งหมด <strike>". $all ."</strike> ลดเหลือ ".$vip." บาท</td></tr>";
        echo "</table></from>";
        if($count != 0)echo "<a href='checkbasket.php?id=$rs[0]&UserName=$UserName' >ยืนยันสั่งซื้อสินค้า</a>";
        echo "</font_page></body></html>";
    }
    else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>