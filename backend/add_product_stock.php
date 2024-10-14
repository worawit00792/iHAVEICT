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
$query_ptype = "SELECT * FROM tbl_type";
$ptype = mysql_query($query_ptype, $condb) or die(mysql_error());
$row_ptype = mysql_fetch_assoc($ptype);
$totalRows_ptype = mysql_num_rows($ptype);

$colname_eprd = "-1";
if (isset($_GET['p_id'])) {
  $colname_eprd = $_GET['p_id'];
}
mysql_select_db($database_condb, $condb);
$query_eprd = sprintf("SELECT * FROM tbl_product WHERE p_id = %s", GetSQLValueString($colname_eprd, "int"));
$eprd = mysql_query($query_eprd, $condb) or die(mysql_error());
$row_eprd = mysql_fetch_assoc($eprd);
$totalRows_eprd = mysql_num_rows($eprd);

$colname_liststock = "-1";
if (isset($_GET['p_id'])) {
  $colname_liststock = $_GET['p_id'];
}
mysql_select_db($database_condb, $condb);
$query_liststock = sprintf("
SELECT * FROM tbl_product_stock  as s, tbl_product as p
WHERE s.p_id = %s  AND s.p_id=p.p_id
ORDER BY s.st_date DESC", GetSQLValueString($colname_liststock, "int"));
$liststock = mysql_query($query_liststock, $condb) or die(mysql_error());
$row_liststock = mysql_fetch_assoc($liststock);
$totalRows_liststock = mysql_num_rows($liststock);

$t_id=$_GET['t_id'];

mysql_select_db($database_condb, $condb);
$query_prd = "
SELECT * FROM  tbl_type as t
WHERE t.t_id=$t_id";
$prd = mysql_query($query_prd, $condb) or die(mysql_error());
$row_prd = mysql_fetch_assoc($prd);
$totalRows_prd = mysql_num_rows($prd);
?>
<?php include('access.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('h.php');?>
    <?php include('datatable2.php');?>
    <!-- ckeditor-->
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

  </head>
  <body>
  <div class="container">
  <div class="row">
  <span id="hp">
         <?php include('banner.php');?>
  </span>
   </div>
  	<div class="row">
    	<div class="col-md-2">
        <b>  ADMIN : <?php include('mm.php');?> </b>
        <br>
        <span id="hp">
        <?php include('menu.php');?> 
        </span>       	 
      </div>
      <div class="col-md-10">
      <span id="hp">
        <h3 align="center"> จัดการสต็อกสินค้า 
         
       	  <?php include('edit-ok.php');?>
        </h3>
        
        		<form action="add_product_stock_db.php"  method="post" enctype="multipart/form-data" name="Add_Product" id="Add_Product" >

  
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td width="129" align="right" valign="middle">ชื่อสินค้า :</td>
      <td width="471" colspan="2">
        <?php echo $row_eprd['p_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp; ราคา<?php echo $row_eprd['p_price']; ?>บาท</td>
    </tr>
    <tr>
      <td align="right" valign="middle">ประเภทสินค้า :</td>
      <td colspan="2">
  <?php echo $row_ptype['t_name']?>
        </td>
    </tr>
    <tr>
      <td align="right" valign="top">รายละเอียดสินค้า :</td>
      <td colspan="2">
        <?php echo $row_eprd['p_detial']; ?>
        </td>
    </tr>
    <tr>
      <td align="right" valign="middle"><b> จำนวนสินค้าคงเหลือ </b></td>
      <td colspan="2"> :<font color="red"> <b> <?php echo $row_eprd['p_qty']; ?> </b> </font> <?php echo $row_eprd['p_unit'];?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">เพิ่มสินค้า</td>
      <td colspan="2"><label>
        <input type="number" name="p_qty" id="p_qty" required min="1">
        <input name="p_id" type="hidden" id="p_id" value="<?php echo $row_eprd['p_id']; ?>">
        <input name="p_stock" type="hidden" id="p_stock" value="<?php echo $row_eprd['p_qty']; ?>">
        <input name="t_id" type="hidden" id="t_id" value="<?php echo $row_eprd['t_id']; ?>">
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><button type="submit" name="button" id="button" value="ตกลง" class="btn btn-success">บันทึก</button></td>
    </tr>
  </table> 
</form>
 </span>         
          
          <br>
        <h3 align="center"> ประวัติการเพิ่มสต๊อก </h3>
        <p align="center"> <button class="btn btn-primary btn-sm" onclick="window.print()"> พิมพ์ </button>  </p>
        สินค้าคงเหลือ <font color="red"> <b> <?php echo $row_eprd['p_qty']; ?> </b> </font> <?php echo $row_eprd['p_unit'];?>
       <table id="example" class="display" cellspacing="0" border="1">
		<thead>
          <tr>
            <th>ลำดับ</th>
            <th>รหัสสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>จำนวน</th>
            <th>วันที่ทำรายการ</th>
          </tr>
          </thead>
          <?php $i=1; do { ?>
            <tr>
              <td align="center"><?php echo $i; ?></td>
              <td align="center"><?php echo $row_liststock['p_id']; ?></td>
              <td><?php echo $row_liststock['p_name']; ?></td>
              <td align="center"><?php echo $row_liststock['p_qty_add']; ?></td>
              <td><?php echo $row_liststock['st_date']; ?></td>
          </tr>
          <?php $i++; } while ($row_liststock = mysql_fetch_assoc($liststock)); ?>
        </table>
      </div>
    </div>
 </div> 
 

 
  </body>
</html>
<?php
mysql_free_result($ptype);

mysql_free_result($eprd);

mysql_free_result($liststock);

mysql_free_result($prd);
?>
<?php include('f.php');?>