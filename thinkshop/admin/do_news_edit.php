<?php
include_once("./global.php");
if(!isset($_POST['sub'])){
	msg("请提交表单","./product_add.php");
}
$nid=$_POST['nid'];//用来查询当前商品数据库中内容
//echo $nid ;die;
$sql1="select * from ts_news where nid='$nid'";
$res=mysql_query($sql1);
$ar=mysql_fetch_assoc($res);
////////////////////////////////////////
$title=$_POST['title'];
$author=$_POST['author'];
$content=$_POST['content'];
$fname=$_POST['fname'];
$new=explode("/",$fname);
$sql="select * from ts_news_cate where fid='$new[1]'";
$re=mysql_query($sql);
if(mysql_num_rows($re)>=1){//选择的分类不是终极分类
	msg("只有终极分类才能增加新闻","./news_add.php");
	exit;
}
$nc_id=$new[1];
$pubtime=strtotime($_POST['pubtime']);
if($_FILES['img']['name']==''){//新闻图片（thumb）没有改变的情况
	$img=$ar['img'];
}else{///新闻图片（thumb）改变的情况
	unlink($ar['img']);
	do_uploads("./newsuploads","img");
	$img=$newname;
}
$sql =  "update ts_news set title='$title',pubtime='$pubtime',nc_id='$nc_id',author = '$author',img='$img',content='$content' where nid='$nid'";
mysql_query($sql);
echo mysql_error();
if(mysql_affected_rows()==1){
	msg("修改成功","./news_list.php");
}else{
	msg("修改失败","./news_list.php");
}
?>