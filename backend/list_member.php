<?php require_once('../Connections/condb.php'); ?>
<?php
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

mysql_select_db($database_condb, $condb);
$query_listadmin = "SELECT * FROM tbl_member ORDER BY mem_id ASC";
$listadmin = mysql_query($query_listadmin, $condb) or die(mysql_error());
$row_listadmin = mysql_fetch_assoc($listadmin);
$totalRows_listadmin = mysql_num_rows($listadmin);
?>
<?php include('access.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('h.php');?>
    <?php include('datatable.php');?>
  </head>
  <body>
  <div class="container">
  <div class="row">
         <?php include('banner.php');?>
   </div>
  	<div class="row">
    	<div class="col-md-2">
        <b>  ADMIN : <?php include('mm.php');?> </b>
        <br>
        <?php include('menu.php');?>        	 
      </div>
        <div class="col-md-10">
        <h3 align="center"> รายการ สมาชิก  <a href="add_member.php" class="btn btn-primary"> + เพิ่ม </a> </h3>
          <table id="example" class="display" cellspacing="0" border="1">
		<thead>
            <tr align="center">
              <th>id</th>
              <th width="20%">ข้อมูล</th>
              <th width="50%">ที่อยู่</th>
              <th>แก้ไข </th>
              <th>ลบ</th>
            </tr>
        </thead>
        <?php if($totalRows_listadmin>0){?>
            <?php do { ?>
              <tr>
                <td><?php echo $row_listadmin['mem_id']; ?></td>
                <td> 
                ชื่อ :  <?php echo $row_listadmin['mem_name']; ?> <br>
                user: <?php echo $row_listadmin['mem_username']; ?> <br>
                pass : <?php echo $row_listadmin['mem_password']; ?>
                </td>
                <td>
				<?php echo $row_listadmin['mem_address']; ?> <br> 
                phone:  <?php echo $row_listadmin['mem_tel']; ?><br>
                email : <?php echo $row_listadmin['mem_email']; ?>
                
                </td>
                <td><center> <a href="edit_member.php?mem_id=<?php echo $row_listadmin['mem_id'];?>" class="btn btn-warning btn-xs"> แก้ไข </a> </center> </td>
                <td><center> <a href="del_member.php?mem_id=<?php echo $row_listadmin['mem_id'];?>" onClick="return confirm('ยืนยันการลบ');" class="btn btn-danger btn-xs"> ลบ </a> </center> </td>
              </tr>
              <?php } while ($row_listadmin = mysql_fetch_assoc($listadmin)); ?>
              <?php } ?>
          </table>
        </div>
    </div>
 </div> 
  </body>
</html>
<?php
mysql_free_result($listadmin);
?>
<?php  include('f.php');?>