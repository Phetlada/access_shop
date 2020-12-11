<?php
    session_start();
    $_SESSION['sold'] = '';
    $count = $_SESSION["basket_count"];
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

if ( $UserName == $_SESSION['UserName'])
    {?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
html {
  box-sizing: border-box;
    }

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left ;
  width:50%;
  margin-bottom: 16px;
  padding: 0 8px;
}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;


        }
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}
</style>
</head>
<!DOCTYPE html>
<html>
<title>menu</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>BR</b> Architects</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
    <a href="open.php ?<?php echo "UserName=$UserName"?>" class="w3-bar-item w3-button">Back Menu</a>
      <a href="lotout.php" class="w3-bar-item w3-button">Logout</a>
      <a href="#about" class="w3-bar-item w3-button">Profile</a>
    </div>
  </div>
</div>

<body>
<br><br><br><br>
<center><h2> Contact </h2>  </center>
<div class="row">
  <div class="column">
    <div class="card">
      <img src="pic/me2.jpg" style="width:100%">
      <div class="container">
        <h2>เพชรลดา ทองกาล</h2>
        <p class="title">ผู้ดูแล</p>
        <p>Nice to meet you . welcome to website of our</p>
        <p>  <a href="contact2.php ?<?php echo "UserName=$UserName"?>"  button class="button">Contact</button></p></a>
      </div>
    </div>
  </div>


  <div class="column">
    <div class="card">
      <img src="pic/me.jpg"  style="width:100%">
      <div class="container">
        <h2>หทัยรัตน์ ตันจิตวิริยะ</h2>
        <p class="title">ผู้ดูแล </p>
        <p>Nice to meet you . welcome to website of our</p>
        <p>    <a href="contact2.php ?<?php echo "UserName=$UserName"?>"  button class="button">Contact</button></p></a>
      </div>
    </div>
  </div>
</div>
</div>

</body>
</html>
<?php
}
    else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>


