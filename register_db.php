<meta charset="UTF-8" />
<?php
include('Connections/condb.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting( error_reporting() & ~E_NOTICE );

$mem_username = $_POST['mem_username'];
$mem_password = $_POST['mem_password'];
$mem_name = $_POST['mem_name'];
$mem_email = $_POST['mem_email'];
$mem_tel = $_POST['mem_tel'];
$mem_address = $_POST['mem_address'];

$check ="SELECT * FROM tbl_member  WHERE mem_username='$mem_username'";
$result1=mysql_db_query($database_condb, $check);
$num=mysql_num_rows($result1);

if($num > 0)
{
			echo "<script>";
			echo "alert('user นีมีผู้ใช้แล้ว กรุณาสมัครใหม่อีกครั้ง');";
			echo "window.location ='register.php'; ";
			echo "</script>";

} else {


$sql ="INSERT INTO tbl_member
		
		(mem_username,  mem_password, mem_name, mem_email, mem_tel, mem_address)
		
		VALUES
		
		('$mem_username', '$mem_password', '$mem_name', '$mem_email', '$mem_tel', '$mem_address')";
		
		$result = mysql_db_query($database_condb, $sql) or die("Error in query : $sql" .mysql_error());
}

		mysql_close();
		
		if($result){
			echo "<script>";
			echo "alert('สมัครสมาชิกเรียบร้อยแล้ว กรุณา login เพื่อเข้าซื้อสินค้า');";
			echo "window.location ='login.php'; ";
			echo "</script>";
		} else {
			
			echo "<script>";
			echo "alert('ERROR!');";
			echo "window.location ='index.php'; ";
			echo "</script>";
		}
		


?>