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
  <title> 我的购物车 </title>
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
		<div class="t_op fl">操作</div>
    </div>
    <div class="mycart auto mt20">
    <?php
	 foreach($cart as $vo){ 
	   $pid=$vo['pid'];
	  $sql="select * from ts_product where pid='$pid'";
	  $re=mysql_query($sql);
	  $arr=mysql_fetch_assoc($re);
	   ?>
	   <form action="./mycart_edit.php" method="get">
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
				<a href="./mycart_edit.php?pid=<?=$pid?>&&types=1">-</a>
					<input type="text" name="num" value="<?=$vo['num']?>">
				<a href="./mycart_edit.php?pid=<?=$pid?>&&types=2">+</a>
			</span>
		</div>
		<div class="c_nums fl">
			<span><?php
			echo $arr['price']*$vo['num'];
			$nums+=$arr['price']*$vo['num'];
			  ?></span>
		</div>
		<div class="c_op fl">
			<span><button><a href="./mycart_edit.php?pid=<?=$pid?>&&types=4" style="color:black">删除</a></button></span>
			<input type="hidden" name="types" value="3">
			<input type="hidden" name="pid" value="<?=$pid?>">
			<div style="margin-top:5px">
			<input style="background:#66B6FF;border:none;border-radius:5px;width:72px;height:28px" type="submit" name="sub" value="修改"></div>
		</div>
		<div class="clear"></div>
		</form>
	<?php }
   ?>
	</div>
	<div class="cart_bottom auto mt10">
		<div class="cb1 fr"><a href="./worder.php"><img src="./public/img/checkout.png"></a></div>
		<div class="cb2 fr" style="margin-right:20px;"><span style="color:#666;font-size:15px;display:inline-block;margin-top:13px">总价:</span><span style="color:#E4393C;font-size:18px;font-weight:bold">￥<?=$nums?></span></div>
	</div>
<?php
include_once("./bottom.php");
?>
 </body>
</html>
