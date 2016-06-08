<?php
include_once("./global.php");
if(isset($_POST['sub'])){
	if($_POST['user']==""||$_POST['pwd']==""){
		msg("请输入用户名和密码","./login.php");
		exit;
	}
	$user=trim($_POST['user']);
	$pwd=md5(trim($_POST['pwd']));
	$sql="select * from ts_members where user='$user' && pwd='$pwd'";
	$re=mysql_query($sql);
	if(mysql_num_rows($re)==1){
		$arr=mysql_fetch_assoc($re);
		if($arr['ifshow']==1){
			msg("审核未通过","./index.php");
		}else{
			$_SESSION['user']=$user;
			$_SESSION['uid']=$arr['uid'];
			$_SESSION['type']=$arr['type'];
			msg("登陆成功","./index.php");
		}

	}else{
		msg("用户名密码错误","./login.php");
	}
}
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
  <div class="login_nav auto mt15">
	<img  class="login_img"src="./public/img/regist1.png">
  </div>
  <div class="login auto mt20">
    <div class="login_l fl">
		<div class="lg_lt">茵曼用户登录</div>
		<form action="" method="post">
			<p style="margin-top:30px">用户名:<input type="text" name="user"></p>
			<p>密&nbsp;&nbsp;&nbsp;码:<input type="password" name="pwd"></p>
			<p><input class="login_sub" type="submit" name="sub" value="登录"></p>
		</form>
		<p class="lr">你还不是会员？点击这里 <a href="./regist.php">免费注册</a></p>
	</div>
    <div class="login_r fl ml20">
		<img src="./public/img/login_pic.png">
		<div class="lg_rb"><span style="color:#4EB2AA;font-family:'楷体'">茵曼</span> 互联网时尚女装品牌</div>
	</div>
  </div>
  <?php
	include_once("./bottom.php");
  ?>
 </body>
</html>
