<?php
include_once("./global.php");
 $pid=$_GET['pid'];
 $sql="select * from ts_product where pid='$pid'";
 $re=mysql_query($sql);
 $arr=mysql_fetch_assoc($re);
 $thumb=$arr['thumb'];
 unlink($thumb);
 $pimgs=explode(";",$arr['pimgs']);
 foreach($pimgs as $key=>$vo){
	unlink($vo);
 }
 $sql1="delete from ts_product where pid='$pid'";
 mysql_query($sql1);
 if(mysql_affected_rows()==1){
	header("location:./product_list.php");
 }else{
	 msg("删除失败","./product_list.php");
 }
?>