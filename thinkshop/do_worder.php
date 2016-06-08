<?php
 include_once("./global.php");
 if(!isset($_SESSION['user'])){
	msg("请登录","./login.php");
	exit;
 }
 if(!isset($_POST['sub_x'])){
	msg("提交表单","./worder.php");
	exit;
 }
 $oserial=date("YmdHis",time()).rand(1,10);
 //echo $oserial;exit;
 $otime=time();
 $receiver=$_POST['receiver'];
 $addr=$_POST['addr'];
 $phone=$_POST['phone'];
 $uid=$_SESSION['uid'];
 $p_info=json_encode($_SESSION['cart']);//存商品信息
 $sql="insert into ts_order (oserial,otime,receiver,addr,phone,uid,p_info)value('$oserial','$otime','$receiver','$addr','$phone','$uid','$p_info')";
 mysql_query($sql);
 echo mysql_error();
 if(mysql_affected_rows()==1){
	header("location:./myorder.php");
	unset($_SESSION['cart']);
 }else{
	msg("插入失败","./worder.php");
 }
?>