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
$query_listnews = "SELECT * FROM tbl_news ORDER BY n_id DESC";
$listnews = mysql_query($query_listnews, $condb) or die(mysql_error());
$row_listnews = mysql_fetch_assoc($listnews);
$totalRows_listnews = mysql_num_rows($listnews);
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
        <h3 align="center"> รายการข่าว  <a href="add_news.php" class="btn btn-primary"> + เพิ่ม </a> </h3>
          <table id="example" class="display" cellspacing="0" border="1">
		<thead>
            <tr align="center">
              <th width="5%">id</th>
              <th width="60%">รายละเอียดข่าว</th>
              <th width="5%">ภาพข่าว</th>
              <th width="5%">แก้ไข </th>
              <th width="5%">ลบ</th>
            </tr>
        </thead>
        <?php if($totalRows_listnews>0){?>
            <?php do { ?>
              <tr>
                <td valign="top">
				<center> <?php echo $row_listnews['n_id']; ?> 
                </center>
                </td>
                <td>
                <b>
				<?php echo $row_listnews['n_title']; ?>
                </b>
                <a href="news_detail.php?n_id=<?php echo $row_listnews['n_id'];?>" class="btn btn-info btn-xs" target="_blank">เพิ่มเติม</a><br />
                 ว/ด/ป :  <?php echo $row_listnews['date_save']; ?>
                </td>
                <td><center><img src="../nimg/<?php echo $row_listnews['n_img'];?>" width="100px"></center></td>
                <td><center> <a href="edit_news.php?n_id=<?php echo $row_listnews['n_id'];?>" class="btn btn-warning btn-xs"> แก้ไข </a> </center> </td>
                <td><center> <a href="del_news.php?n_id=<?php echo $row_listnews['n_id'];?>" onClick="return confirm('ยืนยันการลบ');" class="btn btn-danger btn-xs"> ลบ </a> </center> </td>
              </tr>
              <?php } while ($row_listnews = mysql_fetch_assoc($listnews)); ?>
              <?php } ?>
          </table>
        </div>
    </div>
 </div> 
  </body>
</html>
<?php
mysql_free_result($listnews);
?>
<?php  include('f.php');?>