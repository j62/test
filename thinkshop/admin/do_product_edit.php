<?php
include_once("./global.php");
if(!isset($_POST['sub'])){
	msg("请提交表单","./product_add.php");
}
$pid=$_POST['pid'];//用来查询当前商品数据库中内容
$sql1="select * from ts_product where pid='$pid'";
$res=mysql_query($sql1);
$ar=mysql_fetch_assoc($res);
////////////////////////////////////////
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
$descp=$_POST['descp'];
$keyword=$_POST['keyword'];
$snums=$_POST['snums'];
$pubtime=strtotime($_POST['pubtime']);
$colors=$_POST['color'];
$color=implode(";",$colors);
$sizes=$_POST['size'];
$size=implode(";",$sizes);
$ifshow=$_POST['ifshow'];
$pimg=explode(";",$ar['pimgs']);
if($_FILES['upfile']['name']==''){//商品图片（thumb）没有改变的情况
	$thumb=$ar['thumb'];
}else{///商品图片（thumb）改变的情况
	unlink($ar['thumb']);
	do_uploads("./uploads","upfile");
	$thumb=$newname;
}
//print_r($_FILES);die;
$upfile1=$_FILES['upfile1'];      
if($upfile1['name'][0]==""&&$upfile1['name'][1]==""&&$upfile1['name'][2]==""&&$upfile1['name'][3]==""){
  //图片库没有文件上传的情况
	$pimgs=$ar['pimgs'];
}else{//有文件上传的情况
	foreach($upfile1['name'] as $key=>$vo){
		if($vo!=""){
			$dir="./moreuploads";
			$upfile=$_FILES["upfile1"];
			$names=$upfile['name'][$key];// [name] => Array( [0] => headercon.png [1] => index_t3.jpg [2] => [3] => )
			$types=array("png","jpg","jpeg","webp","gif");
			$type=strtolower(end(explode(".",$names)));//取出文件名后缀
			if(!in_array($type,$types)){
				exit("不支持的文件类型");
			}
				global $newname;
				$newname=$dir."/".date("YmdHis").rand(1,1000).".".$type;
				unlink($pimg[$key]);
			if(!move_uploaded_file($upfile["tmp_name"][$key],$newname)){
				exit("上传失败");
			}else{
				echo "上传成功";
			}
			$pimage[].=$newname;
		}else{
			$pimage[].=$pimg[$key];
		}
	}
	$pimgs=implode(";",$pimage);
}
$sql =  "update ts_product set price = '$price',descp = '$descp',pname = '$pname',pubtime = '$pubtime',p_c_id = '$p_c_id',ifshow = '$ifshow',addr = '$addr',color = '$color',size = '$size',pnums = '$pnums',thumb = '$thumb',pimgs = '$pimgs',snums = '$snums',sprice = '$sprice',keyword = '$keyword' where pid = '$pid'";
mysql_query($sql);
echo mysql_error();
if(mysql_affected_rows()==1){
	msg("修改成功","./product_list.php");
}else{
	msg("修改失败","./product_add.php");
}
?>
