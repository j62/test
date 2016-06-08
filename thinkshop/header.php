<?php
include_once("./global.php");
$sql1="select * from ts_product_cate";
$result=mysql_query($sql1);
while($list1=mysql_fetch_assoc($result)){
		$ar[]=$list1;
}
function get_cate($cate,$pc_f_id=0){
   static $classes=array();
	foreach($cate as $v){
		if($pc_f_id==$v['pc_f_id']){
			$classes[]=$v;
			get_cate($cate,$v['pc_id']);
		}
	}
	return $classes;
 }
 $ar=get_cate($ar);
?>
<!doctype html>
<html>
<head>
  <title> 茵曼商城 </title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
  <style>
  *{margin:0px;padding:0px;}
  </style>
  <link rel="stylesheet" href="./public/css/index.css">
 </head>
 <body>
  <div class="sn_container auto">
	<p class="sn_backhome fl mr20">
		<a href="./index.php">茵曼首页</a>
	</p>
	<p class="sn_login_info fl center">
	<?php
		if(isset($_SESSION['user'])){ ?>
		<span><?=$_SESSION['user']?>,欢迎到茵曼</span>	
		<a href="./login_out.php">退出</a>
		<?php }else{ ?>
		<a href="./login.php"class="sn_login">请登录</a>
		<a href="./regist.php">免费注册</a>
	    <?php }?> 
	</p>
	<ul class="sn_quick_menu fl">
		<li class="fl" style="margin-left:255px"><a href="./user_center.php">用户中心</a></li>
		<li class="fl"><a href="./mycart.php">我的购物车(<?=count($_SESSION['cart'])?>)</a></li>
		<li class="fl"><a href="./myorder.php">我的订单(
		<?php
			$uid=$_SESSION['uid'];
			$sql3="select uid from ts_order where uid='$uid'";
			$re3=mysql_query($sql3);
			if(mysql_num_rows($re3)<1){
				echo 0;
			}else{
				echo mysql_num_rows($re3);
			}
		?>
		)</a></li>
	<ul>
	<p class="clear"></p>
  </div>
  <div class="headercon auto">
	<div class="hc_l fl"><?=getconfig("title")?></div>
	<div class="hc_c fl"><img src="./public/img/headercon.png"></div>
	<div class="hc_r fl mt15">
		<form action="" method="get">
			<input type="text" name="search" class="search">
			<input type="submit" name="searchbtn" class="searchbtn" value="搜本店">
		</form>
	</div>
	<p class="clear"></p>
  </div>
  <div class="logo_link auto">
  <a><img src="./public/img/logo.png"></a>
  </div>
  <div class="nav auto">
	<ul>
		<li class="fl"><a href="./index.php">首页</a></li>
		<li class="fl"><a href="./shop.php">商城</a></li>
		<li class="fl"><a href="./news.php">新闻</a></li>
	</ul>
	<div class="nav_r fl">
		<a>产品分类</a>
	<?php
		foreach($ar as $vo){ ?>
			<a href="./shop.php?pc_id=<?=$vo['pc_id']?>"><?=$vo['pc_name']?></a>
	<?php }
		
	?>
	</div>
	<p class="clear"></p>
  </div>
 </body>
</html>
