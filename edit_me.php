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
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "accessories";
$conn = mysqli_connect( $hostname, $username, $password );
if (!$conn ) die ( "ไม่ÿามารถติดต่อกับ MySQL ได้" );
mysqli_select_db ($conn ,  $dbname)or die ( "ไม่ÿามารถเลือกฐานข้อมูล itbookได้" );
$sqltxt = "SELECT * FROM login where username = '$UserName'";
$result = mysqli_query ( $conn,$sqltxt );
$rs = mysqli_fetch_array ( $result );
?>
<?php echo "<font_page><form action=\"checkedit_me.php?id=$rs[0]&UserName=$UserName\" method=\"post\">"?>
<table align="center" width='800px' border = "0" class = "round2" bgcolor = " white">
<tr><td colspan='2' align='center' bgcolor = "lightgray"><h1> กรุณาป้อนข้อมูล</h1></td></tr>
    <tr><td>userID : </td> <td><?php echo "$rs[0]" ?></td></td>
    <tr><td>Username : </td> <td><input type="text" name="username" value = "<?php echo "$rs[1]" ?>"></td></td>
    <tr><td>Password : </td> <td><input type="text" name="Password" value = "<?php echo $_SESSION['password']; ?>"></td></td>
    <tr><td>Name : </td> <td><input type="text" name="name" value = "<?php echo "$rs[4]" ?>"></td></td>
    <tr><td>Surname :</td> <td><input type="text" name="surname" value = "<?php echo "$rs[5]" ?>"></td></td>
    <tr><td>Sex : </td> <td><input type="text" name="sex" value = "<?php echo "$rs[6]" ?>"></td></td>
<?php echo "<tr><td colspan='2' align='center'><input type=\"submit\" value=\" OK \" class=\"w3-btn w3-brown\" onclick=\"return confirm(' ยืนยันการลบ ID สมาชิก  = $rs[0] ')\"></td></tr>";?>
</table>
</form>
<?php
echo "<center><h4><a href=\"rist_user.php?UserName=$UserName\">ย้อนกลับ</h4></center>";
}else {
    echo "You not login.";
    echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
}
?>