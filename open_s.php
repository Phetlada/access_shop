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
<title>W3.CSS Template</title>
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
    <a href="open.php ?<?php echo "UserName=$UserName"?>" class="w3-bar-item w3-button">Back Menu</a>
    <a href="showbasket.php?UserName=<?php echo $UserName ?>">Basket :<?php echo " ",$count ?></a> 
      <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
      <a href="#about" class="w3-bar-item w3-button">Profile</a>
      <a href="contact.php ?<?php echo "UserName=$UserName"?>" class="w3-bar-item w3-button">Contact</a>
      Status :<?php echo " ",$rs['status'] ?>
      username :<?php echo " ",$UserName ?> 
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <img class="w3-image" src="pic/pop6.jpg" alt="Architecture" width="1500" height="800">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>Necklaces</b></span> 
  </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Project Section -->
  <div class="w3-container w3-padding-32" id="projects">
    <center><h2 class="w3-hide-small w3-text-light-black"><b>........merchandise........</b></h2></center>
  </div>
 

    <?php
      $sqltxt = "SELECT * FROM acces WHERE TypeID = '0100'";
      $result = mysqli_query ($conn,$sqltxt) or die( mysqli_error($conn));
      $Path="image/"; //ระบุ path ของไฟล์รูปภาพที่จัดเก็บไว้ใน server
      echo "<table align='center' width='100%'><tr>";
      $a=1;
      while ( $rs = mysqli_fetch_array ( $result ) )
      {
          for($n = 0; $n < 2 ; $n++) {
      
              if($n == 2){
                  echo ". <a href=\"detail_stock.php?id=$rs[0]&UserName=$UserName\" ";
                  echo ">$rs[0]</br>";
              }
              else if($n == 0){
                  Getimg($Path,$rs[8]);
              }
              else if($n == 1) echo "<a href=\"buy.php?id=$rs[0]&UserName=$UserName\"> <p><button class=\"w3-button w3-light-grey w3-block\"><b>see more</b> </button></p></a>";
              else if($n == 3)echo "  " . $rs[ 1 ] ."<br>";
              else echo "จำนวนสินค้าคงเหลือ " . $rs[7] . " ชิ้น<br><br></td >";
      }
      $a++; if($a%3 == 1)echo "</tr><tr>";
      }
      echo "</table>";
    ?>
</div>

<!-- Footer -->

</body>

</html>
<?php

}
    else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }  
function Getimg($Path,$id){
  if(strlen( $id ) < 100){
      $image = "<img src=$Path$id valign=middle align='center' width=\"300\" height = \"300\">";
              echo "<td align='center' ><br>" . $image . "</br>";
  }else{
      $src = 'data:image/jpg;base64,'.$id;
      $image = "<img src=$src valign=middle align='center'width=\"300\" height = \"300\">";
      echo "<td align='center'><br>" . $image . "</br>";
  }
}
?>