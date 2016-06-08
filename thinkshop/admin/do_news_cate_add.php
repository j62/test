<?php
 include_once("./global.php");
 if(!isset($_POST['sub'])){
	msg("请提交表单","./news_cate_add.php");
	exit;
 }
  $cname=$_POST['cname'];
  $ifshow=$_POST['ifshow'];
  $fname=$_POST['fname'];
  $new=array();
  $new=explode("/",$fname);//把组装好的ID LEVEL拆分成数组处理
  $level=$new[0]+1;
  $fid=$new[1];
  $sql="insert into ts_news_cate (cname,fid,level,ifshow)value('$cname','$fid','$level','$ifshow')";
  mysql_query($sql);
  if(mysql_affected_rows()==1){
	header("location:./news_cate_list.php");
  }else{
	msg("添加失败","./news_cate_add.php");
  }
?>