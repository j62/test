<?php
 include_once("./global.php");
 $sql="select * from ts_sysconfig";//取配置表中有关数据
 $re=mysql_query($sql);
 while($list=mysql_fetch_assoc($re)){
	$arr[]=$list;
 }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站配置界面</title>
<base target="_self">
<link rel="stylesheet" type="text/css" href="skin/css/base.css" />
<link rel="stylesheet" type="text/css" href="skin/css/main.css" />
</head>
<body leftmargin="8" topmargin='8'>
<table width="98%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#CBD8AC" style="margin-bottom:8px;margin-top:8px;">
  <tr>
    <td background="skin/images/frame/wbg.gif" bgcolor="#EEF4EA" class='title' colspan="2"><span><img src='skin/images/frame/arr3.gif' style='margin-right:10px;'>网站配置界面</span></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>
		<table style="margin-bottom:8px;margin-top:8px;margin-left:20px;">
		  <form action="./do_conf_list.php" method="post">
			<?php
				foreach($arr as $key=>$vo){ ?>
			 <tr>
				<td width="100px;"><?=$vo['sys_title']?>:</td>
				<?php
					if($vo['sys_type']=="text"){?><!--选文本框还是文本域 -->
						<td><input type="text" name="<?=$vo['sys_name']?>" value="<?=$vo['sys_val']?>"></td>
				<?php }else{ ?>
						<td><textarea rows="5" cols="18" name="<?=$vo['sys_name']?>"><?=$vo['sys_val']?>
						</textarea></td>
				<?php }
				?>
				
			  </tr>
			  <?php	}
			?>
			   <tr>
				 <td colspan="2" align="center" height="40px"><input type="submit" name="sub" value="保存" class="coolbt2"></td>
			   </tr>
		  </form>
		</table>
	</td>
  </tr>
</table>
<?php
	
?>
</body>
</html>