<!DOCTYPE html>
<html>
<title>menu</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<body    background = "pic/b56.jpg">

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>BR</b> Architects</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
    <a href="open_57.php" class="w3-bar-item w3-button">Back</a>
    <a href="register.php" class="w3-bar-item w3-button">Register</a>
      <a href="#about" class="w3-bar-item w3-button">Profile</a>
    
    </div>
  </div>
</div>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>login</title>

<!-- Bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<style type="text/css">
#btn{
	width:100%;
}
</style>
</head>
<br><br><br><br><br><br><br>
<form action="checkuser.php" method="post">
<div class="container" style="padding-top:100px">
  <div class="row">
  <div class="col-md-4"></div>
    <div class="col-md-4" style="background-color:#f4f4f4">
    <h3 align="center">
      <span class="glyphicon glyphicon-lock"> </span>
        Login <br> กรุณาป้อนชื่อผู้ใช้งานและรหัสผ่าน</h3>
    <table align="center" border='1' width='300' height = '300'>
        <tr><td><h3>Username</h3></td> <td><input type="text" name="UserName" ></td></td>
        <tr><td><h3>Password </h3></td> <td><input type="password" name="Password"></td></td>
        <tr><td colspan='2' align='center'><input type="submit" value=" OK "></td></tr>
    </table>
</form>

<br><a href='register.php'><center><h4>สมัครสมาชิก</h4></center></a>

<?php
    session_start();
    $_SESSION["basket_count"] = 0;
    $str =  $_SESSION['str'];
    echo $str;
    $str = '';
    $_SESSION['str'] = $str;
?>

