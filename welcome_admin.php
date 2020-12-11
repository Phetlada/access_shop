<html>
<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
<link rel="stylesheet" href="mystyle.css">
<head>
<style>
img.resize  {
    width: 300px;
    height:300px;
    border: 0;
}
img:hover.resize  {
    width: 400px;
    height: 400px;
    border: 0;
}
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

        mysqli_select_db ( $conn ,$dbname)or die ( "ไม่สํามํารถเลือกฐํานข ้อมูล test ได ้" );
        $sqltxt = "SELECT * FROM login where username = '$UserName'";
        $result = mysqli_query ( $conn,$sqltxt );
        $rs = mysqli_fetch_array ( $result );
/// admin################################################
    if ( $UserName == $_SESSION['UserName'] && $rs['status'] == "admin")
    {?>
    <ul>
    <li><a class="active" href="#home">Home</a></li>
    <li><a href="login.php">Logout</a></li>
    <ri>username :<?php echo " ",$UserName ?> </ri>
    <ri>Status :<?php echo " ",$rs['status'] ?> </ri>
    </ul>
    <br><br><br><br>
    <table width="90%" height="70%" align = "center" >
        <tr align = "center">
            <td ><?php echo "<a href='rist_user.php?UserName=$UserName'><img src='image/045-user.png'  alt='animate' class='resize'></a>" ?><br>
                <h3  class = "sarabun">ข้อมูลรายชื่อพนักงานและสมาชิก</h3></td>
            <td><?php echo "<a href='stock.php?UserName=$UserName' ><img src='image/095-box.png'  alt='animate' class='resize'></a>" ?><br>
                <h3 class = "sarabun">สต๊อคสินค้า</h3></td>
        </tr>
    </table>
    <?php
    /// manager################################################
    }
    else if( $UserName == $_SESSION['UserName'] && $rs['status'] == "manager"){
        ?>
        <ul>
        <li><a class="active" href="#home">Home</a></li>
        <li><a href="login.php">Logout</a></li>
        <ri>username :<?php echo " ",$UserName ?> </ri>
        <ri>Status :<?php echo " ",$rs['status'] ?> </ri>
        </ul>
        <br><br><br><br>
        <table width="90%" height="70%" align = "center" >
            <tr align = "center">
                <td ><?php echo "<a href='rist_user.php?UserName=$UserName'><img src='image/045-user.png'  alt='animate' class='resize'></a>" ?><br>
                    <h3  class = "sarabun">ข้อมูลรายชื่อพนักงานและสมาชิก</h3></td>
                <td><?php echo "<a href='stock.php?UserName=$UserName' ><img src='image/095-box.png'  alt='animate' class='resize'></a>" ?><br>
                    <h3 class = "sarabun">สต๊อคสินค้า</h3></td>
                <td><?php echo "<a href='report.php?UserName=$UserName'><img src='image/082-line-chart.png'  alt='animate' class='resize'></a>"?><br>
                    <h3 class = "sarabun">สรุปรายงานการขาย</h3></td>
            </tr>
        </table>
        <?php
    }
    else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }
?>

</body>
</html>