<meta charset="UTF-8" />
<?php
include('../Connections/condb.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting( error_reporting() & ~E_NOTICE );

$mem_id = $_GET['mem_id'];



$sql ="DELETE FROM tbl_member WHERE mem_id=$mem_id";
		
		$result = mysql_db_query($database_condb, $sql) or die("Error in query : $sql" .mysql_error());
 

		mysql_close();
		
		if($result){
			echo "<script>";
			echo "window.location ='list_member.php'; ";
			echo "</script>";
		} else {
			
			echo "<script>";
			echo "alert('ERROR!');";
			echo "window.location ='list_member.php'; ";
			echo "</script>";
		}
		


?>