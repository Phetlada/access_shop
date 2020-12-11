<?php 
session_start();
$UserName = $_GET['UserName'];
if ( $UserName == $_SESSION['UserName']){
$ID = $_GET['id'];
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "accessories";
$conn = mysqli_connect( $hostname, $username, $password );
if (!$conn ) die ( "ไม่ÿามารถติดต่อกับ MySQL ได้" );
mysqli_select_db ($conn ,  $dbname)or die ( "ไม่ÿามารถเลือกฐานข้อมูล itbookได้" );
mysqli_query($conn,"SET character_set_results=utf8");
mysqli_query($conn,"SET character_set_client=utf8");
mysqli_query($conn,"SET character_set_connection=utf8");
$sqltxt = "SELECT * FROM acces where accesID = '$ID'";
$result = mysqli_query ( $conn,$sqltxt );
$rs = mysqli_fetch_array ( $result );
$Path="image/";
echo "<form action=\"editAmount_stock.php?id=$rs[0]&UserName=$UserName\" method=\"post\">"?>
<table align="center" border='1' width='600px'>
    <tr><td colspan='2' align='center'> กรุณาป้อนข้อมูล</td></tr>
    <tr><td>รหัสสินค้า :</td> <td><?php echo "$rs[0]" ?></td></tr>
    <tr><td>ชื่อสินค้า :</td> <td><?php echo "$rs[1]" ?></td></tr>
    <tr><td>จำนวนสินค้าที่มี :</td> <td><input type="text" name="Stock" value = "<?php echo "$rs[7]" ?>"></td></tr>
<?php echo "<tr><td colspan='2' align='center'><input type=\"submit\" value=\" OK \" onclick=\"return confirm(' ยืนยันการเพิ่มสินค้า รหัส $rs[0] ')\"></td></tr>";?>
</table>
</form>
<?php
}else {
    echo "You not login.";
    echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
}
if(isset($_POST['Stock'])){
    $Stock = $_POST['Stock'];
    $sql = "UPDATE `acces` SET  `Stock` = '$Stock' WHERE `acces`.`accesID` = $ID";
    mysqli_query($conn,$sql) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
}
?> 