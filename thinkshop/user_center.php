<?php
include_once("./global.php");
if(!isset($_SESSION['user'])){
	msg("请登录","./login.php");
}
$user=$_SESSION['user'];
$sql="select * from ts_members where user='$user'";
$re=mysql_query($sql);
$arr=mysql_fetch_assoc($re);


?>
<!doctype html>
<html>
 <head>
  <title> new document </title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
  <style>
  </style>
  <link rel="stylesheet" type="text/css" href="public/css/index.css"/>
 </head>
 <body>
 <div class="us auto">
	<div class="us_inner auto">
		<div class="us_if fl">
			<div class="us_ift">
				<img src="./public/img/user_center.png">
			</div>	
			<div class="us_ifb">
				<div class="d1">用 户</div>
				<div class="d2">中 心</div>
			</div>	
		</div>
		<div class="us_ir fl">
			<div class="us_ir_inner">
				<form action="./do_user_center.php" method="post">
				<li>用户名：<input type="text" name="user" value="<?=$user?> "readonly></li>
				<li>昵&nbsp;&nbsp;&nbsp;称：<input type="text" name="nickname" value="<?=$arr['nickname']?>"></li>
				<li>原密码：<input type="password" name="pwd" placeholder="请输入原密码"></li>
				<li>新密码：<input type="password" name="npwd" placeholder="请输入新密码"></li>
				<li>邮&nbsp;&nbsp;&nbsp;箱：<input type="text" name="email" value="<?=$arr['email']?>"></li>
				<li><input style="width:100px;height:40px;margin-left:105px;border-radius:10px" type="image" src="./public/img/confirm.png" name="sub"></li>
			</div>
		</div>
	</div>
 </div>

 
</body>
</html>
