<meta charset="UTF-8" />
<?php
include('Connections/condb.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting( error_reporting() & ~E_NOTICE );
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
exit;
*/
 
 //Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');
	//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
	$date1 = date("Ymd_His");
	//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
	$numrand = (mt_rand());



//$bank = $_POST['bank'];

$resultb = $_POST['bank'];
$result_explode = explode('-', $resultb);
$b_name = $result_explode[0];
$b_number = $result_explode[1];
$pay_date = $_POST['pay_date'];
$pay_amount = $_POST['pay_amount'];
$order_id = $_POST['order_id'];
$order_status = 2;
$pay_slip = (isset($_POST['pay_slip']) ? $_POST['pay_slip'] : '');

$upload=$_FILES['pay_slip'];
	if($upload <> '') { 
 
	//โฟลเดอร์ที่เก็บไฟล์
	$path="pimg/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type = strrchr($_FILES['pay_slip']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname =$numrand.$date1.$type;
 
	$path_copy=$path.$newname;
	$path_link="pimg/".$newname;
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($_FILES['pay_slip']['tmp_name'],$path_copy);  
		
	
	}
 

 
$sql ="UPDATE tbl_order SET
		order_status='$order_status',
		pay_date='$pay_date',
		pay_amount='$pay_amount',
		b_name='$b_name',
		b_number='$b_number',		
		pay_slip='$newname'	
		WHERE order_id=$order_id
		";
		
		$result = mysql_db_query($database_condb, $sql) or die("Error in query : $sql" .mysql_error());
 

		mysql_close();
		/*
echo $sql;
exit();		
*/
		if($result){
			echo "<script>";
			echo "alert('อัพโหลดสลิปเรียบร้อยแล้ว');";
			echo "window.location ='my_order.php?order_id=$order_id&act=show-order'; ";
			echo "</script>";
		} else {
			
			echo "<script>";
			echo "alert('ERROR!');";
			echo "window.location ='my_order.php?order_id=$order_id&act=show-order'; ";
			echo "</script>";
		}
		


?>