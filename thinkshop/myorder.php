<?php
 include_once("./header.php");
 $uid=$_SESSION['uid'];
 $sql="select * from ts_order where uid='$uid' order by otime desc";
 $re=mysql_query($sql);
 if(mysql_num_rows($re)<1){
	msg("您还没有订单","./shop.php");
	exit;
 }
 while($list=mysql_fetch_assoc($re)){
		$arr[]=$list;
 }
?>
<!doctype html>
<html>
 <head>
  <title> 我的订单 </title>
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
		<div class="t_nums fl">状态</div>
		<div class="t_op fl">操作</div>
    </div>
	<?php
		foreach($arr as $vo){ ?>
	<div class="o_info auto mt15">
		<div class="o_info1">
			<div class="info1_time fl"><?=date("Y-m-d",$vo['otime'])?></div>
			<div class="info1_oserial  fl">订单号:<?=$vo['oserial']?></div>
		</div>
	</div>
	<div class="mycart auto">
		<?php
			$p_info=json_decode($vo['p_info'],true);
		?>
		<?php
			foreach($p_info as $v){ 
			$sql1="select * from ts_product where pid=".$v['pid'];
			$re=mysql_query($sql1);
			$ar=mysql_fetch_assoc($re);
		  ?>
		<div class="c_goods fl">
			<div class="c_img fl">
				<img src="./admin/<?=$ar['thumb']?>"style="width:80px;height:80px">
			</div>
			<div class="c_name  mt15 fl">
				<?=$ar['pname']?>
			</div>
		</div>
		<div class="c_info fl">
			<div class="c_color mt15">
				<span style="display:inline-block;width:15px;height:15px;background:<?=$v['color']?>"></span>
			</div>
			<div class="c_size mt15">
				<span><?=$v['size']?></span>
			</div>
		</div>
		<div class="c_price fl">
			<span ><?=$ar['price']?></span>
		</div>
		<div class="c_num fl">
			<span style="font-size:12px"><?=$v['num']?></span>
		</div>
		<div class="c_nums fl">
			<span><?php
			if($vo['if_send']==0){
				echo"未发货";
			}elseif($vo['if_send']==1){
				echo "已发货";
			}else{
				echo "已确认收货";
			}
		  ?></span>
		</div>
		<div class="c_op fl">
			<?php
				$oid=$vo['oid'];
				$pid=$v['pid'];
				$sql2="select * from ts_comment where oid='$oid'&&pid='$pid'";
				$re2=mysql_query($sql2);
			?>
			<?php
				if($vo['if_send']==1){ ?>
			<span><button><a href="./require_order.php?oid=<?=$vo['oid']?>&&types=1">确认收货</a></button></span>		
			<?php }elseif($vo['if_send']==2&&mysql_num_rows($re2)==0){ ?>
			<div>
				<?php
					$cm_info=$v['color'].":".$v['size'].":".$v['num'];
				?>
				<span><button><a href="./detail.php?pid=<?=$v['pid']?>&&cm_info=<?=$cm_info?>&&oid=<?=$vo['oid']?>">评价</a></button></span>
			</div>	
			<?php }
			?>
		</div>
		<div class="clear"></div>
		<?php }	
		?>
	</div>
	<?php
		}
		?>
<?php
include_once("./bottom.php");
?>
 </body>
</html>