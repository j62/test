<?php
 include_once("./global.php");
 $nid=$_GET['nid'];
 if(isset($nid)){
	$sql="update ts_news set showtotal=showtotal+1 where nid='$nid'";
	mysql_query($sql);
	 $sql1="select * from ts_news where nid='$nid'";
	 $re=mysql_query($sql1);
	 $arr=mysql_fetch_assoc($re);
 }
 ?>
<!doctype html>
<html>
 <head>
  <title> 新闻详情页</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
  <style>
  </style>
 </head>
 <link rel="stylesheet" href="./public/css/index.css">
 <body>
  <?php
	include_once("./header.php");	
  ?>
  <div class="news_img auto mt20">
	<img src="./admin<?=$arr['img']?>">
  </div>
  <div class="news_title auto center">
	<?=$arr['title']?>
  </div>
  <div class="news_author auto center">
	作者:<?=$arr['author']?>
  </div>
  <div class="news_content auto center">
	<?=$arr['content']?>
  </div>
  <?php
	include_once("./bottom.php");
  ?>
 </body>
</html>
