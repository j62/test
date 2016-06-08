<?php
include_once("./header.php");
?>
<!doctype html>
<html>
 <head>
  <title> 注册页面 </title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
  <style>
  </style>
   <link rel="stylesheet" href="./public/css/index.css">
 </head>
 <body>
	<div class="regist auto">
		<div class="re_l fl">
			<img class="re_img"src="./public/img/regist1.png">
			<p class="re_title1 ">用户注册</p>
			<p class="re_title2">Regist</p>
			<p class="re_title3">for you</p>
		</div>
		<div class="re_r fl">
			<form action="./do_regist.php" method="post" name="form" onclick="return formsub()">
				<!-- onclick="return formsub()"是当提交控件为Image时候的用法，当控件是submit时使用onsubmit="checkform()" -->
				<ul>
					<li style="margin-top:80px"><span>用户名:</span><input type="text" name="user"><b id="b1"></b></li>
					<li><span>密码:</span><input type="password" name="pwd"><b id="b2"></b></li>
					<li><span>确认密码:</span><input type="password" name="repwd"><b id="b3"></b></li>
					<li><span>昵称:</span><input type="text" name="nickname"><b id="b4"></b></li>
					<li><span>邮箱:</span><input type="text" name="email"><b id="b5"></b></li>
					<li><span>验证码:</span>
						<input style="width:150px" type="text" name="idcode"><span id="sp"></span></li>
					<li><input style="width:150px;height:40px;margin-left:150px" type="image" name="img" src="./public/img/regist_btn.png"></li>
				</ul>
			</form>
		</div>
	</div>
	<?php
		include_once("./bottom.php");
	?>
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
		//验证码完成
	    ///正则JS验证///////////
		var b1=document.getElementById("b1");
		var b2=document.getElementById("b2");
		var b3=document.getElementById("b3");	
		var b4=document.getElementById("b4");	
		var b5=document.getElementById("b5");
		var input_u=form.user;
		var input_p=form.pwd;
		var input_re=form.repwd;
		var input_e=form.email;
		var input_n=form.nickname;
		var user_p = /^\w{4,8}$/;
		var pwd_p =   /^[\da-zA-Z_-]{6,12}$/;
		var nick_p=/^[\u4E00-\u9FA5A-Za-z0-9_]+$/;
		var email_p=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/;
		input_u.onfocus=function(){
			b1.innerHTML="请输入4-8位字符";
		}
		input_u.onchange=function(){
			if(user_p.test(input_u.value)){
				tag=false;
				b1.innerHTML="用户名可用";
				b1.style.color="green";
			}else{
				tag=true;
				b1.innerHTML="用户名不可用";
				b1.style.color="red";
			}
			
		}
		input_p.onfocus=function(){
			b2.innerHTML="请输入6-12位字符";
		}
		input_p.onchange=function(){
			if(pwd_p.test(input_p.value)){
				tag=false;
				b2.innerHTML="密码可用";
				b2.style.color="green";
			}else{
				tag=true;
				b2.innerHTML="密码不可用";
				b2.style.color="red";
			}
			
		}
		input_re.onfocus=function(){
			b3.innerHTML="请再次输入密码";
		}
		input_re.onchange=function(){
			if(input_re.value==input_p.value){
				tag=false;
				b3.innerHTML="密码一致";
				b3.style.color="green";
			}else{
				tag=true;
				b3.innerHTML="密码不一致";
				b3.style.color="red";
			}
			
		}
		input_n.onchange=function(){
			if(nick_p.test(input_n.value)){
				tag=false;
				b4.innerHTML="昵称可用";
				b4.style.color="green";
			}else{
				tag=true;
				b4.innerHTML="昵称不可用";
				b4.style.color="red";
			}
			
		}
		input_e.onfocus=function(){
			b5.innerHTML="如xxx@xxx.com";
		}
		input_e.onchange=function(){
			if(email_p.test(input_e.value)){
				tag=false;
				b5.innerHTML="邮箱可用";
				b5.style.color="green";
			}else{
				tag=true;
				b5.innerHTML="邮箱不可用";
				b5.style.color="red";
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
