<html>
<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
<link rel="stylesheet" href="mystyle.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
table.round2 {
    border: 2px solid gray;
    border-radius: 8px;
}
</style>
<body bgcolor = "#9c5916">
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
echo "<font_page><form action=\"delete_stock.php?id=$rs[0]&UserName=$UserName\" method=\"post\" >"?>
<table align="center"  width='800px' class = "round2" bgcolor = "white">
    <tr><td colspan='4' align='center' bgcolor = "lightgray"><h1> รายละเอียดสินค้า</h1></td></tr>
    <tr><td align='right'><br>รหัสสินค้า :</td> <td><br><?php echo "$rs[0]" ?></td><td rowspan='7' class="w3-btn w3-gray"><?php echo "<a href=\"editAmount_stock.php?id=$rs[0]&UserName=$UserName\">เพิ่มสินค้า";?></td>
    <tr><td align='right'>ชื่อสินค้า :</td> <td><?php echo "$rs[1]" ?></td>
    <tr><td align='right'>ประเภทสินค้า :</td> <td><?php echo GetTypeSelect($conn,$rs[2]);?></td>
    <tr><td align='right'>ขนาด :</td> <td><?php echo GetSizeSelect($conn,$rs[3]);?></td>
    <tr><td align='right'>สี :</td> <td><?php echo GetColorSelect($conn,$rs[4]);?></td></td>
    <tr><td align='right'>ราคาขาย :</td> <td><?php echo "$rs[5]" ?></td>
    <tr><td align='right'>ต้นทุน :</td> <td><?php echo "$rs[6]" ?></td>
    <tr><td align='right'>จำนวนสินค้าที่มี :</td> <td><?php echo "$rs[7]" ?></td><td rowspan='2' class="w3-btn w3-gray"><?php echo "<a href=\"edit_stock.php?id=$rs[0]&UserName=$UserName\">แก้ไขข้อมูล";?></td>
    <tr><td align='right'>รูปสินค้า :</td> <td><?php echo Getimg($Path,$rs[8]);?></td></td>
<?php echo "<tr><td colspan='4' align='center'><br><input type=\"submit\" value=\" Delete \" onclick=\"return confirm(' ยืนยันการลบ ID สมาชิก  = $rs[0] ')\" class=\"w3-btn w3-brown\"></td></tr>";?>
<br></table>
</form>
<?php
echo "<center><h4><a href=\"stock.php?UserName=$UserName\">ย้อนกลับ</h4></center>";
}else {
    echo "You not login.";
    echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
}
mysqli_close ( $conn );
function GetTypeSelect($conn,$id)
{
    $sqltxt = "SELECT * FROM type where TypeID = $id";
    $result1 = mysqli_query ( $conn ,$sqltxt );
    $rs1 = mysqli_fetch_array ( $result1 );
    return $rs1[1];
}
function GetColorSelect($conn,$id)
{
    $sqltxt = "SELECT * FROM color where colorID = $id";
    $result1 = mysqli_query ($conn ,$sqltxt);
    $rs1 = mysqli_fetch_array($result1);
    return $rs1[1];
}
function GetSizeSelect($conn,$id)
{
    $sqltxt = "SELECT * FROM size where sizeID = $id";
    $result1 = mysqli_query ( $conn ,$sqltxt );
    $rs1 = mysqli_fetch_array ( $result1 );
    return $rs1[1];
}

function Getimg($Path,$id){
    if(strlen( $id ) < 100){
        echo "<img src=$Path$id valign=middle align='center'
                width=\"150\" height = \"200\">";
    }else{
        $src = 'data:image/jpg;base64,'.$id; 
        echo "<img src=$src valign=middle align='center'
        width=\"150\" height = \"200\">";
    }
}






?>