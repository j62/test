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
			<form action="./do_product_add.php" method="post" enctype="multipart/form-data">
			  <tr>
				 <td>产品名称:</td>
				 <td><input type="text" name="pname"></td>
			  </tr>
			  <tr>
				 <td width="100px;">上级分类:</td>
				 <td><select name="fname">
						<option value="0/0">顶级分类</option>
						<?php
							foreach($arr as $key=>$vo){ ?>
								<option value="<?=$vo['pc_level'].'/'.$vo['pc_id']?>">
								<?=str_repeat("&nbsp;",$vo['pc_level']).$vo['pc_name']?></option>	
						<?php }
						?>
					</select>
				 </td>
			   </tr>
			   <tr>
				 <td>产品价格:</td>
				 <td><input type="text" name="price"></td>
			   </tr>
			   <tr>
				 <td>标题图片:</td>
				 <td><input type="file" name="upfile"></td>
			   </tr>
			   <tr>
				 <td>产品描述:</td>
				 <td><textarea  name="descp" rows="5" cols="18"></textarea></td>
			   </tr>
			   <tr>
				<td>产地:</td>
				<td><input type="text" name="addr"></td>
			   </tr>
			   <tr>
				 <td>关键字:</td>
				 <td><input type="text" name="keyword"></td>
			   </tr>
			   <tr>
				 <td>库存:</td>
				 <td><input type="text" name="snums"></td>
			   </tr>
			   <tr>
				 <td>发表时间:</td>
				 <td><input type="text" name="pubtime"><span>yyyy-mm-dd</span></td>
			   </tr>
			   <tr>
				 <td>颜色:</td>
				 <td>
				 <?php
					foreach($colorlist as $v){?>
					<input type="checkbox" name="color[]" value="<?=$v?>"><span style="display:inline-block;width:20px;height:20px;background:<?=$v?>"></span>	
				<?php }
				 ?>
				 </td>
			   </tr>
			   <tr>
				 <td>尺码:</td>
				 <td>
				 <?php
					foreach($sizelist as $va){//遍历颜色库?>
					<input type="checkbox" name="size[]" value="<?=$va?>"><span><?=$va?></span>	
				<?php }
				 ?>
				 </td>
			   </tr>
			   <tr>
				 <td>上架/下架</td>
				 <td><input type="radio" name="ifshow" value="0">上架
					 <input type="radio" name="show" value="1"> 下架
				 </td>
			   </tr>
			   <tr>
				<td>图片库:</td>
				<td><input type="file" name="upfile1"></br>
					<input type="file" name="upfile2"></br>
					<input type="file" name="upfile3"></br>
					<input type="file" name="upfile4">
				</td>
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