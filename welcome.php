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
    $_SESSION['sold'] = '';
    $count = $_SESSION["basket_count"];
    $UserName = $_GET['UserName'];
    $hostname = "localhost";
        $username = "root";
        $password = 12345678;
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
        <?php echo "<li><a class='active' href='welcome_admin.php?UserName=$UserName'>Home</a></li>"; ?>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="showbasket.php?UserName=<?php echo $UserName ?>">Basket :<?php echo " ",$count ?></a> </li>
        <ri>username :<?php echo " ",$UserName ?> </ri>
        <ri>Status :<?php echo " ",$rs['status'] ?> </ri>
        
        </ul>
        <table width="90%" height="40%" align = "center" >
            <tr align = "center">
                <td ><?php echo "<a href='#?UserName=$UserName'><img src='image/storage.png'class='size'></a>" ?><br>
                    <h3  class = "sarabun">สินค้าทั้งหมด</h3></td>
                <td><?php echo "<a href='necklace.php?UserName=$UserName' ><img src='image/jewelry.png'  alt='animate' class='resize'></a>" ?><br>
                    <h3 class = "sarabun">สร้อยคอ</h3></td>
                <td><?php echo "<a href='earrings.php?UserName=$UserName' ><img src='image/girl.png'  alt='animate' class='resize'></a>" ?><br>
                    <h3 class = "sarabun">ต่างหู</h3></td>
                <td><?php echo "<a href='bracelet.php?UserName=$UserName' ><img src='image/band.png'  alt='animate' class='resize'></a>" ?><br>
                    <h3 class = "sarabun">สร้อยข้อมือ</h3></td>
                <td><?php echo "<a href='ring.php?UserName=$UserName' ><img src='image/ring.png'  alt='animate' class='resize'></a>" ?><br>
                    <h3 class = "sarabun">แหวน</h3></td>    
                <td><?php echo "<a href='brooch.php?UserName=$UserName' ><img src='image/brooch.png'  alt='animate' class='resize'></a>" ?><br>
                    <h3 class = "sarabun">เข็มกลัด</h3></td>
            </tr>
        </table>
        <?php
        $sqltxt = "SELECT * FROM acces ";
        $result = mysqli_query ($conn,$sqltxt) or die( mysqli_error($conn));
        $Path="image/"; //ระบุ path ของไฟล์รูปภาพที่จัดเก็บไว้ใน server
        echo "<table width='80%' border='1' align='center'>";
        echo "<tr><td>ลำดับที่ </td> <td>รหัสสินค้า</td><td>ชื่อสินค้า</td>";
        echo "<td>รูปภาพ </td>";
        $a=1; $check = false;
        while ( $rs = mysqli_fetch_array ( $result ) )
        {
            echo "<form action=\"checkbasket.php?ID=$rs[0]&UserName=$UserName\" method=\"post\">";
            echo "<tr><td> $a </td>";
            for($n = 0; $n < 4 ; $n++) {
                if($n == 2){
                    $image = "<img src=$Path$rs[8] valign=middle align = center
                width=\"150\" height = \"200\">";
                echo "<td>" . $image . "</td>";
                }
                else if($n == 0){
                    echo "<td>" . $rs[ 0 ] . "</td>";
                }
                else if($n == 3){
                    //echo "<td><input type='text' name='amount' value = ''></td>";
                    //echo "<td><input type='submit' value=' OK '></td>";
                    if($rs[7]-1 < 0 || $check == true)echo "<td>สินค้าหมด</td>";
                    else if($rs[7]-1 >= 0){
                        if($rs[7]-1 < 0)$check = true;
                        echo "<td><a href='add_basket.php?ID=$rs[0]&UserName=$UserName'>สั่งซื้อ</a></td>";
                        
                    }
                }
                else echo "<td>" . $rs[ 1 ] . "</td>";
                
                
            }
        echo "</tr>";
        $a++;
        }
        echo "</table></from>";
        echo "<a href='insert_stock.php?UserName=$UserName'>เพิ่มสินค้า</a>";
        echo "</font_page></body></html>";
    }
    else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>