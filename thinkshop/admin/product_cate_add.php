<?php
include_once("./global.php");
$sql="select * from ts_product_cate";
$re=mysql_query($sql);
while($list=mysql_fetch_assoc($re)){
	$arr[]=$list;
}
function get_cate($cate,$pc_f_id=0){
	static $classes=array();
	foreach($cate as $vo){
		if($vo['pc_f_id']==$pc_f_id){
			$classes[]=$vo;
			get_cate($cate,$vo['pc_id']);
		}
	}
	return $classes;
}
$arr=get_cate($arr);
$pc_id=$_GET['pc_id'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加商品分类</title>
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
		  <form action="./do_product_cate_add.php" method="post">
			 <tr>
				 <td>分类名称:</td>
				 <td><input type="text" name="pc_name"></td>
			   </tr>
			 <tr>
				<td width="100px;">上级分类:</td>
				<td><select name="fname">
						<option value="0/0" <?=isset($pc_id)?"disabled":""?>>顶级分类</option>
						<?php
							foreach($arr as $key=>$vo){ ?>
								<option <?php
									if(isset($pc_id)){
										if($pc_id==$vo['pc_id']){
											echo "selected";
										}else{
											echo "disabled=disabled";
										}
									}
								?>  value="<?=$vo['pc_level'].'/'.$vo['pc_id']?>">
								<?=str_repeat("&nbsp;",$vo['pc_level']).$vo['pc_name']?></option>	
						<?php }
						?>
					</select>
				</td>
			  </tr>
			   <tr>
				 <td>首页是否显示</td>
				 <td><input type="radio" name="ifshow" value="0" checked>显示
					 <input type="radio" name="ifshow" value="1"> 不显示</td>
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