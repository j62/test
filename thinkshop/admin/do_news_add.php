<?php
include_once("./global.php");
if(!isset($_POST['sub'])){
	msg("请提交表单","./product_add.php");
}

$title=$_POST['title'];
$content=$_POST['content'];
$author=$_POST['author'];
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
do_uploads("./newsuploads","img");
$img=$newname;
$sql="insert into ts_news (title,nc_id,content,author,pubtime,img)value('$title','$nc_id','$content','$author','$pubtime','$img')";
mysql_query($sql);
echo mysql_error();
if(mysql_affected_rows()==1){
	msg("添加成功","./news_list.php");
}else{
	msg("添加失败","./news_add.php");
}
?>