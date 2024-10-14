<?php require_once('Connections/condb.php'); ?>
<?php
session_start();
//print_r($_SESSION);
//echo $_SESSION['MM_Username'];
//echo "<hr>";
if($_SESSION['MM_Username'] !=''){
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_pf = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_pf = $_SESSION['MM_Username'];
}
mysql_select_db($database_condb, $condb);
$query_pf = sprintf("SELECT * FROM tbl_member WHERE mem_username = %s", GetSQLValueString($colname_pf, "text"));
$pf = mysql_query($query_pf, $condb) or die(mysql_error());
$row_pf = mysql_fetch_assoc($pf);
$totalRows_pf = mysql_num_rows($pf);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('h.php');?>
  </head>
  <body>
  <div class="container">
  <div class="row">
         <?php include('banner.php');?>
   </div>
  	<div class="row">
    	<div class="col-md-12">
        	<?php include('navbar.php');?>
        </div>
    </div>
 </div> 
 <!--start show  product-->
 <div class="container">
 	<div class="row">
    	<!-- menu-->
    	<div class="col-md-3">
        	  <?php include('m_menu.php');?>
        </div>
        <!-- content-->
        <div class="col-md-1"></div>
        <div class="col-md-6">
        
        	<?php 
			 $do = $_GET['do'];
			 if($do =='edit-profile'){
					include('edit_profile.php');
			 }else{
			?>
        	<p style="font-size:18px">
            โปรไฟล์ คุณ <?php echo $row_pf['mem_name']; ?>  <a href="profile.php?do=edit-profile" class="btn btn-warning btn-xs">แก้ไข</a> <br>
            Username : <?php echo $row_pf['mem_username']; ?> <br>
            ที่อยู่  : <?php echo $row_pf['mem_address']; ?> <br>
            อีเมล์ : <?php echo $row_pf['mem_email']; ?> <br>
            เบอร์โทร : <?php echo $row_pf['mem_tel']; ?> <br>
            เป็นสมาชิกเมื่อ : <?php echo $row_pf['dateinsert']; ?>
            </p>
            
            <?php } ?>
            
        </div>
    </div>
</div>
 <!--end show  product-->
 
 
 
 
 
  </body>
</html>
<?php
mysql_free_result($pf);
 } else{ include('logout.php'); }//seseion
?>
<?php include('f.php');?>