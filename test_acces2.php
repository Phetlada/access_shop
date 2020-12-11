<HTML>
<HEAD><TITLE>Show Data Book</TITLE></HEAD>
<BODY>
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "acces";
$conn = mysqli_connect( $hostname, $username, $password );
if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้" );
mysqli_select_db ( $conn,$dbname  )or die ( "ไม่สามารถเลือกฐานข้อมูล bookstore ได้" );
mysqli_query($conn,"SET character_set_results=utf8");
mysqli_query($conn,"SET character_set_client=utf8");
mysqli_query($conn,"SET character_set_connection=utf8");
$sqltxt = "SELECT * FROM acces";
$result = mysqli_query ($conn,$sqltxt) or die( mysqli_error($conn));
$Path="image/"; //ระบุ path ของไฟล์รูปภาพที่จัดเก็บไว้ใน server


echo "<html><head><title>Test database</title></head>";
echo "<body><CENTER><H3>รายชื่อĀนังÿือ</H3></CENTER>";
echo "<table width='100%' border='1' align='center'>";
echo "<tr><td>ลำดับที่ </td> <td>รหัสสินค้า</td><td>ชื่อสินค้า</td>";
echo "<td>ประเภทสินค้า </td> <td>ขนาด</td><td>สี</td>";
echo "<td>ราคาขาย </td> <td>ราคาต้นทุน</td><td>จำนวนสืนค้า</td>";
echo "<td>รูปภาพ </td>";
$a=1;
while ( $rs = mysqli_fetch_array ( $result ) )
{
    echo "<tr><td> $a </td>";
    for($n = 0; $n < 9 ; $n++) {
    
    if($n == 8){
        $image = "<img src=$Path$rs[$n] valign=middle align = center
    width=\"80\" height = \"100\">";
    echo "<td>" . $image . "</td>";
    }
    else echo "<td>" . $rs[ $n ] . "</td>";
}
echo "</tr>";
$a++;
}
echo "</table></body></html>";
?>
<BR>
<div align = "center"> <A HREF="#">กลับĀน้าĀลัก</A></div><BR>
</BODY>
</HTML>