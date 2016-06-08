<?php
include_once("./global.php");
if(!isset($_POST['sub'])){
	msg("请提交表单","./product_add.php");
}

$pname=$_POST['pname'];
$addr=$_POST['addr'];
$fname=$_POST['fname'];
$new=explode("/",$fname);
$sql="select * from ts_product_cate where pc_f_id='$new[1]'";
$re=mysql_query($sql);
if(mysql_num_rows($re)>=1){//选择的分类不是终极分类
	msg("只有终极分类才能增加产品","./product_add.php");
	exit;
}
$p_c_id=$new[1];
$pnums=date("YmdHis",time()).rand("100","999");
$price=$_POST['price'];
$sprice=$price*0.8;
do_uploads("./uploads","upfile");
$thumb=$newname;
$descp=$_POST['descp'];
$keyword=$_POST['keyword'];
$snums=$_POST['snums'];
$pubtime=strtotime($_POST['pubtime']);
$colors=$_POST['color'];
$color=implode(";",$colors);
$sizes=$_POST['size'];
$size=implode(";",$sizes);
$ifshow=$_POST['ifshow'];
do_uploads("./moreuploads","upfile1");
//用到后面的变量覆盖前面的变量
$pimg[].=$newname;
do_uploads("./moreuploads","upfile2");
$pimg[].=$newname;
do_uploads("./moreuploads","upfile3");
$pimg[].=$newname;
do_uploads("./moreuploads","upfile4");
$pimg[].=$newname;
//Array ( [0] => ./moreuploads/2015110817124952.jpg [1] => ./moreuploads/20151108171249878.jpg [2] => ./moreuploads/20151108171249191.jpg [3] => ./moreuploads/20151108171249669.jpg )
$pimgs=implode(";",$pimg);
$sql="insert into ts_product (pname,p_c_id,pnums,price,sprice,thumb,addr,descp,keyword,snums,pubtime,color,size,ifshow,pimgs)value
('$pname','$p_c_id','$pnums','$price','$sprice','$thumb','$addr','$descp','$keyword','$snums','$pubtime','$color','$size','$ifshow','$pimgs')";
mysql_query($sql);
//echo mysql_error();
if(mysql_affected_rows()==1){
	msg("添加成功","./product_list.php");
}else{
	msg("添加失败","./product_add.php");
}
?>