<?php
include_once("./header.php");
$sql="select * from ts_news where 1=1";
if(isset($_GET['cid'])){
	$cid=$_GET['cid'];
	  $sql3="select * from ts_news_cate";
	  $re3=mysql_query($sql3);
	  while($list3=mysql_fetch_assoc($re3)){
		$arr3[]=$list3;
      }
		function getcid($cate,$cid){
		static $cids=array();
		foreach($cate as $vo){
			if($cid==$vo['fid']){
				$cids[]=$vo['cid'];
				getcid($cate,$vo['cid']);
			}
		}
		if(count($cids)==0){
			$cids[]=$cid;
		}
		return $cids;
	}
	$tmp=getcid($arr3,$pc_id);
	$tmp=implode(',',$tmp);
	$sql.=" &&p_c_id in($tmp)";
	}
$search=trim($_GET['search']);
if($search!=""){
	$sql.=" and title like '%$search%'";
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
	}elseif($_GET['page']<=1){
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
  <title> 新闻页 </title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
  <style>
  </style>
 </head>
 <link rel="stylesheet" href="./public/css/index.css">
 <body>
  <div class="shop auto mt10"><!-- 大框架 yellow -->
	<?php
		foreach($arr as $vo){ ?>
	<div class="goods1 ml20 mt15 fl center">
		<div class="imgs ">
			<a href="./news_detail.php?nid=<?=$vo['nid']?>"><img src="./admin/<?=$vo['img']?>" style="width:240px;height:260px;"></a>
		</div>
		<div class="g_name mt5">
			<?=$vo['title']?>
		</div>
		<div class="g_price mt5"><span style="display:inline-block;color:#666">作者：<?=$vo['author']?></span></div>
		<div class="g_add mt5">
			<span style="display:inline-block;color:#666">点击量:<?=$vo['showtotal']?></span>
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
