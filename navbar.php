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

$colname_mlogin = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_mlogin = $_SESSION['MM_Username'];
}
mysql_select_db($database_condb, $condb);
$query_mlogin = sprintf("SELECT * FROM tbl_member WHERE mem_username = %s", GetSQLValueString($colname_mlogin, "text"));
$mlogin = mysql_query($query_mlogin, $condb) or die(mysql_error());
$row_mlogin = mysql_fetch_assoc($mlogin);
$totalRows_mlogin = mysql_num_rows($mlogin);
?>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">หน้าหลัก</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="how-to-buy.php">แจ้งชำระเงิน</a></li>
  
        </ul>
        <form class="navbar-form navbar-left" name="qp" action="index.php" method="GET">
        <div class="form-group"> &nbsp; 
        <b>  ค้นหาสินค้า  </b> 
          <input type="text" class="form-control" placeholder="ระบุคำค้น" name="q">
        </div>
        <button type="submit" class="btn btn-info">ค้นหา</button>
      </form>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="register.php">สมัครสมาชิก</a></li>
      	<li><a href="login_admin.php">Admin Login</a></li>
        
        <?php 
			$mm = ($_SESSION['MM_Username']);
			
			if($mm !=''){
				echo "<li>";
				echo "<a href='profile.php'>"."โปรไฟล์ :";
				echo  " คุณ" .$row_mlogin['mem_name'];
				echo "</a>";
				echo "</li>";
				
				echo "<li><a href='logout.php'>ออกจากระบบ</a></li>";
				
			}else{
				echo "<li><a href='login.php'>Login</a></li>";
				
			}

?>
        
        
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php
mysql_free_result($mlogin);
?>
