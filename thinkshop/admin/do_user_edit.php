<?php
include_once("./global.php");
//print_r($_POST);exit;
$uid=$_POST['uid'];
$email=trim($_POST['email']);
$nickname=trim($_POST['nickname']);
$type=$_POST['type'];
$sql="update ts_members set email='$email',nickname='$nickname',type=$type where uid='$uid'";
mysql_query($sql);
if(mysql_affected_rows()==1){
	msg("修改成功","./user_list.php");
}else{
	msg("修改失败","./user_list.php");
}

?>