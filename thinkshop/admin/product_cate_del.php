<?php
 include_once("./global.php");
 if(!isset($_GET['pc_id'])){
	header("location:./product_cate_list.php");
	exit;
 }
 $pc_id=$_GET['pc_id'];
 $sql="select pc_name from ts_product_cate where pc_f_id='$pc_id'";
 $re=mysql_query($sql);
 if(mysql_num_rows($re)<1){//找不到子分类
	$sql1="delete from ts_product_cate where pc_id='$pc_id'";
	mysql_query($sql1);
	if(mysql_affected_rows()==1){
		header("location:./product_cate_list.php");
	}else{
		msg("删除失败","./product_cate_list.php");
	}
 }else{//有子分类
	msg("有子分类不允许删除","./product_cate_list.php");
 }
?>