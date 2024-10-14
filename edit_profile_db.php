<meta charset="UTF-8" />
<?php
include('Connections/condb.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting( error_reporting() & ~E_NOTICE );

$mem_id = $_POST['mem_id'];
$mem_password = $_POST['mem_password'];
$mem_name = $_POST['mem_name'];
$mem_email = $_POST['mem_email'];
$mem_tel = $_POST['mem_tel'];
$mem_address = $_POST['mem_address'];
$do = $_POST['do'];
 

$sql ="UPDATE  tbl_member SET
		mem_password='$mem_password',
		mem_name='$mem_name',
		mem_email='$mem_email',
		mem_tel='$mem_tel',
		mem_address='$mem_address'
		
		WHERE mem_id=$mem_id ";
		
		$result = mysql_db_query($database_condb, $sql) or die("Error in query : $sql" .mysql_error());
 

		mysql_close();
		
		if($result){
			echo "<script>";
			echo "window.location ='profile.php?act=edit-ok&do=$do'; ";
			echo "</script>";
		} else {
			
			echo "<script>";
			echo "alert('ERROR!');";
			echo "window.location ='profile.php'; ";
			echo "</script>";
		}
		


?>