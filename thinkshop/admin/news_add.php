<?php
 include_once("./global.php");
 $sql="select * from ts_news_cate";
$re=mysql_query($sql);
while($list=mysql_fetch_assoc($re)){
	$arr[]=$list;
}
function get_cate($cate,$pc_f_id=0){
	static $classes=array();
	foreach($cate as $vo){
		if($vo['fid']==$pc_f_id){
			$classes[]=$vo;
			get_cate($cate,$vo['cid']);
		}
	}
	return $classes;
}
$arr=get_cate($arr);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加新闻</title>
<base target="_self">
<link rel="stylesheet" type="text/css" href="skin/css/base.css" />
<link rel="stylesheet" type="text/css" href="skin/css/main.css" />
</head>
<body leftmargin="8" topmargin='8'>
<table width="98%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#CBD8AC" style="margin-bottom:8px;margin-top:8px;">
  <tr>
    <td background="skin/images/frame/wbg.gif" bgcolor="#EEF4EA" class='title' colspan="2"><span><img src='skin/images/frame/arr3.gif' style='margin-right:10px;'>添加商品分类</span></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>
		<table style="margin-bottom:8px;margin-top:8px;margin-left:20px;">
			<form action="./do_news_add.php" method="post" enctype="multipart/form-data">
			  <tr>
				 <td>新闻标题:</td>
				 <td><input type="text" name="title"></td>
			  </tr>
			  <tr>
				 <td width="100px;">上级分类:</td>
				 <td><select name="fname">
						<option value="0/0">顶级分类</option>
						<?php
							foreach($arr as $key=>$vo){ ?>
								<option value="<?=$vo['level'].'/'.$vo['cid']?>">
								<?=str_repeat("&nbsp;",$vo['level']).$vo['cname']?></option>	
						<?php }
						?>
					</select>
				 </td>
			   </tr>
			   <td>新闻内容:</td>
			   <td><textarea name="content"></textarea></td>
			   <tr>
				 <td>作者:</td>
				 <td><input type="text" name="author"></td>
			   </tr>
			   <tr>
				 <td>标题图片:</td>
				 <td><input type="file" name="img"></td>
			   </tr>
				 <td>发表时间:</td>
				 <td><input type="text" name="pubtime"><span>yyyy-mm-dd</span></td>
			   </tr>
			   <tr>
				 <td colspan="2" align="center" height="40px"><input type="submit" name="sub" value=" 添加 " class="coolbt2"></td>
			   </tr>
		  </form>
		</table>
	</td>
  </tr>
</table>
</body>
</html>