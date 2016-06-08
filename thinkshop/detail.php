<?php
include_once("./header.php");
$pid=$_GET['pid'];
$sql="select * from ts_product where pid='$pid'";
$re=mysql_query($sql);
$arr=mysql_fetch_assoc($re);
$pimgs=$arr["pimgs"];
$img=explode(";",$pimgs);
$size=explode(";",$arr['size']);
$color=explode(";",$arr['color']);
?>
<!doctype html>
<html>
 <head>
  <title> new document </title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
  <style>
  </style>
  <link rel="stylesheet" href="./public/css/index.css">
 </head>
 <body>
	<div class="detail auto">
		<div class="de_l fl">
			<div class="de_l_in">
				<img  id="big" style="width:420px;height:420px;margin-top:10px"src="./admin/<?=$img[0]?>">
			</div>
			<div class="de_l_c mt20">
				<img class="de_img1 fl" src="./admin/<?=$img[0]?>" onmouseover="change(this)" onmouseout="dis(this)">
				<img class="de_img2 fl" src="./admin/<?=$img[1]?>" onmouseover="change(this)" onmouseout="dis(this)">
				<img class="de_img3 fl" src="./admin/<?=$img[2]?>" onmouseover="change(this)" onmouseout="dis(this)">
				<img class="de_img4 fl" src="./admin/<?=$img[3]?>" onmouseover="change(this)" onmouseout="dis(this)">
			</div>
			<div class="de_l_b">
				<img style="margin-left:20px;" src="./public/img/shoucang.png">
			</div>
		</div>
		<form action="./addcart.php" method="post">
		<div class="de_r fl">
			<div class="de_r_hd">
				<h4 style="font-family:'宋体';font-size:17px;color:black;margin-top:10px"><?=$arr['pname']?></h4>
				<p style="color:#DD2727;font-size:14px;margin-top:10px">棉麻艺术家</p>
			</div>
			<div class="de_r_ti">
				<div class="de_r_t1">
					价格 <span style="text-decoration:line-through;color:black;margin-left:30px">￥<?=$arr['price']?></span>
				</div>
				<div class="de_r_t2">
					促销价
					<span style="font-size:30px;font-weight:bold;color:#C40000;margin-left:10px;margin-top:-10px">￥<?=$arr['sprice']?></span>
				</div>
			</div>
			<div class="de_t_eval">
				<span>总销量200</span><span>评价数量111</span>
			</div>
			<div class="de_t_size mt10">
				<span style="margin-top:5px">尺码</span>
				<?php
					foreach($size as $vo){ ?>
						<b class="de_size"><?=$vo?><input type="radio" name="size" value=<?=$vo?>></b>	
					<?php }
					?>
				
			</div>
			<div class="de_t_color mt10">
				<span style="margin-top:5px">颜色</span>
				<?php
					foreach($color as $v){ ?>
						<b class="de_color" style="background:<?=$v?>"><input style="width:10px;height:10px;" type="radio" name="color" value=<?=$v?>></b>	
					<?php }
					?>
				
			</div>
			<div class="de_t_num mt10">
				<span style="margin-top:5px">数量</span>
				<form style="display:inline-block;">
					<input type="hidden" name="pid" value="<?=$pid?>">
					<input type="text" class="de_num" name="num">
				</form>
			</div>
			<div class="de_t_snum mt10">
				<span style="margin-top:5px">库存</span><b class="de_snum"><?=$arr['snums']?></b>
			</div>
			<div class="de_addcart">
				<input type="image" name="sub" src="./public/img/addcart.png">
			</div>
			<div class="de_bot">
				<img src="./public/img/de_bot.png">
			</div>
		</div>
		</form>
		<div class="clear"></div>
	</div>
	<?php
		$sql2="select * from ts_comment where pid='$pid'";
		$res=mysql_query($sql2);
		?>
	<?php
		if(mysql_num_rows($res)>=1){ 
		  while($list2=mysql_fetch_assoc($res)){
			$arr2[]=$list2;
		  }
		  ?>
	<div class="comment auto">
		<div class="comm_thead">
			<div class="ct_cont fl">评价心得</div>
			<div class="ct_time fl">评价时间</div>
			<div class="ct_info fl">商品信息</div>
			<div class="ct_user fl">购买者信息</div>
			<div class="clear"></div>
		</div>
		<?php
			foreach($arr2 as $va){ 
			$info=explode(':',$va['comment_info']);
			$color2=$info[0];
			$size2=$info[1];
			$num2=$info[2];
			$sql3="select * from ts_members where uid=".$va['commentator_id'];
			$re3=mysql_query($sql3);
			$arr3=mysql_fetch_assoc($re3);
			?>
		<div class="comm_cont">
			<div class="com_cont">
				<div class="cm_cont fl"><span><?=$va['comment_content']?></span></div>
				<div class="cm_time fl"><?=date('Y-m-d H:i:s',$va['comment_time'])?></div>
				<div class="cm_info fl">
					<div>颜色：<span style="display:inline-block;width:15px;height:15px;background:<?=$color2?>"></span></div>
					<div class="mt5">尺码：<?=$size2?></div>
					<div class="mt5">数量：<?=$num2?></div>
				</div>
				<div class="cm_user fl">
					<div>购买者：<?=$arr3['user']?></div>
					<div class="mt5">昵称：<?=$arr3['nickname']?></div>
					<div class="mt5">注册时间：<?=date("Y",$arr3['retime'])?></div>
				</div>
			</div>
		</div>
		<?php  }
		 ?>
	</div>
	<?php }
	?>
	<?php
		if(isset($_GET['cm_info'])){ ?>
    <form class="fck mt20 auto" action="./do_comment.php" method="post">
		<?php
			include_once("./fckeditor/fckeditor.php");
			$fckeditor = new FCKeditor("content");//定义默认值 name
			$fckeditor->Width = "800px";//定义编辑器的宽度
			$fckeditor->Height = "350px";//定义编辑器的高度
			$fckeditor->Value = "";//定义默认值
			$fckeditor->BasePath='./fckeditor/';
			$fckeditor->ToolbarSet = "Basic";
			$fckeditor->Create();//创建编辑器
		?>
		<input style="width:65px;height:32px;margin-left:345px" type="image" name="sub" src="./public/img/submit1.png">
		<input type="hidden" name="pid" value="<?=$pid?>">
		<input type="hidden" name="cm_info" value="<?=$_GET['cm_info']?>">
		<input type="hidden" name="oid" value="<?=$_GET['oid']?>">
	</form>	
		<?php }
	?>
		
  <?php
	include_once("./bottom.php");
  ?>
  <script>
	var big=document.getElementById("big");
	function change(a){
		big.src=a.src;
		a.style.border="1px solid red";
	}
	function dis(a){
		a.style.border="1px solid black";
	}
	
  </script>
 </body>
</html>
