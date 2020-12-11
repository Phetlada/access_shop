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
a:link {
    text-decoration: none;
    color: black;
}

a:visited {
    text-decoration: none;
    color: black;
}

a:hover {
    text-decoration: underline;
    color: red;
}

a:active {
    text-decoration: underline;
}
p.solid {border-style: solid;}
p.round2 {
    border: 2px solid red;
    border-radius: 8px;
}
td.round2 {
    border: 2px solid white;
    border-radius: 8px;
}
</style>
</head>
<body>
<?php
    session_start();
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
/// admin################################################
    if ( $UserName == $_SESSION['UserName'])
    {?>
    <ul>
    <?php echo "<li><a href='welcome_admin.php?UserName=$UserName'>Home</a></li>"; ?>
    <li><a href="login.php">Logout</a></li>
    <ri>username :<?php echo " ",$UserName ?> </ri>
    <ri>Status :<?php echo " ",$rs['status'] ?> </ri>
    </ul>
    <table width="90%" height="40%" align = "center" >
        <tr align = "center">
            <td ><?php echo "<a href='stock.php?UserName=$UserName'><img src='image/storage.png' alt='animate' class='resize' ></a>" ?><br>
                <h3  class = "sarabun">สินค้าทั้งหมด</h3></td>
            <td><?php echo "<a href='necklace.php?UserName=$UserName' ><img src='image/jewelry.png' alt='animate' class='resize'></a>" ?><br>
                <h3 class = "sarabun">สร้อยคอ</h3></td>
            <td><?php echo "<a href='earrings.php?UserName=$UserName' ><img src='image/girl.png'  alt='animate' class='resize'></a>" ?><br>
                <h3 class = "sarabun">ต่างหู</h3></td>
            <td><?php echo "<a href='bracelet.php?UserName=$UserName' ><img src='image/band.png'  alt='animate' class='resize'></a>" ?><br>
                <h3 class = "sarabun">สร้อยข้อมือ</h3></td>
            <td><?php echo "<a href='#?UserName=$UserName' ><img src='image/ring.png' class='size' ></a>" ?><br>
                <h3 class = "sarabun">แหวน</h3></td>        
            <td><?php echo "<a href='brooch.php?UserName=$UserName' ><img src='image/brooch.png'  alt='animate' class='resize'></a>" ?><br>
                <h3 class = "sarabun">เข็มกลัด</h3></td>
        </tr>
    </table>
    <?php
    $sqltxt = "SELECT * FROM acces WHERE TypeID = '0400'";
    $result = mysqli_query ($conn,$sqltxt) or die( mysqli_error($conn));
    $Path="image/"; //ระบุ path ของไฟล์รูปภาพที่จัดเก็บไว้ใน server
    echo "<table align='center' width='90%'><tr>";
    $a=1;
    while ( $rs = mysqli_fetch_array ( $result ) )
    {
        for($n = 0; $n < 5 ; $n++) {
    
            if($n == 2){
                echo ". <a href=\"detail_stock.php?id=$rs[0]&UserName=$UserName\" ";
                echo ">$rs[0]</br>";
            }
            else if($n == 0){
                Getimg($Path,$rs[8]);
            }
            else if($n == 1) echo " $a ";
            else if($n == 3)echo "  " . $rs[ 1 ] ."<br>";
            else echo "จำนวนสินค้าคงเหลือ " . $rs[7] . " ชิ้น<br><br></td >";
    }
    $a++; if($a%5 == 1)echo "</tr><tr>";
    }
    echo "</table>";

    echo "<center><h3><p class = 'round2'><a href='insert_stock.php?UserName=$UserName'>เพิ่มสินค้า</a></p><h3>";
    echo "</font_page></center></body></html>";
    }else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
    function Getimg($Path,$id){
        if(strlen( $id ) < 100){
            $image = "<img src=$Path$id valign=middle align='center' width=\"150\" height = \"200\">";
                    echo "<td align='center' class = 'round2' bgcolor = '#ff8080'><br>" . $image . "</br>";
        }else{
            $src = 'data:image/jpg;base64,'.$id;
            $image = "<img src=$src valign=middle align='center'width=\"150\" height = \"200\">";
            echo "<td align='center' class = 'round2' bgcolor = '#ff8080'><br>" . $image . "</br>";
        }
    }
?>

</body>
</html>