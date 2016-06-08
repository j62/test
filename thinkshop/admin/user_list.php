<?php
include_once("./global.php");
include_once("./common.php");
$sql="select * from ts_members order by retime desc";
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
//审核操作开始
$uid=$_GET['uid'];
if(isset($uid)){
	$sql1="select ifshow from ts_members where uid='$uid'";
	$res=mysql_query($sql1);
	$ar=mysql_fetch_assoc($res);
	$ifshow=$ar['ifshow'];
	if($ifshow==1){
		$sql2="update ts_members set ifshow=0 where uid='$uid'";
		mysql_query($sql2);
		if(mysql_affected_rows()==1){
			header("location:./user_list.php");
		}else{
			msg("操作失败","./user_list.php");
		}
	}else{
		$sql2="update ts_members set ifshow=1 where uid='$uid'";
		mysql_query($sql2);
		if(mysql_affected_rows()==1){
			header("location:./user_list.php");
		}else{
			msg("操作失败","./user_list.php");
		}
	}
}
//审核操作解释
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理</title>
<base target="_self">
<link rel="stylesheet" type="text/css" href="skin/css/base.css" />
<link rel="stylesheet" type="text/css" href="skin/css/main.css" />
</head>
<body leftmargin="8" topmargin='8'>
<table width="98%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#CBD8AC" style="margin-bottom:8px;margin-top:8px;">
  <tr>
    <td background="./skin/images/frame/wbg.gif" bgcolor="#EEF4EA" class='title' border="0px"><span><img src='./skin/images/frame/arr3.gif' style='margin-right:10px;'>用户管理</span></td>
	<td align="right" background="./skin/images/frame/wbg.gif" bgcolor="#EEF4EA" class='title' border="0px"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="2">
		<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
			<tr align="center" bgcolor="#FBFCE2" height="25">
				<td width="10%">用户编号</td>
				<td width="18%">登录名</td>
				<td width="10%">昵称</td>
				<td width="13%">用户等级</td>
				<td width="16%">邮箱</td>
				<td width="13%">注册时间</td>
				<td width="10%">审核</td>
				<td width="10%">操作</td>
			</tr>
  <!-- data start-->
			<?php
				foreach($arr as $key=>$vo){ ?>
			<tr align='center' bgcolor="#FFFFFF" height="26" align="center" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
				<td align='left'>
					<span id="arc179">
					<?=$vo['uid']?>
					</span>	</td>
				<td><?=$vo['user']?></td>
				<td>
					<?=$vo['nickname']?>
				</td>
				<td><?=$vo['type']==1?"管理员":"会员"?></td>
				<td><?=$vo['email']?></td>
				<td><?=date("Y-m-d H:i:s",$vo['retime'])?></td>
				<td><?php
					if($vo['ifshow']==0){ ?>
						<span>审核通过</span>
						<?php
							if($vo['type']==1){ ?>
								
						<?php	}else{ ?>
							<a href="?uid=<?=$vo['uid']?>"><button>禁言</button></a>
						<?php	}
						?>
							
				<?php }else{ ?>
						<span>小黑屋</span>
						<a href="?uid=<?=$vo['uid']?>"><button>通过</button></a>
				<?php }
				?>
				</td>
				<td>
					<a href="./user_edit.php?uid=<?=$vo['uid']?>"><img src='./skin/images/frame/trun.gif' title="编辑" alt="编辑" onClick="QuickEdit(179, event, this);" style='cursor:pointer' border='0' width='16' height='16' /></a>
					<a href="./user_del.php?uid=<?=$vo['uid']?>"><img src='./skin/images/frame/gtk-del.png' title="删除" alt="删除" onClick="editArc(179);" style='cursor:pointer' border='0' width='16' height='16' /></a>
					<img src='./skin/images/frame/part-list.gif' title="预览" alt="预览" onClick="viewArc(179);" style='cursor:pointer' border='0' width='16' height='16' />
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
</table>
</body>
</html>