<?php
 include_once("./global.php");
 $sql="select * from ts_product_cate";
 $re=mysql_query($sql);
 if(mysql_num_rows($re)<1){
	msg("没有商品分类请先添加","./product_cate_add.php");
	exit;
 }
 while($list=mysql_fetch_assoc($re)){
	$arr[]=$list;
 }
 function get_cate($cate,$pc_f_id=0){//做无限分类
   static $classes=array();
	foreach($cate as $v){
		if($pc_f_id==$v['pc_f_id']){
			$classes[]=$v;
			get_cate($cate,$v['pc_id']);
		}
	}
	return $classes;
 }
 $arr=get_cate($arr);
//print_r($arr);die;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品分类管理页面</title>
<base target="_self">
<link rel="stylesheet" type="text/css" href="skin/css/base.css" />
<link rel="stylesheet" type="text/css" href="skin/css/main.css" />
</head>
<body leftmargin="8" topmargin='8'>
<table width="98%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#CBD8AC" style="margin-bottom:8px;margin-top:8px;">
  <tr>
    <td background="./skin/images/frame/wbg.gif" bgcolor="#EEF4EA" class='title' border="0px"><span><img src='./skin/images/frame/arr3.gif' style='margin-right:10px;'>商品分类管理页面</span></td>
	<td align="right" background="./skin/images/frame/wbg.gif" bgcolor="#EEF4EA" class='title' border="0px"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="2">
		<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
			<tr align="center" bgcolor="#FBFCE2" height="25">
				<td width="10%">编号</td>
				<td width="40%">分类名</td>
				<td width="20%">添加子类</td>
				<td width="30%">操作</td>
			</tr>
  <!-- data start-->
			<?php
				foreach($arr as $key=>$vo){ 
					//print_r($vo['pc_id']);
					?>
			<tr align='center' bgcolor="#FFFFFF" height="26" align="center" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
				<td nowrap><?=$vo['pc_id']?></td>
				<td align='left'>
					<span id="arc179">
						<?=str_repeat("&nbsp",$vo['pc_level']).$vo['pc_name']?>
					</span>
				</td>
				<td><a href="./product_cate_add.php?pc_id=<?=$vo['pc_id']?>">添加子类</a></td>
				<td>
					<a href="./product_cate_edit.php?pc_id=<?=$vo['pc_id']?>&&pc_f_id=<?=$vo['pc_f_id']?>"><img src='./skin/images/frame/trun.gif' title="编辑" alt="编辑" onClick="QuickEdit(179, event, this);" style='cursor:pointer' border='0' width='16' height='16'/></a>
					<a href="./product_cate_del.php?pc_id=<?=$vo['pc_id']?>"><img src='./skin/images/frame/gtk-del.png' title="删除" alt="删除" onClick="editArc(179);" style='cursor:pointer' border='0' width='16' height='16' /></a>
					<img src='./skin/images/frame/part-list.gif' title="预览" alt="预览" onClick="viewArc(179);" style='cursor:pointer' border='0' width='16' height='16' />
				</td>
			</tr>
			<?php }
			?>
  <!-- data end-->
  <tr>
	<td colspan="2"><a href="./product_cate_add.php"><input type='button' class="coolbg np" onClick="location='catalog_do.php?channelid=0&cid=0&dopost=addArchives';" value='添加商品分类'/></a></td>
  </tr>
</table>
</body>
</html>