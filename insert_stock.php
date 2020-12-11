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

echo "<font_page><form action=\"insert_stock.php?UserName=$UserName\" method=\"post\">"?>
<table align="center" width='800px' border = "0" class = "round2" bgcolor = " white">
    <tr><td colspan='2' align='center' bgcolor = "lightgray"><h1> กรุณาป้อนข้อมูลสินค้า</h1></td></tr>
    <tr><td align='right'><br>รหัสสินค้า :</td> <td ><input type="text" name="ID" ></td></tr>
    <tr><td align='right'>ชื่อสินค้า :</td> <td><input type="text" name="Name"  ></td></tr>
    <tr><td align='right'>ประเภทสินค้า :</td><td><select name="Type" ><?php GetTypeSelect(0); ?></select></td></tr>
    <tr><td align='right'>ขนาด :</td><td><input type="text" name="Size" value = "01" >free size</td></tr>
    <tr><td align='right'>สี :</td><td><select name="Color" ><?php GetColorSelect(0); ?></select></td></tr>
    <tr><td align='right'>ราคาขาย :</td> <td><input type="text" name="Price"></td></tr>
    <tr><td align='right'>ต้นทุน :</td> <td><input type="text" name="Cost"></td></tr>
    <tr><td align='right'>จำนวนสินค้าที่มี :</td> <td><input type="text" name="Stock" ></td></tr>
    <tr><td align='right'>รูปสินค้า :</td><td><input type = "file" name = "ImageFile" ></td></tr>
<?php echo "<tr><td colspan='2' align='center' ><input type=\"submit\" value=\" OK \" class=\"w3-btn w3-brown\" onclick=\"return confirm(' ยืนยันการเพิ่มข้อมูล')\"></td></tr>";?>
    </table>
</form>
<?php
echo "<center><h4><a href=\"stock.php?UserName=$UserName\">ย้อนกลับ</h4></center>";
if ($UserName == $_SESSION['UserName']){
    
    if(isset($_POST['ID']) != NULL && isset($_POST['Name']) != NULL && isset($_POST['Type']) != NULL &&
    isset($_POST['Color']) != NULL && isset($_POST['Price']) != NULL){

    $ID= $_POST['ID'];
    $Name = $_POST['Name'];
    $Type = $_POST['Type'];
    $Size= $_POST['Size'];
    $Color = $_POST['Color'];
    $Price = $_POST['Price'];
    $Cost= $_POST['Cost'];
    $Stock= $_POST['Stock'];
    $ImageFile = $_POST['ImageFile'];
    $data = '';
    if(preg_match("/.jpg/",$ImageFile)||preg_match("/.png/",$ImageFile) ){
        $img = file_get_contents($ImageFile);
        $data = base64_encode($img); 
    }   
    $sql = "INSERT INTO `acces` (`accesID`, `accesName`, `TypeID`, `Size`, `colorID`, `Price`, `Cost`, `Stock`,`Picture`)
    VALUES('$ID', '$Name', '$Type', '$Size', '$Color', '$Price', '$Cost','$Stock','$data')";

    mysqli_query($conn,$sql) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
    
    echo "<a href='stock.php?UserName=$UserName'><img src='image/note.png'width=\"50\" height = \"50\"></a><br>";
    echo "เพิ่มรายการสินค้าสำเร็จ<br>";
    echo "</font_page>";
    mysqli_close($conn); 
}
}else {
    echo "You not login.";
    echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
}
function GetColorSelect($ID)
{
    global $conn;
    $sql = "SELECT * FROM color ORDER BY colorID";
    $dbquery = mysqli_query($conn,$sql);
    if (!$dbquery)die("(FunctionDB:GetTypeSelect) SELECT typebook มีข้อผิดพลาด".mysqli_error());
    if($ID == 0){
        echo "<option value=\"\">เลือกสีสินค้า</option>";
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