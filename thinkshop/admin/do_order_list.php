<?php
 include_once("./global.php");
 if(isset($_GET['oid'])){
	$oid=$_GET['oid'];
	$sql2="update ts_order set if_send=1 where oid='$oid'";
	mysql_query($sql2);
	if(mysql_affected_rows()==1){
		header("location:./order_list.php");
	}
}	
?>