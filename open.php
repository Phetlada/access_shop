
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
<title>menu</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body background="pic/bk18.jpg">

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>BR</b> Architects</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="showbasket.php?UserName=<?php echo $UserName ?>">Basket :<?php echo " ",$count ?></a> 
      <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
      <a href="profile.php?UserName=<?php echo $UserName ?>" class="w3-bar-item w3-button">Profile</a>
      <a href="contact.php ?<?php echo "UserName=$UserName"?>" class="w3-bar-item w3-button">Contact</a>
      Status :<?php echo " ",$rs['status'] ?>
      username :<?php echo " ",$UserName ?> 
      
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <img class="w3-image" src="pic/pop4.jpg" alt="Architecture" width="1500" height="800">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>Find Your Style</b></span></h1>
  </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Project Section -->
  <div class="w3-container w3-padding-32" id="projects">
    <center><h2 class="w3-hide-small w3-text-light-black"><b>........merchandise........</b></h2></center>
  </div>

  <div class="w3-row-padding w3-grayscale">
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="pic/new7.jpg"  style="width:98%  ">
      <center><h3>สร้อยคอ</h3></center>
      <p><a href="open_s.php?<?php echo "UserName=$UserName"?>" button class="w3-button w3-light-grey w3-block"><b>see more</b> </button></p></a>
    </div>

    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="pic/new1.jpg" style="width:101%">
      <center><h3>กำไร</h3></center>
      <p><a href="open_s2.php?<?php echo "UserName=$UserName"?>"button class="w3-button w3-light-grey w3-block"><b>see more</b></button></p></a>
    </div>

    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="pic/new6.jpg" style="width:102%">
      <center><h3>ต่างหู</h3></center>
      <p><a href="open_s4.php?<?php echo "UserName=$UserName"?>" button class="w3-button w3-light-grey w3-block"><b>see more</b></button></p></a>
    </div>


    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="pic/new4.jpg"  style="width:90%">
      <center><h3>ตุ้มหู</h3></center>
      <p><a href="open_s3.php?<?php echo "UserName=$UserName"?>" button class="w3-button w3-light-grey w3-block"><b>see more</b></button></p></a>
    </div>
  </div>

  <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="pic/new8.jpg"  style="width:96%" >
      <center> <h3>เข็มกัด</h3></center>
      <p><a href="open_s5.php?<?php echo "UserName=$UserName"?>" button class="w3-button w3-light-grey w3-block"><b>see more</b></button></p></a>
    </div>
  </div>

  
 <div class="w3-col l3 m6 w3-margin-bottom"  style="width:19% ">
      <img src="pic/new13.jpg"  style="width:100%">
      <center><h3>แหวน</h3></center>
  <p><a href="open_s8.php?<?php echo "UserName=$UserName"?>" button class="w3-button w3-light-grey w3-block "> <b>see more</b></button></p></a>
    </div>
  </div>
  
    
<!-- Image of location/map
<div class="w3-container">
  <img src="/w3images/map.jpg" class="w3-image" style="width:100%">
</div> -->

<!-- End page content 
</div>-->


<!-- Footer -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer class="w3-center w3-black w3-padding-16">
  <p><a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>

</body>
</html>
<?php
}
    else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>