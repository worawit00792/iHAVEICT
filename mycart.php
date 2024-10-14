<?php // require_once('Connections/condb.php'); ?>
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


$colname_mm = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_mm = $_SESSION['MM_Username'];
}
mysql_select_db($database_condb, $condb);
$query_mm = sprintf("SELECT * FROM tbl_member WHERE mem_username = %s", GetSQLValueString($colname_mm, "text"));
$mm = mysql_query($query_mm, $condb) or die(mysql_error());
$row_mm = mysql_fetch_assoc($mm);
$totalRows_mm = mysql_num_rows($mm);

$mem_id = $row_mm['mem_id'];

mysql_select_db($database_condb, $condb);
$query_mycart = sprintf("
SELECT 
o.order_id as oid, o.mem_id, o.order_status, o.order_date,
d.order_id , COUNT(d.order_id) as coid, SUM(d.total) as ctotal
FROM tbl_order  as o, tbl_order_detail as d
WHERE o.mem_id =$mem_id 
AND o.order_id=d.order_id
GROUP BY o.order_id
ORDER BY o.order_id DESC", GetSQLValueString($colname_mycart, "int"));
$mycart = mysql_query($query_mycart, $condb) or die(mysql_error());
$row_mycart = mysql_fetch_assoc($mycart);
$totalRows_mycart = mysql_num_rows($mycart);

?>
<?php //include('datatable.php');?>

 <p align="center"> <button class="btn btn-primary btn-sm" onclick="window.print()"> พิมพ์ </button>  </p>
 
<table id="example" class="display" cellspacing="0" border="1">
<thead>
  <tr>
    <th>รหัสสั่งซื้อ</th>
    <th>จำนวนรายการ</th>
    <th>ราคารวม</th>
    <th>สถานะ</th>
    <th>วันที่ทำรายการ</th>
  </tr>
  </thead>
  <?php do { ?>
    <tr>
      <td>
      
	  <?php echo $row_mycart['oid']; ?>
      <span id="hp">
      <a href="my_order.php?order_id=<?php echo $row_mycart['oid']; ?>&act=show-order">
      <span class="glyphicon glyphicon-zoom-in"></span>
      </a>
      </span>
      </td>
      <td align="center">
      <?php echo $row_mycart['coid'];?>
      </td>
       <td align="center">
      <?php echo number_format($row_mycart['ctotal'],2);?>
      </td>
      <td align="center">
      <font color="red">
      <?php 
	  $status =  $row_mycart['order_status'];
	 include('backend/status.php');
	  ?>  
      </font>
      
      
      </td>
      <td><?php echo $row_mycart['order_date']; ?></td>
    </tr>
    <?php } while ($row_mycart = mysql_fetch_assoc($mycart)); ?>
</table>

<?php
mysql_free_result($mycart);

mysql_free_result($mm);
?>
