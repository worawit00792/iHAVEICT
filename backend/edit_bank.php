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

$colname_eb = "-1";
if (isset($_GET['b_id'])) {
  $colname_eb = $_GET['b_id'];
}
mysql_select_db($database_condb, $condb);
$query_eb = sprintf("SELECT * FROM tbl_bank WHERE b_id = %s", GetSQLValueString($colname_eb, "int"));
$eb = mysql_query($query_eb, $condb) or die(mysql_error());
$row_eb = mysql_fetch_assoc($eb);
$totalRows_eb = mysql_num_rows($eb);
?>
<?php include('access.php');?>
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
    	<div class="col-md-2">
        <b>  ADMIN : <?php include('mm.php');?> </b>
        <br>
        <?php include('menu.php');?>        	 
      </div>
      <div class="col-md-10">
        <h3 align="center"> แก้ไขรายการธนาคาร</h3>
        
        		<form action="edit_bank_db.php"  method="post" enctype="multipart/form-data" name="Add_Product" id="Add_Product" >

  
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td width="129" align="right" valign="middle">ธนาคาร :</td>
      <td width="471" colspan="2"><label for="b_type"></label>
        <input name="b_name" type="text" required id="pro_name2" value="<?php echo $row_eb['b_name']; ?>" size="60"/></td>
    </tr>
    <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="middle">เลขบัญชี :</td>
      <td colspan="2"><input name="b_number" type="text" required id="b_number" value="<?php echo $row_eb['b_number']; ?>" size="60"/></td>
    </tr>
    <tr>
      <td align="right" valign="top">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="middle">ประเภท :</td>
      <td colspan="2"><input name="b_type" type="text" required id="pro_name3" value="<?php echo $row_eb['b_type']; ?>" size="40"/></td>
    </tr>
    <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="middle">สาขา :</td>
      <td colspan="2"><input name="bn_name" type="text" required id="pro_name4" value="<?php echo $row_eb['bn_name']; ?>" size="60"/></td>
    </tr>
    <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="middle">ชื่อเจ้าของ บ/ช :</td>
      <td colspan="2"><input name="b_owner" type="text" required id="pro_name5" value="<?php echo $row_eb['b_owner']; ?>" size="60"/></td>
    </tr>
    <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
      <td align="right" valign="middle">Logo</td>
      <td colspan="2"><label for="b_logo"></label>
        <input type="file" name="b_logo" id="b_logo"></td>
    </tr>
    <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2"><input name="b_id" type="hidden" id="b_id" value="<?php echo $row_eb['b_id']; ?>">
        <input name="img" type="hidden" id="img" value="<?php echo $row_eb['b_logo']; ?>"></td>
    </tr>
    <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2">logo เก่า<br>
	   <img src="../bimg/<?php echo $row_eb['b_logo']; ?>" width="90px"></td>
    </tr>
    <tr>
      <td align="right" valign="middle">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">
      <button type="submit" name="button" id="button" value="ตกลง" class="btn btn-primary">บันทึก</button></td>
    </tr>
  </table> 
</form>
            
      </div>
    </div>
 </div> 
  </body>
</html>
<?php
mysql_free_result($eb);
?>
<?php include('f.php');?>