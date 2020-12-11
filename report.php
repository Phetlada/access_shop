<html>
<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
<link rel="stylesheet" href="mystyle.css">
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
#customers {
  border-collapse: collapse;
  width: 80%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  background-color: #ff8080;
  color: white;
</style>
</head>
<body>
<?php
    session_start();
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
        <ul>
        <?php echo "<li><a href='welcome_admin.php?UserName=$UserName'>Home</a></li>"; ?>
        <li><a href="login.php">Logout</a></li>
        <ri>username :<?php echo " ",$UserName ?> </ri>
        <ri>Status :<?php echo " ",$rs['status'] ?> </ri>
        
        </ul>
        <?php
        $str = "SELECT * FROM report";
        $result1 = mysqli_query ($conn,$str) or die( mysqli_error($conn));
        $Path="image/"; //ระบุ path ของไฟล์รูปภาพที่จัดเก็บไว้ใน server
        echo "<font_page><center><h1>สรุปรายงานการขาย</h1>";
        echo "</center>";
        echo "<table align ='center'id=\"customers\" >";
        echo "<tr><th>ลำดับที่ </th><th>วันที่ออกใบ</th> <th>เลขที่ใบสั่งสินค้า</th><th>ชื่อผู้สั่ง</th>";
        echo "<th>ราคาต้นทุน</th><th>ราคาขาย</th><th>กำไร</th>";
        $a=1;
        $Cost = 0;
        $CostAll = 0;
        while ( $rs1 = mysqli_fetch_array ( $result1 ) )
        {
            echo "<form>";   
            echo "<tr><td> $a </td>";
            for($n = 0; $n < 6 ; $n++) { 
                if($n == 0){ 
                    echo "<td>" . $rs1[4] . "</td>";
                }
                else if($n == 1){
                    echo "<td>" . $rs1[0] . "</td>";
                }
                else if($n == 2){
                    echo "<td>" . $rs1[1] . "</td>";
                }
                else if($n == 3){
                    echo "<td>" . $rs1[2] . "</td>";
                }
                else if($n == 5){
                    $Cost = $rs1[3]-$rs1[2];
                    echo "<td>" . $Cost . "</td>";
                    $CostAll += $Cost; 
                }
                else echo "<td>" . $rs1[3] . "</td>";
            }
        echo "</tr>";
        
        $a++;
        }
        echo"<tr><th colspan = '7' align = 'right' > กำไรรวมทั้งหมด ". $CostAll ."  บาท</td></th></font_page>";
    }else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>