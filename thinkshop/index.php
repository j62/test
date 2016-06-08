<?php
include_once("./global.php");
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
 <?php
  include_once("./header.php");
 ?>
	<div class="index_t auto">
		<a href="./shop.php"><img src="./public/img/index_t1.jpg" id="big"></a>
	</div>
	<div class="index_c auto mt20">
		<EMBED style="margin-top:27px;margin-left:10px" src="./ck.mp4" width=778 height=485 volume=70 autostart=true></EMBED>
	</div>
	<div class="index_b auto">
		<a href="./shop.php"><img src="./public/img/index_b.png"></a>	
	</div>
	<?php
		include_once("./bottom.php");
	?>
  <script>
	var big=document.getElementById("big");
	var arr2=
	["./public/img/index_t1.jpg","./public/img/index_t2.jpg","./public/img/index_t3.jpg"];
	i=0;
	function change(){
	  if(i<arr2.length){
		big.src=arr2[i];
		i=i+1;
	  }else{
		i=0;
	  }
	}
	setInterval(change,1500);//每1.5秒图片自动切换一次
  </script>
 </body>
</html>
