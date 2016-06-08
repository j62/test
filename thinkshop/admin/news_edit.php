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
$nid=$_GET['nid'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改新闻分类</title>
<base target="_self">
<link rel="stylesheet" type="text/css" href="skin/css/base.css" />
<link rel="stylesheet" type="text/css" href="skin/css/main.css" />
</head>
<body leftmargin="8" topmargin='8'>
<table width="98%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#CBD8AC" style="margin-bottom:8px;margin-top:8px;">
  <tr>
    <td background="skin/images/frame/wbg.gif" bgcolor="#EEF4EA" class='title' colspan="2"><span><img src='skin/images/frame/arr3.gif' style='margin-right:10px;'>修改新闻分类</span></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>
		<table style="margin-bottom:8px;margin-top:8px;margin-left:20px;">
			<form action="./do_news_edit.php" method="post" enctype="multipart/form-data">
			  <?php
				//根据得到的pid查出修改的新闻所需要的信息
				$sql1="select * from ts_news where nid='$nid'";
				$res=mysql_query($sql1);
				$ar=mysql_fetch_assoc($res);
			  ?>
			  <!-- 把修改的新闻原来的信息自动生成到表单中 -->
			  <tr>
				 <td>新闻标题:</td>
				 <td><input type="text" name="title" value="<?=$ar['title']?>"></td>
			  </tr>
			  <tr>
				 <td width="100px;">上级分类:</td>
				 <td><select name="fname">
						<option value="0/0">顶级分类</option>
						<?php
							foreach($arr as $key=>$vo){ ?>
								<option value="<?=$vo['level'].'/'.$vo['cid']?>"
								<?=$ar['nc_id']==$vo['cid']?"selected":""?>>
								<?=str_repeat("&nbsp;",$vo['level']).$vo['cname']?></option>	
						<?php }
						?>
					</select>
				 </td>
			   </tr>
			   <tr>
				 <td>新闻内容:</td>
				 <td><textarea  name="content"><?=$ar['content']?></textarea></td>
			   </tr>
			   <tr>
				 <td>作者:</td>
				 <td><input type="text" name="author" value="<?=$ar['author']?>"></td>
			   </tr>
			   <tr>
				 <td>新闻图片:</td>
				 <td><input type="file" name="img"><span style="display:inline-block;width:20px;height:20px;background:url(<?=$ar['img']?>)"></span></td>
			   </tr>
				 <td>发表时间:</td>
				 <td><input type="text" name="pubtime" value=<?=date("Y-m-d H:i:s",$ar['pubtime'])?>><span>yyyy-mm-dd</span></td>
				 <input type="hidden" name="nid" value="<?=$nid?>">
			   </tr>
			   <tr>
				 <td colspan="2" align="center" height="40px"><input type="submit" name="sub" value=" 修改 " class="coolbt2"></td>
			   </tr>
		  </form>
		</table>
	</td>
  </tr>
</table>
</body>
</html>