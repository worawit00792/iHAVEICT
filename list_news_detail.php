<?php require_once('Connections/condb.php'); ?>
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
$n_id = $_GET['n_id'];
mysql_select_db($database_condb, $condb);
$query_listnews = "SELECT * FROM tbl_news WHERE n_id=$n_id";
$listnews = mysql_query($query_listnews, $condb) or die(mysql_error());
$row_listnews = mysql_fetch_assoc($listnews);
$totalRows_listnews = mysql_num_rows($listnews);
?>
<?php include('h.php');?>
          <table id="example" class="table table-hover" cellspacing="0" border="1">
		<thead>
            <tr class="success">
              <th width="30%" height="40">รายละเอียดข่าว  / <a href="news.php"> ย้อนกลับ </a> </th>
              <th width="70%">&nbsp;</th>
            </tr>
        </thead>
  
              <tr>
                <td width="30%"><img src="nimg/<?php echo $row_listnews['n_img'];?>" width="100%" /></td>
                <td width="70%" align="left" valign="top"><b> <br />
                  หัวข้อข่าว : <?php echo $row_listnews['n_title']; ?> </b> <br />
  <b> รายละเอียดข่าว : </b> <?php echo $row_listnews['n_detail']; ?> <br />
                  ว/ด/ป : <?php echo date('d/m/Y' , strtotime($row_listnews['date_save'])); ?></td>
              </tr>
              
          </table>
        </div>
    </div>
 </div> 

<?php
mysql_free_result($listnews);
?>
 