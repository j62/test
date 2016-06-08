<?php
include_once("global.php");
if(isset($_POST['sub_x'])){
		$user = trim($_POST['user']);
		$pwd = trim($_POST['pwd']);
		if($user=="" || $pwd==""){
			msg("请输入用户名和密码","./admin_login.php");
		}else{
			$pwd = md5($pwd);
			$sql = "select * from ts_members where user='$user' and pwd='$pwd'";
			$re=mysql_query($sql);
			$arr=mysql_fetch_assoc($re);
			if(mysql_num_rows($re)){
				$_SESSION['user'] = $user;
				$_SESSION['uid'] = $arr['uid'];
				$_SESSION['type']=$arr['type'];
				msg("登录成功","./index.php");
			}else{
				msg("用户名密码出错","./admin_login.php");
			}
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
  <link rel="stylesheet" type="text/css" href="skin/css/global.css"/>
 </head>
 <body>
  <div class="login">
	<div class="login_inner">
		<div class="login_top">
			<p class="login_tt">
				欣材商城后台登录系统
			</p>
			<p class="login_tc">
				login
			</p>
		</div>
		<form action="#" method="post" name="form" onclick="return formsub()">
		<div class="login_tb">
			<ul>
				<li>用户名:<input type="text" name="user" placeholder="请输入用户名" class="user"></li>
				<li>密&nbsp;&nbsp;码:<input type="password" name="pwd" placeholder="请输入密码"></li>
				<li>验证码:<input type="type" style="width:180px"class="inp" name='idcode' placeholder="验证码">&nbsp;&nbsp;<span id="sp"></span></li>
				<li><input type="image" src="./skin/images/login.png" name="sub" class="sub"></li>
			</ul>
		</div>
	  </div>
	  </form>
	</div>
	<script>
		var sp=document.getElementById("sp");
		var arr=['a','b','c','d','e','f',1,2,3,4];
		function getyzm(){
			str="";
			for(var i=1;i<=4;i++){
				str+=arr[Math.round(Math.random()*(arr.length-1))];
			}
			sp.innerHTML=str;
		}
		getyzm();
		sp.onclick=getyzm;
		form.idcode.onblur=function(){
			if(form.idcode.value.toUpperCase()==str.toUpperCase()){
				tag=false;
				form.idcode.style.border="1px solid green";
			}else{
				tag=true;
				form.idcode.style.border="1px solid red";
			}
		}
		function formsub(){
			if(tag==true){
				return false;
			}else{
				return true;
			}
		
		}
	</script>
 </body>
</html>
