<form action="register.php" method="post">
    <table align="center" border='1' width='300'>
        <tr><td colspan='2' align='center'> กรุณาป้อนข้อมูล</td></tr>
        <tr><td>Username :</td> <td><input type="text" name="username"></td></td>
        <tr><td>Password :</td> <td><input type="password" name="Password"></td></td>
        <tr><td>Name :</td> <td><input type="text" name="name"></td></td>
        <tr><td>Surname :</td> <td><input type="text" name="surname"></td></td>
        <tr><td>Sex :</td> <td><input type="text" name="sex"></td></td>
        <tr><td colspan='2' align='center'><input type="submit" value=" OK "></td></tr>
    </table>
</form>
<?php
if(isset($_POST['username']) != null){
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "accessories";
$conn = mysqli_connect( $hostname, $username, $password );

if (!$conn ) die ( "ไม่ÿามารถติดต่อกับ MySQL ได้" );
mysqli_select_db ($conn ,  $dbname)or die ( "ไม่ÿามารถเลือกฐานข้อมูล itbookได้" );  

    $UserName = $_POST['username'];
    $Password = md5($_POST['Password']);
    $Name = $_POST['name'];
    $SurName = $_POST['surname'];
    $Sex = $_POST['sex'];
    $ID = rand(150000, 200000);
    $Status = 'user';
    $sql = "INSERT INTO `login` (`userID`, `username`, `password`, `status`, `name`, `surname`, `sex`)VALUES('$ID', '$UserName', '$Password', '$Status', '$Name', '$SurName', '$Sex')";

mysqli_query($conn,$sql) or die("INSERT ลงตาราง book มีข้อผิดพลาดเกิดขึ้น".mysqli_error($conn));
echo "ลงทะเบียนสำเร็จ กลับไปยังหน้าล๊อคอิน";
echo "<br><a href='login.php'>คลิก กลับไปเพื่อ login </a>";
mysqli_close($conn);
}
?>