<?php
 include_once("./header.php");
 if($_SESSION['user']==""){
	msg("请登录","./login.php");
	exit;
 }
 $cart=$_SESSION["cart"];
 if($cart==""){
   msg("购物车里没有商品","./shop.php");
   exit;
 }
?>
<!doctype html>
<html>
 <head>
  <title> 填写订单 </title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
  <style>
  </style>
 </head>
 <body>
	<div class="cart_thead  auto">
		<div class="t_goods fl" style="text-align:left;">商品</div>
		<div class="t_info fl">颜色/尺码</div>
		<div class="t_price fl">单价（元）</div>
		<div class="t_num fl">数量</div>
		<div class="t_nums fl">小计（元）</div>
    </div>
    <div class="mycart auto mt20">
    <?php
	 foreach($cart as $vo){ 
	   $pid=$vo['pid'];
	  $sql="select * from ts_product where pid='$pid'";
	  $re=mysql_query($sql);
	  $arr=mysql_fetch_assoc($re);
	   ?>
		<div class="c_goods fl">
			<div class="c_img fl">
				<img src="./admin/<?=$arr['thumb']?>"style="width:80px;height:80px">
			</div>
			<div class="c_name  mt15 fl">
				<?=$arr['pname']?>
			</div>
		</div>
		<div class="c_info fl">
			<div class="c_color mt15">
				<span style="display:inline-block;width:15px;height:15px;background:<?=$vo['color']?>"></span>
			</div>
			<div class="c_size mt15">
				<span><?=$vo['size']?></span>
			</div>
		</div>
		<div class="c_price fl">
			<span ><?=$arr['price']?></span>
		</div>
		<div class="c_num fl">
			<span>
				<?=$vo['num']?>
			</span>
		</div>
		<div class="c_nums fl">
			<span><?php
			echo $arr['price']*$vo['num'];
			$nums+=$arr['price']*$vo['num'];
			  ?></span>
		</div>
	<?php }
   ?>
	</div>
	<form action ="./do_worder.php" method="post">
	<div class="cart_bottom auto mt10">
		<div class="cb1 fr" style="margin-top:5px"><input type="image" name="sub" src="./public/img/submit.png"></div>
		<div class="cb2 fr" style="margin-right:20px;"><span style="color:#666;font-size:15px;display:inline-block;margin-top:13px">总价:</span><span style="color:#E4393C;font-size:18px;font-weight:bold">￥<?=$nums?></span></div>
		<div class="cb3 fr mt15 mr20">手机号:<input type="text" name="phone"></div>
		<div class="cb4 fr mt15 mr20">地址:<input type="text" name="addr"></div>
		<div class="cb5 fr mt15 mr20">收件人:<input type="text" name="receiver"></div>
	</div>
	</form>
<?php
include_once("./bottom.php");
?>
 </body>
</html>
