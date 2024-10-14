<?php //require_once('../Connections/condb.php'); ?>
<?php
	error_reporting( error_reporting() & ~E_NOTICE );
    session_start(); 
	//print_r($_SESSION);
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

$colname_buyer = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_buyer = $_SESSION['MM_Username'];
}
mysql_select_db($database_condb, $condb);
$query_buyer = sprintf("SELECT * FROM tbl_member WHERE mem_username = %s", GetSQLValueString($colname_buyer, "text"));
$buyer = mysql_query($query_buyer, $condb) or die(mysql_error());
$row_buyer = mysql_fetch_assoc($buyer);
$totalRows_buyer = mysql_num_rows($buyer);

$colname_cartdone = "-1";
if (isset($_GET['order_id'])) {
  $colname_cartdone = $_GET['order_id'];
}
mysql_select_db($database_condb, $condb);
$query_cartdone = sprintf("
SELECT * FROM 
tbl_order as o, 
tbl_order_detail as d, 
tbl_product as p,
tbl_member  as m
WHERE o.order_id = %s 
AND o.order_id=d.order_id 
AND d.p_id=p.p_id
AND o.mem_id = m.mem_id 
ORDER BY o.order_date ASC", GetSQLValueString($colname_cartdone, "int"));
$cartdone = mysql_query($query_cartdone, $condb) or die(mysql_error());
$row_cartdone = mysql_fetch_assoc($cartdone);
$totalRows_cartdone = mysql_num_rows($cartdone);

?>


<table width="700" border="1" align="center" class="table">
  <tr>
    <td colspan="5" align="center"> <p align="center"> <button class="btn btn-primary btn-sm" onclick="window.print()"> พิมพ์ </button>  </p></td>
  </tr>
  <tr>
      <td width="1558" colspan="5" align="center">
     
      

      <strong>รายการสั่งซื้อคุณ<?php echo $row_cartdone['mem_name'];?>    <br />
      เบอร์โทร :  <?php echo $row_cartdone['phone'];?> <br />
      ที่อยู่ :<?php echo $row_cartdone['address'];?>  <br />
      วันที่ทำรายการ :   <?php echo $row_cartdone['order_date'];?> <br />
      <font color="red">  สถานะ : 
	  <?php 
	  $status =  $row_cartdone['order_status'];
	  include('status.php');
	  
	  ?>
	  <br />
      </font></strong>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top">
          <strong><font color="red"><br />
ชำระเงิน ธ.<?php echo $row_cartdone['b_name'];?> <br />
เลข บ/ช <?php echo $row_cartdone['b_number'];?> <br />
จำนวน <?php echo $row_cartdone['pay_amount'];?><br />
วันที่ชำระ <?php echo date('d/m/Y',strtotime($row_cartdone['pay_date']));?></font><br />
<h4 style="color:blue">
เลขพัสดุ :  <?php echo $row_cartdone['postcode'];?>
</h4>

          
          
          </td>
          <td><strong><font color="red">
          <img src="../pimg/<?php echo $row_cartdone['pay_slip'];?>"  width="200px"/></font></strong></td>
        </tr>
      </table>
      <strong><font color="red">  
     <div align="center"></div>
      
      </font></strong>
      </td>
  </tr>
    <tr class="success">
    <td align="center">รหัส</td>
      <td align="center">สินค้า</td>
      <td align="center">ราคา</td>
      <td align="center">จำนวน</td>
      <td align="center">รวม</td>
    </tr>
    <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_cartdone['d_id'];?></td>
      <td><?php echo $row_cartdone['p_name'];?></td>
      <td align="center"><?php echo $row_cartdone['p_price'];?></td>
      <td align="center"><?php echo $row_cartdone['p_c_qty'];?></td>
      <td align="center"><?php echo number_format($row_cartdone['total'],2);?></td>
    </tr> 
		<?php 
        $sum	= $row_cartdone['p_price']*$row_cartdone['p_c_qty'];
        $total	+= $sum;
        //echo $total;
        ?>
	<?php } while ($row_cartdone = mysql_fetch_assoc($cartdone)); ?>
    <tr>
      <td colspan="4" align="center">รวม</td>
      <td align="center"><b> <?php echo number_format($total,2);?></b></td>
    </tr>
    <tr>
      <td colspan="4" align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5">
      <?php 
      $pc = $_GET['pcode'];
	   //echo $pc;
	  if($status > 1) {
       if($pc==''){
       
      ?>
      <h3> แจ้งเลขพัสดุ </h3> 
      <form id="form1" name="form1" method="post" action="add_postcode_db.php">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="11%">เลขพัสดุ</td>
            <td width="42%">
            
<input name="postcode" type="text" id="postcode" size="40"  value="<?php echo $row_cartdone['postcode'];?>" required="required" placeholder="<?php echo $row_cartdone['postcode'];?>"/>
              <input name="order_id" type="hidden" id="order_id" value="<?php echo $_GET['order_id'];?>" />
              <input name="order_status" type="hidden" id="order_status" value="3" /></td>
            <td width="47%">
              <input type="submit" name="button" id="button" class="btn btn-primary" value="บันทึก" />
            
            </td>
          </tr>
      </table>
      </form>
      <?php 
  }else{ } }
      ?>
      </td>
    </tr>
     
</table>

 
<p>&nbsp;</p>
<p>&nbsp;</p>
		</div>
	</div>
</div>

<?php  
mysql_free_result($buyer);

mysql_free_result($cartdone);
?>