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
<?php
session_start();
$UserName = $_GET['UserName'];
if ( $UserName == $_SESSION['UserName']){
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
    $Name = $_POST['Name'];
    $Type = $_POST['Type'];
    $Color = $_POST['Color'];
    $Price = $_POST['Price'];
    $Cost = $_POST['Cost'];
    $Stock = $_POST['Stock'];
    $ImageFile = $_POST['ImageFile'];
    $ID = $_GET['id'];
    if(preg_match("/.jpg/",$ImageFile)||preg_match("/.png/",$ImageFile) ){
        $img = file_get_contents($ImageFile);
        $data = base64_encode($img); 
    }   
    $sql = "UPDATE `acces` SET `accesName` = '$Name', `TypeID` = '$Type', `colorID` = '$Color', `Price` = '$Price', `Cost` = '$Cost', `Stock` = '$Stock', 
    `Picture` = '$data' WHERE `acces`.`accesID` = $ID";
    mysqli_query($conn,$sql) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
    
    echo "<body = bgcolor = \"#9c5916\"><br><br><font_page><center><h1>แก้ไขสำเร็จ</h1><center><br>";
    echo "<a href=\"detail_stock.php?id=$ID&UserName=$UserName\"><img src='image/065-folder.png'width=\"300\" height = \"300\"></a><br>";
    echo "<br><a href=\"detail_stock.php?id=$ID&UserName=$UserName\">คลิกย้อนกลับ</a></font_page>";
    mysqli_close($conn); 
}else {
    echo "You not login.";
    echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
}