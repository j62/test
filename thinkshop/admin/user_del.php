<?php
include_once("./global.php");
if(!isset($_GET['uid'])){
	msg("没有删除目标","./user_list.php");
	exit;
}
$uid=$_GET['uid'];
$sql1="select * from ts_members where uid='$uid'";
$re=mysql_query($sql1);
$arr=mysql_fetch_assoc($re);
if($arr['type']==1){
	msg("不能删除管理员","./user_list.php");
	exit;
}
$sql="delete from ts_members where uid='$uid'";
mysql_query($sql);
if(mysql_affected_rows()==1){
  header("location:./user_list.php");
}else{
	msg("删除失败","./user_list.php");
}
?>