<?php
include_once("./global.php");
$sql="select * from ts_product";
//开始组装分页代码
$records=mysql_num_rows(mysql_query($sql));//获得总记录数
$record=4;
$pages=ceil($records/$record);
	if($_GET['page']<1){
		$page=1;
	}elseif($_GET['page']>$pages){
		$page=$pages;
	}else{
		$page=$_GET['page'];
	}
$start=($page-1)*$record;
$sql.=" limit $start,$record";
//组装分页代码结束
$re=mysql_query($sql);
while($list=mysql_fetch_assoc($re)){
	$arr[]=$list;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品管理</title>
<base target="_self">
<link rel="stylesheet" type="text/css" href="skin/css/base.css" />
<link rel="stylesheet" type="text/css" href="skin/css/main.css" />
</head>
<body leftmargin="8" topmargin='8'>
<table width="98%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#CBD8AC" style="margin-bottom:8px;margin-top:8px;">
  <tr>
    <td background="./skin/images/frame/wbg.gif" bgcolor="#EEF4EA" class='title' border="0px"><span><img src='./skin/images/frame/arr3.gif' style='margin-right:10px;'>商品管理</span></td>
	<td align="right" background="./skin/images/frame/wbg.gif" bgcolor="#EEF4EA" class='title' border="0px"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="2">
		<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
			<tr align="center" bgcolor="#FBFCE2" height="25">
				<td width="5%">ID</td>
				<td width="28%">商品名称</td>
				<td width="10%">商品图片</td>
				<td width="10%">类目</td>
				<td width="13%">价格</td>
				<td width="16%">上架时间</td>
				<td width="8%">上下架</td>
				<td width="10%">操作</td>
			</tr>
  <!-- data start-->
			<?php
				foreach($arr as $key=>$vo){ ?>
			<tr align='center' bgcolor="#FFFFFF" height="26" align="center" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
				<td nowrap><?=$vo['pid']?></td>
				<td align='left'>
					<span id="arc179">
					<?=$vo['pname']?>
					</span>	</td>
				<td><img style="width:20px;height:20px;" src="<?=$vo['thumb']?>"></td>
				<td>
					<?php
						$sql1="select * from ts_product_cate where pc_id=".$vo['p_c_id'];//查出商品所属类别
						$res=mysql_query($sql1);
						$arr=mysql_fetch_assoc($res);
					?>
					<?=$arr['pc_name']?>
				</td>
				<td><?=$vo['price']?></td>
				<td><?=date("Y-m-d",$vo['pubtime'])?></td>
				<td><?=$vo['ifshow']==0?"上架":"下架"?></td>
				<td>
					<a href="./product_edit.php?pid=<?=$vo['pid']?>"><img src='./skin/images/frame/trun.gif' title="编辑" alt="编辑" onClick="QuickEdit(179, event, this);" style='cursor:pointer' border='0' width='16' height='16' /></a>
					<a href="./product_del.php?pid=<?=$vo['pid']?>"><img src='./skin/images/frame/gtk-del.png' title="删除" alt="删除" onClick="editArc(179);" style='cursor:pointer' border='0' width='16' height='16' /></a>
				</td>
			</tr>
			<?php	}
			?>
			
  <!-- data end-->
  <!-- page start-->
	  <tr align="right" bgcolor="#F9FCEF">
		<td height="36" colspan="10" align="center">
			<div class="pagelistbox">
				<span>共 <?=$pages?> 页/<?=$records?>条记录 </span>
				<a href="?page=1"><span class='indexPage'>首页</span></a>
				<a class='prevPage' href='?page=<?=$page-1?>'>上页</a> 
				<a class='nextPage' href='?page=<?=$page+1?>'>下页</a> 
				<a class='endPage' href='?page=<?=$pages?>'>末页</a> 
				</div>
			</td>
	  </tr>
  <!-- page end-->
  <tr>
	<td colspan="2"><a href="./product_add.php"><input type='button' class="coolbg np" onClick="location='catalog_do.php?channelid=0&cid=0&dopost=addArchives';" value='添加商品'/></a></td>
  </tr>
</table>
</body>
</html>