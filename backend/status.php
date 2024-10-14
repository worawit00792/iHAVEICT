<?php 
if($status==1){
		  echo "<font color='red'>";
		  echo "รอชำระเงิน";
		  echo "</font>";
	  }elseif($status==2){
		  echo "<font color='green'>";
		  echo "ชำระเงินแล้ว";
		  echo "</font>";
	}elseif($status==3){
		  echo "<font color='green'>";
		  echo "ส่งของแล้ว";
		  echo "</font>";
	  } 
?>