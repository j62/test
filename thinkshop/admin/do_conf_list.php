<?php
  include_once("./global.php");
  if(!isset($_POST['sub'])){
		msg("请提交表单","./conf_add.php");
		exit;
  }
	array_pop($_POST);//去除数组最后一个sub 方便下面的数组遍历修改
	foreach($_POST as $key=>$vo){
		$sql="update ts_sysconfig set sys_val='$vo' where sys_name='$key'";
		mysql_query($sql);
	}
	header("location:./conf_list.php"); 
?>