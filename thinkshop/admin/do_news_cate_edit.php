<?php
 include_once("./global.php");
 if(!isset($_POST['sub'])){
	msg("请提交表单","./news_cate_add.php");
	exit;
 }
  $cid=$_POST['cid'];
  if(!isset($cid)){
	msg("请从商品分类界面修改",".news_cate_list.php");
	exit;
  }
  $cname=$_POST['cname'];
  $ifshow=$_POST['ifshow'];
  if(isset($_POST['fname'])){//没有子分类的情况
	  $fname=$_POST['fname'];
	  $new=array();
	  $new=explode("/",$fname);
	  $level=$new[0]+1;
	  $fid=$new[1];
	  $sql="update  ts_news_cate set cname='$cname',level='$level',fid='$fid',ifshow='$ifshow' where cid='$cid'";
	  mysql_query($sql);
  }else{//有子分类的情况，此时select disabled 没有传fname的值
	  $sql="update  ts_news_cate set cname='$cname',ifshow='$ifshow' where cid='$cid'";
	  mysql_query($sql);
  }
  if(mysql_affected_rows()==1){
	header("location:./news_cate_list.php");
  }else{
	msg("添加失败","./news_cate_add.php");
  }
?>