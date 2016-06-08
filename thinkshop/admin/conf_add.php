<?php
 include_once("./global.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>配置项添加</title>
<base target="_self">
<link rel="stylesheet" type="text/css" href="skin/css/base.css" />
<link rel="stylesheet" type="text/css" href="skin/css/main.css" />
</head>
<body leftmargin="8" topmargin='8'>
<table width="98%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#CBD8AC" style="margin-bottom:8px;margin-top:8px;">
  <tr>
    <td background="skin/images/frame/wbg.gif" bgcolor="#EEF4EA" class='title' colspan="2"><span><img src='skin/images/frame/arr3.gif' style='margin-right:10px;'>添加配置项</span></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>
		<table style="margin-bottom:8px;margin-top:8px;margin-left:20px;">
		  <form action="./do_conf_add.php" method="post">
			 <tr>
				<td width="100px;">配置项标题:</td>
				<td><input type="text" name="sys_title"></td>
			  </tr>
			   <tr>
				 <td>配置项名称:</td>
				 <td><input type="text" name="sys_name"></td>
			   </tr>
			   <tr>
				 <td>配置项数据:</td>
				 <td><input type="text" name="sys_val"></td>
			   </tr>
			   <tr>
				 <td>配置项类型:</td>
				 <td><input type="radio" name="sys_type" value="text" checked>文本框
					 <input type="radio" name="sys_type" value="textarea"> 文本域</td>
			   </tr>
			   <tr>
				 <td colspan="2" align="center" height="40px"><input type="submit" name="sub" value="添加" class="coolbt2"></td>
			   </tr>
		  </form>
		</table>
	</td>
  </tr>
</table>
</body>
</html>