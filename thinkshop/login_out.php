<?php
 include_once("./global.php");
 if(isset($_SESSION['user'])){
	$_SESSION=array();
	session_destroy();
	header("location:./index.php");
 }else{
	if(isset($_SESSION['user'])){
		msg("退出失败","./index.php");
	}
 
 }
?>