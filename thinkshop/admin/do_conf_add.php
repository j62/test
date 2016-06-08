<?php
 include_once("./global.php");
 if(!isset($_POST['sub'])){
	msg("请提交表单","./conf_add.php");
	exit;
 }
 //Array ( [sys_title] => 网站关键字 [sys_name] => key [sys_val] => 商城 [sys_type] => text [sub] => 添加 )
 $sys_title=trim($_POST['sys_title']);
 $sys_name=trim($_POST['sys_name']);
 $sys_val=trim($_POST['sys_val']);
 $sys_type=trim($_POST['sys_type']);
 if($sys_title==''||$sys_name==''||$sys_val==''){
	msg("请把表单填写完整","./conf_add.php");
	exit;
 }
 $sql1="select * from ts_sysconfig where sys_name='$sys_name'";
 $re=mysql_query($sql1);
 if(mysql_num_rows($re)==1){
	msg("配置项名称重复","./conf_add.php");
	exit;
 }
 $sql="insert into ts_sysconfig (sys_title,sys_name,sys_val,sys_type)value('$sys_title','$sys_name','$sys_val','$sys_type')";
 mysql_query($sql);
 if(mysql_affected_rows()==1){
	header("location:./conf_list.php");
 }else{
	msg("添加失败","./conf_add.php");
 }
?>