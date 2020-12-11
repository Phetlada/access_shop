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
    {
      $check = false;
      $ID = $_GET['id'];
      ?>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body >

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
</div>
<br><br><br><br>

<div class="w3-row-padding w3-grayscale">
    <div class="w3-col l3 m6 w3-margin-bottom">
    <?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "accessories";
    $conn = mysqli_connect( $hostname, $username, $password );
    if ( ! $conn ) die ( "ไม่สามารถติดต่อกับ MySQL ได้" );
    mysqli_select_db ( $conn,$dbname  )or die ( "ไม่สามารถเลือกฐานข้อมูล bookstore ได้" );
    mysqli_query($conn,"SET character_set_results=utf8");
    mysqli_query($conn,"SET character_set_client=utf8");
    mysqli_query($conn,"SET character_set_connection=utf8");
    $sqltxt = "SELECT *FROM acces WHERE accesID = '$ID'";    
    $result = mysqli_query ($conn,$sqltxt) or die( mysqli_error($conn));
    $Path="image/"; //ระบุ path ของไฟล์รูปภาพที่จัดเก็บไว้ใน server
    $rs = mysqli_fetch_array ( $result );
    ?>
<TABLE BORDER="1" CELLPADDING="2" CELLSPACING="2" WIDTH="400%" align="center" bgcolor = "white">
<TR>
<TD VALIGN="bottom" WIDTH="30%"><?php
    Getimg($Path,$rs[8]);
    ?></TD>

<TD WIDTH="30%"><?php
    echo "<center><h2> รหัสสินค้า : $rs[0] 
  </h2></center>";
    echo "<center><h2> ชื่อสินค้า : $rs[1]   </h2></center>";
    echo "<center><h2> ราคา :$rs[5] 
    </h2></center>";
  echo "<center><h2> colorID : ".GetColorSelect($conn,$rs[4])."
  </h2></center>";
  echo "<center><h2> stock : $rs[7] 
  </h2></center>";
  if($rs[7]-1 < 0 || $check == true)echo "<center><h2>สินค้าหมด</h2></center>";
  else if($rs[7]-1 >= 0){
      if($rs[7]-1 < 0)$check = true;
      echo "<center><h2><a href='add_basket.php?ID=$rs[0]&UserName=$UserName'>สั่งซื้อ</a></h2></center>";
      
  }
    ?>
    <?php
  }
      else {
          echo "You not login.";
          echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
      }
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
    $result1 = mysqli_query ( $conn ,$sqltxt );
    $rs1 = mysqli_fetch_array ( $result1 );
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
      $image = "<img src=$Path$id valign=middle align='center' width=\"800\" height = \"500\">";
              echo "<br>" . $image . "</br>";
  }else{
      $src = 'data:image/jpg;base64,'.$id;
      $image = "<img src=$src valign=middle align='center'width=\"800\" height = \"500\">";
      echo "<br>" . $image . "</br>";
  }
}
  ?>