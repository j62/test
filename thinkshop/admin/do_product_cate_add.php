<?php
 include_once("./global.php");
 if(!isset($_POST['sub'])){
	msg("请提交表单","./product_cate_add.php");
	exit;
 }
  //Array ( [pc_name] => 布鞋 [fname] => 1/3 [ifshow] => 0 [sub] => 添加 )
  $pc_name=$_POST['pc_name'];
  $ifshow=$_POST['ifshow'];
  $fname=$_POST['fname'];
  $new=array();
  $new=explode("/",$fname);//把组装好的ID LEVEL拆分成数组处理
  $pc_level=$new[0]+1;
  $pc_f_id=$new[1];
  $sql="insert into ts_product_cate (pc_name,pc_f_id,pc_level,ifshow)value('$pc_name','$pc_f_id','$pc_level','$ifshow')";
  mysql_query($sql);
  //echo mysql_error();
  //exit;
  if(mysql_affected_rows()==1){
	header("location:./product_cate_list.php");
  }else{
	msg("添加失败","./product_cate_add.php");
  }
?>