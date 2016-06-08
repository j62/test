<?php
include_once("./global.php");
 $nid=$_GET['nid'];
 $sql="select * from ts_news where nid='$nid'";
 $re=mysql_query($sql);
 $arr=mysql_fetch_assoc($re);
 $img=$arr['img'];
 unlink($img);
 $sql1="delete from ts_news where nid='$nid'";
 mysql_query($sql1);
 if(mysql_affected_rows()==1){
	header("location:./news_list.php");
 }else{
	 msg("删除失败","./news_list.php");
 }
?>