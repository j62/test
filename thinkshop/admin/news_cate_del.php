<?php
 include_once("./global.php");
 if(!isset($_GET['cid'])){
	header("location:./news_cate_list.php");
	exit;
 }
 $cid=$_GET['cid'];
 $sql="select cname from ts_news_cate where fid='$cid'";
 $re=mysql_query($sql);
 if(mysql_num_rows($re)<1){//找不到子分类
	$sql1="delete from ts_news_cate where cid='$cid'";
	mysql_query($sql1);
	if(mysql_affected_rows()==1){
		header("location:./news_cate_list.php");
	}else{
		msg("删除失败","./news_cate_list.php");
	}
 }else{//有子分类
	msg("有子分类不允许删除","./news_cate_list.php");
 }
?>