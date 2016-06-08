<?php
include_once("./header.php");
$sql="select * from ts_product where 1=1";
if(isset($_GET['pc_id'])){
	$pc_id=$_GET['pc_id'];
	  $sql3="select * from ts_product_cate";
	  $re3=mysql_query($sql3);
	  while($list3=mysql_fetch_assoc($re3)){
		$arr3[]=$list3;
      }
		function getcid($cate,$pc_id){//递归开始
		static $cids=array();//用来存最后一级的pc_id
		foreach($cate as $vo){
			if($pc_id==$vo['pc_f_id']){
				$cids[]=$vo['pc_id'];
				getcid($cate,$vo['pc_id']);
			}
		}
		if(count($cids)==0){//决定最后一级
			$cids[]=$pc_id;
		}
		return $cids;
	}
	$tmp=getcid($arr3,$pc_id);
	$tmp=implode(',',$tmp);
	$sql.=" &&p_c_id in($tmp)";
	}
$search=trim($_GET['search']);
if($search!=""){
	$sql.=" and pname like '%$search%'";
	$str="&& search='$search'";
	}
	/////查询代码结束
	//分页代码开始////
$records=mysql_num_rows(mysql_query($sql));
$record=8;
$pages=ceil($records/$record);
$page=1;
if(isset($_GET['page'])){
	if($_GET['page']>$pages){
	$page=$pages;
	//echo $pages;
	}elseif($_GET['page']<=1||!is_numeric($_GET['page'])){
		$page=1;
	}else{
		$page=$_GET['page'];
	}
}
$start=($page-1)*$record;
$sql.=" limit $start,$record";
$re=mysql_query($sql);
while($list=mysql_fetch_assoc($re)){
	$arr[]=$list;
}
?>
<!doctype html>
<html>
 <head>
  <title> 茵曼商城 </title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
  <style>
  </style>
 </head>
 <link rel="stylesheet" href="./public/css/index.css">
 <body>
  <div class="shop auto mt10"><!-- 大框架 yellow -->
	<?php
		foreach($arr as $vo){ ?><!--遍历出商品-->
	<div class="goods1 ml20 mt15 fl">
		<div class="imgs ">
			<a href="./detail.php?pid=<?=$vo['pid']?>"><img src="./admin/<?=$vo['thumb']?>" style="width:240px;height:260px;"></a>
		</div>
		<div class="g_name mt5">
			<?=$vo['pname']?>
		</div>
		<div class="g_price mt5"><?=$vo['price']?></div>
		<div class="g_add mt5">
			<a href="./detail.php?pid=<?=$vo['pid']?>"><img class="add_cart" src="./public/img/addcart.png" id="addcart"></a>
		</div>
	</div>		
	<?php }
	?>	
  </div>
  <div class="page auto mt10 ">
	<ul>
		<a href="?page=<?=$pages.$str?>"><li class="fr">末页</li></a>
		<a href="?page=<?=($page+1)>$pages?$page=$pages:($page+1).$str?>"><li class="fr">下一页</li></a>
		<a href="?page=<?=($page-1).$str?>"><li class="fr">上一页</li></a>
		<a href="?page=1<?=$str?>"><li class="fr">首页</li></a>
	</ul>
	<div class="clear"></div>
  </div>
  <?php
	include_once("./bottom.php");
  ?>
 </body>
</html>