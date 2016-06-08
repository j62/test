<?php
 include_once("./global.php");
 $sql="select * from ts_order where 1=1 order by otime desc";
 $re=mysql_query($sql);
 if(mysql_num_rows($re)<1){
	msg("系统没有订单","./main.php");
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
  <link rel="stylesheet" href="../../public/css/index.css">
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
			<div class="info1_oserial  fl">订单序列号:<?=$vo['oserial']?></div>
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
				<img src="<?=$ar['thumb']?>"style="width:80px;height:80px">
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
		</div>
		<div class="clear"></div>
		<?php }	
		?>
	</div>
	<div class="o_operate auto">
		<div class="fl info_user">
				<?php
					$sq="select user from ts_members where uid=".$vo['uid'];
					$r=mysql_query($sq);
					$a=mysql_fetch_assoc($r);
					echo "买家:".$a['user'];
				?>
		</div>
		<div class="info_op fr">
			
				<?php
					if($vo['if_send']==0){?>
				<a href="./do_order_list.php?oid=<?=$vo['oid']?>"><button>发货</button></a>	
				<?php }elseif(($vo['if_send']==1)){
					echo "已发货";
				}else{
					echo "交易成功";
				}
				?>
			
		</div>
	</div>
	<?php } ?>
 </body>
</html>