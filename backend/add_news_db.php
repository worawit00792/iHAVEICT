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
 

$n_title = $_POST['a_title'];
$n_detail = $_POST['a_detail'];
$n_img = (isset($_POST['n_img']) ? $_POST['n_img'] : '');

$upload=$_FILES['n_img'];
	if($upload <> '') { 
 
	//โฟลเดอร์ที่เก็บไฟล์
	$path="../nimg/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type = strrchr($_FILES['n_img']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname ='imgn'.$numrand.$date1.$type;
 
	$path_copy=$path.$newname;
	$path_link="../nimg/".$newname;
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($_FILES['n_img']['tmp_name'],$path_copy);  
		
	}else{}

$sql ="INSERT INTO tbl_news
		
		(n_title,  n_detail, n_img)
		
		VALUES
		
		('$n_title', '$n_detail', '$newname')";
		
		$result = mysql_db_query($database_condb, $sql) or die("Error in query : $sql" .mysql_error());
 

		mysql_close();
		
		if($result){
			echo "<script>";
			echo "alert('เพิ่มข่าวเรียบร้อยแล้ว');";
			echo "window.location ='list_news.php'; ";
			echo "</script>";
		} else {
			
			echo "<script>";
			echo "alert('ERROR!');";
			echo "window.location ='list_news.php'; ";
			echo "</script>";
		}
		


?>