<?php
 include_once("./global.php");
 if(!isset($_POST['sub'])){
	msg("请提交表单","./product_cate_add.php");
	exit;
 }
  $pc_id=$_POST['pc_id'];
  if(!isset($pc_id)){
	msg("请从商品分类界面修改","./product_cate_list.php");
	exit;
  }
  $pc_name=$_POST['pc_name'];
  $ifshow=$_POST['ifshow'];
  if(isset($_POST['fname'])){//没有子分类的情况
	  $fname=$_POST['fname'];
	  $new=array();
	  $new=explode("/",$fname);
	  $pc_level=$new[0]+1;
	  $pc_f_id=$new[1];
	  $sql="update  ts_product_cate set pc_name='$pc_name',pc_level='$pc_level',pc_f_id='$pc_f_id',ifshow='$ifshow' where pc_id='$pc_id'";
	  mysql_query($sql);
  }else{//有子分类的情况，此时select disabled 没有传fname的值
	  $sql="update  ts_product_cate set pc_name='$pc_name',ifshow='$ifshow' where pc_id='$pc_id'";
	  mysql_query($sql);
  }
  if(mysql_affected_rows()==1){
	header("location:./product_cate_list.php");
  }else{
	msg("添加失败","./product_cate_add.php");
  }
?>