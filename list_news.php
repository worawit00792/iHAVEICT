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

mysql_select_db($database_condb, $condb);
$query_listnews = "SELECT * FROM tbl_news ORDER BY n_id DESC";
$listnews = mysql_query($query_listnews, $condb) or die(mysql_error());
$row_listnews = mysql_fetch_assoc($listnews);
$totalRows_listnews = mysql_num_rows($listnews);
?>
<?php include('h.php');?>
          <table id="example" class="table table-hover" cellspacing="0" border="1">
		<thead>
            <tr class="success">
              <th width="5%" height="40"><center>
                ภาพข่าว
              </center> </th>
              <th width="60%">รายละเอียดข่าว</th>
            </tr>
        </thead>
            <?php $i=1; do { ?>
              <tr>
                <td valign="top">
				<center> <img src="nimg/<?php echo $row_listnews['n_img'];?>" width="80px" />
				</center>
                </td>
                <td>
                <b>
				 <a href="news.php?n_id=<?php echo $row_listnews['n_id'];?>&news-detail"> <?php echo $row_listnews['n_title']; ?>
                 <span class="glyphicon glyphicon-search"></span>
                 </a>
                </b>
               <br>
                 ว/ด/ป : 
                 
                 <?php echo date('d/m/Y' , strtotime($row_listnews['date_save'])); ?>

                </td>
              </tr>
              <?php $i++; } while ($row_listnews = mysql_fetch_assoc($listnews)); ?>
          </table>
        </div>
    </div>
 </div> 

<?php
mysql_free_result($listnews);
?>
 