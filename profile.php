<?php
        
    session_start();
    $UserName = $_GET['UserName'];
    if ( $UserName == $_SESSION['UserName']){
        connect($UserName);
        
    }else {
        echo "You not login.";
        echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
    }

function connect($UserName){
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
    echo "<html><head><title>database</title></head><body bgcolor = \"#ffff99\">
    <link href=\"https://fonts.googleapis.com/css?family=Sarabun&display=swap\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"mystyle.css\">
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        }
    th, td {
        text-align: center;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
        background-color: #4CAF50;
        color: white;
        }
        
</style>
    ";
    $manager = check_manager($conn,$UserName); 
    header_page($conn,$UserName);
    echo "<font_page><CENTER><H1>รายชื่อบัญชีผู้ใช้</H1></CENTER>";
    echo "<table align=\"center\" border='0' width='100%' >
        <tr align = \"center\">
            <td bgcolor = \"#004d00\" rowspan = '2'>
            <img src=image/045-user.png width=\"220\" height = \"200\">";
                me($conn,$UserName); echo "
            </td>
        </tr>
        <tr><td>"; 
                if($manager == true)
                {
                    echo "<a href='insert_admin.php?UserName=$UserName'><img src='image/045-user.png'width=\"50\" height = \"50\"></a><br>";
                    echo "<a class = \"button_red\" href='insert_admin.php?UserName=$UserName' >[เพิ่มแอดมิน]</a>";
                
                }
                echo "</font_page></body></html>";
            echo "</tr><table>";
}
function check_manager($conn,$UserName){
    $sqltxt = "SELECT * FROM login where username = '$UserName'";
    $result = mysqli_query ( $conn,$sqltxt );
    $rs = mysqli_fetch_array ( $result );
    if($rs["status"] == 'manager')return true;
    else return false;
}
function me($conn,$UserName){
    $sqltxt = "SELECT * FROM login where username = '$UserName'";
    $result = mysqli_query ( $conn,$sqltxt );
    $rs = mysqli_fetch_array ( $result );
    echo "<font_page><table border=1 align=center bgcolor=#ffff66 width=100%>";
    echo "<tr><td align=center colspan=9 bgcolor =#b38f00>";
    echo "<B>ข้อมูลของฉัน</B></td></tr>";
    echo "<tr><td> ID :".$rs["userID"]."</td></tr>";
    echo "<tr><td> UserName :".$rs["username"]."</td></tr>";
    echo "<tr><td> Status :".$rs["status"]."</td></tr>";
    echo "<tr><td> Password : ".$rs["password"]."</td></tr>";
    echo "<tr><td> Name : ".$rs["name"]."</td></tr>";
    echo "<tr><td> Surname : ".$rs["surname"]."</td></tr>";
    echo "<tr><td> Sex : ".$rs["sex"]."</td></tr>";
    echo "<tr><td align=\"center\"> <a href=\"delete.php?id=$rs[0]&UserName=$UserName&me=1\" ";
    echo "onclick=\"return confirm(' ยืนยันการลบ ID สมาชิก VIP  = $rs[0] ')\">[ลบ] ";
    echo "</a></font></td></tr>";
    echo "<tr><td align=\"center\"> <a href=\"edit_me.php?id=$rs[0]&UserName=$UserName\" ";
    echo "onclick=\"return confirm(' ยืนยันแก้ไขข้อมูล ID = $rs[0] ')\">[แก้ไข] ";
    echo "</a></font></td></tr>";
    echo "</table></font_page>";
}
function header_page($conn,$UserName){
    $sqltxt = "SELECT * FROM login where username = '$UserName'";
    $result = mysqli_query ( $conn,$sqltxt );
    $rs = mysqli_fetch_array ( $result );
    ?>
    <ul>
    <li><?php echo "<a href='welcome_admin.php?UserName=$UserName'>Home</a>";?></li>
    <li><a href="login.php">Logout</a></li>
    <ri>username :<?php echo " ",$UserName ?> </ri>
    <ri>Status :<?php echo " ",$rs['status'] ?> </ri>
    </ul>
    <br>
    <?php
}
?>