<?php
 include_once("./global.php");
if(!isset($_SESSION['user'])){
	msg("请登录","login.php");
	exit;
}
if(!isset($_GET['pid']) || !isset($_GET['types'])){
	msg("操作有误,不能修改","./mycart.php");
	exit;
}
if(isset($_GET['num'])){//判断输入的是否是数值
	if(!is_numeric($_GET['num'])){
		msg("你的输入有误","./mycart.php");
		exit;
	}
}
//type==1 减 type=2 加 1 type= 3 修改 type =4 删除
$pid=$_GET['pid'];
$types=$_GET['types'];
$sql="select * from ts_product where pid='$pid'";
$re=mysql_query($sql);
$arr=mysql_fetch_assoc($re);
foreach($_SESSION['cart'] as $key=>&$vo){//要改变$_SESSION里面的num 所以用传地址
	if($pid==$vo['pid']){
		if($types==1){
		  if($vo['num']==1){
			$vo['num']=1;
		  }else{
			$vo['num']=$vo['num']-1;
		  }
			
		}elseif($types==2){
			if($vo['num']==$arr['snums']){
				$vo['num']=$arr['snums'];
			}else{
				$vo['num']=$vo['num']+1;
				//print_r($_SESSION['cart']);exit;
			}
		}elseif($types==3){
		  $num=$_GET["num"];
		  if($num>$arr['snums']){
			$vo['num']=$arr['snums'];
		  }elseif($num==0){
			$vo['num']=1;
		  }else{
			$vo['num']=$num;
		  }
		}elseif($types==4){
			unset($_SESSION['cart'][$key]);
		}
	}
}
header("location:./mycart.php");
?>