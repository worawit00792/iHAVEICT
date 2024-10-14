<meta charset="UTF-8" />
<?php
include('../Connections/condb.php');
error_reporting( error_reporting() & ~E_NOTICE );
 
 //Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');
	//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
	$date1 = date("Ymd_His");
	//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
	$numrand = (mt_rand());
 
$b_id = $_POST['b_id'];
$b_name = $_POST['b_name'];
$b_number = $_POST['b_number'];
$b_type = $_POST['b_type'];
$bn_name = $_POST['bn_name'];
$b_owner = $_POST['b_owner'];
$img = $_POST['img'];

$b_logo = (isset($_POST['b_logo']) ? $_POST['b_logo'] : '');

$upload=$_FILES['b_logo']['name'];
	if($upload <> '') { 
 
	//โฟลเดอร์ที่เก็บไฟล์
	$path="../bimg/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type = strrchr($_FILES['b_logo']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname ='imgb'.$numrand.$date1.$type;
 
	$path_copy=$path.$newname;
	$path_link="../bimg/".$newname;
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($_FILES['b_logo']['tmp_name'],$path_copy);  
		
	}else{
		$newname=$img;
		}

$sql ="UPDATE tbl_bank SET
		
		 b_name='$b_name',
		 b_number='$b_number',
		 b_type='$b_type',
		 bn_name='$bn_name',
		 b_owner='$b_owner',
		 b_logo='$newname'
		
		WHERE b_id=$b_id
		";
		
		$result = mysql_db_query($database_condb, $sql) or die("Error in query : $sql" .mysql_error());
 
		mysql_close();
		
		if($result){
			echo "<script>";
			echo "alert('แก้ไขข้อมูลเรียบร้อยแล้ว');";
			echo "window.location ='list_bank.php'; ";
			echo "</script>";
		} else {
			
			echo "<script>";
			echo "alert('ERROR!');";
			echo "window.location ='list_bank.php'; ";
			echo "</script>";
		}
		


?>