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
echo "<font_page><form action=\"checkedit_stock.php?id=$rs[0]&UserName=$UserName\" method=\"post\">"?>
<table align="center" width='800px' border = "0" class = "round2" bgcolor = " white">
    <tr><td colspan='2' align='center' bgcolor = "lightgray"><h1> กรุณาป้อนข้อมูลสินค้า</h1></td></tr>
    <tr><td><br>รหัสสินค้า :</td> <td><br><?php echo "$rs[0]" ?></td></tr>
    <tr><td>ชื่อสินค้า :</td> <td><input type="text" name="Name" value = "<?php echo "$rs[1]" ?>"></td></tr>
    <tr><td>ประเภทสินค้า :</td><td><select name="Type" ><?php GetTypeSelect($rs[2]); ?></select></td></tr>
    <tr><td>ขนาด :</td><td><?php echo GetSizeSelect($conn,$rs[3]); ?></td></tr>
    <tr><td>สี :</td><td><select name="Color" ><?php GetColorSelect($rs[4]); ?></select></td></tr>
    <tr><td>ราคาขาย :</td> <td><input type="text" name="Price" value = "<?php echo "$rs[5]" ?>"></td></tr>
    <tr><td>ต้นทุน :</td> <td><input type="text" name="Cost" value = "<?php echo "$rs[6]" ?>"></td></tr>
    <tr><td>จำนวนสินค้าที่มี :</td> <td><input type="text" name="Stock" value = "<?php echo "$rs[7]" ?>"></td></tr>
    <tr><td>รูปสินค้า :</td><td><input type = "file" name = "ImageFile" value = "" ?></td></tr>
<?php echo "<tr><td colspan='2' align='center'><input type=\"submit\" value=\" OK \" class=\"w3-btn w3-brown\" onclick=\"return confirm(' ยืนยันการแก้ไขข้อมูล ID = $rs[0] ')\"></td></tr>";?>

</table>
</form>
<?php
echo "<center><h4><a href=\"detail_stock.php?id=$rs[0]&UserName=$UserName\">ย้อนกลับ</h4></center>";
}else {
    echo "You not login.";
    echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
}
mysqli_close ( $conn );
function GetColorSelect($ID)
{
    global $conn;
    $name = '';
    $sql = "SELECT * FROM color ORDER BY colorID";
    $dbquery = mysqli_query($conn,$sql);
    if (!$dbquery)die("(FunctionDB:GetTypeSelect) SELECT typebook มีข้อผิดพลาด".mysqli_error());
    if($ID == 0){
        echo "<option value=\"\">เลือกประเภทสินค้า</option>";
        while($result=mysqli_fetch_object($dbquery))
        {
            echo "<option value=\"$result->colorID\">";
            echo "$result->colorName</option>\n";
        }
    }else{
        while($result=mysqli_fetch_object($dbquery))
        {

            echo "<option value=\"$result->colorID == $ID\">";
            echo "$result->colorName</option>\n";
        }
        
    }

}
function GetTypeSelect($ID)
{
    global $conn;
    $sql = "SELECT * FROM type ORDER BY TypeID";
    $dbquery = mysqli_query($conn,$sql);
    if (!$dbquery)die("(FunctionDB:GetTypeSelect) SELECT typebook มีข้อผิดพลาด".mysqli_error());
    if($ID == 0){
        echo "<option value=\"\">เลือกประเภทสินค้า</option>";
        while($result=mysqli_fetch_object($dbquery))
        {
            echo "<option value=\"$result->TypeID\">";
            echo "$result->TypeName</option>\n";
        }
    }else{
        while($result=mysqli_fetch_object($dbquery))
        {

            echo "<option value=\"$result->TypeID == $ID\">";
            echo "$result->TypeName</option>\n";
        }
        
    }

}
function GetSizeSelect($conn,$id)
{
    $sqltxt = "SELECT * FROM size where sizeID = $id";
    $result1 = mysqli_query ( $conn ,$sqltxt );
    $rs1 = mysqli_fetch_array ( $result1 );
    return $rs1[1];
}
?> 