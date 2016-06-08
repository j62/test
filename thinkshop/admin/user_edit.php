<?php
 include_once("./global.php");
$uid=$_GET['uid'];
$sql="select * from ts_members where uid='$uid'";
$re=mysql_query($sql);
$arr1=mysql_fetch_assoc($re);
?>
<!doctype html>
<html>
 <head>
  <title> new document </title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
  <style>
  </style>
   <link rel="stylesheet" type="text/css" href="skin/css/base.css" />
  <link rel="stylesheet" type="text/css" href="skin/css/main.css" />
  <link rel="stylesheet" type="text/css" href="skin/css/global.css"/>
 </head>
<body leftmargin="8" topmargin='8'>
	<table width="98%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#CBD8AC" style="margin-bottom:8px;margin-top:8px;">
	  <tr>
		<td background="skin/images/frame/wbg.gif" bgcolor="#EEF4EA" class='title' colspan="2"><span><img src='skin/images/frame/arr3.gif' style='margin-right:10px;'>用户修改页面
		</span></td>
	  </tr>
	  <tr bgcolor="#FFFFFF">
		<td>
			<table style="margin-bottom:8px;margin-top:8px;margin-left:470px;">
			  <form action="./do_user_edit.php" method="post" enctype="multipart/form-data">	
				  <tr>
					<td>用户名</td>
					<td>
						<span><?=$arr1['user']?></span>
						<input type="hidden" name="uid" value="<?=$uid?>">
					</td>
				  </tr>	
				  <tr>
					<td>email</td>
					<td>
					  <input type="text" name="email" value="<?=$arr1['email']?>">
					</td>
				  </tr>
				  <tr>
					<td>昵称</td>
					<td>
						<input type="text" name="nickname" value="<?=$arr1['nickname']?>">
					</td>
				  </tr>
				  <tr>
					<td>会员类别</td>
					<td>
						<input type="radio" name="type" value="1"<?=$arr1['type']==1?"checked":""?>>管理员
						<input type="radio" name="type" value="0"<?=$arr1['type']==0?"checked":""?>>会员
					</td>
				  </tr>
				  <tr>
					<td colspan="2" align="center" height="40px">
						<input type="submit" name="sub" value="修改" class="coolbt2"></td>
				  </tr>
			  </form>	
			</table>
		</td>
	  </tr>
	</table>
</body>
</html>