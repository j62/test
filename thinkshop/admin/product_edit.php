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
$pid=$_GET['pid'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改商品</title>
<base target="_self">
<link rel="stylesheet" type="text/css" href="skin/css/base.css" />
<link rel="stylesheet" type="text/css" href="skin/css/main.css" />
</head>
<body leftmargin="8" topmargin='8'>
<table width="98%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#CBD8AC" style="margin-bottom:8px;margin-top:8px;">
  <tr>
    <td background="skin/images/frame/wbg.gif" bgcolor="#EEF4EA" class='title' colspan="2"><span><img src='skin/images/frame/arr3.gif' style='margin-right:10px;'>修改商品分类</span></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>
		<table style="margin-bottom:8px;margin-top:8px;margin-left:20px;">
			<form action="./do_product_edit.php" method="post" enctype="multipart/form-data">
			  <?php
				//根据得到的pid查出修改的商品所需要的信息
				$sql1="select * from ts_product where pid='$pid'";
				$res=mysql_query($sql1);
				$ar=mysql_fetch_assoc($res);
			  ?>
			  <!-- 把修改的商品原来的信息自动生成到表单中 -->
			  <tr>
				 <td>产品名称:</td>
				 <td><input type="text" name="pname" value="<?=$ar['pname']?>"></td>
			  </tr>
			  <tr>
				 <td width="100px;">上级分类:</td>
				 <td><select name="fname">
						<option value="0/0">顶级分类</option>
						<?php
							foreach($arr as $key=>$vo){ ?>
								<option value="<?=$vo['pc_level'].'/'.$vo['pc_id']?>"
								<?=$ar['p_c_id']==$vo['pc_id']?"selected":""?>>
								<?=str_repeat("&nbsp;",$vo['pc_level']).$vo['pc_name']?></option>	
						<?php }
						?>
					</select>
				 </td>
			   </tr>
			   <tr>
				 <td>产品价格:</td>
				 <td><input type="text" name="price" value="<?=$ar['price']?>"></td>
			   </tr>
			   <tr>
				 <td>标题图片:</td>
				 <td><input type="file" name="upfile"><span style="display:inline-block;width:20px;height:20px;background:url(<?=$ar['thumb']?>)"></span></td>
			   </tr>
			   <tr>
				 <td>产品描述:</td>
				 <td><textarea  name="descp" rows="5" cols="18"><?=$ar['descp']?></textarea></td>
			   </tr>
			   <tr>
				<td>产地:</td>
				<td><input type="text" name="addr" value="<?=$ar['addr']?>">
					<input type="hidden" name="pid" value="<?=$ar['pid']?>">
				</td>
			   </tr>
			   <tr>
				 <td>关键字:</td>
				 <td><input type="text" name="keyword" value="<?=$ar['keyword']?>"></td>
			   </tr>
			   <tr>
				 <td>库存:</td>
				 <td><input type="text" name="snums" value="<?=$ar['snums']?>"></td>
			   </tr>
			   <tr>
				 <td>发表时间:</td>
				 <td><input type="text" name="pubtime" value=<?=date("Y-m-d H:i:s",$ar['pubtime'])?>><span>yyyy-mm-dd</span></td>
			   </tr>
			   <tr>
				 <td>颜色:</td>
				 <td>
				 <?php
					$colour=explode(";",$ar['color']);
					foreach($colorlist as $v){?>
					<input type="checkbox" name="color[]" value="<?=$v?>" <?=in_array($v,$colour)?"checked":""?>><span style="display:inline-block;width:20px;height:20px;background:<?=$v?>"></span>	
				<?php }
				 ?>
				 </td>
			   </tr>
			   <tr>
				 <td>尺码:</td>
				 <td>
				 <?php
					$siz=explode(";",$ar['size']);
					foreach($sizelist as $va){?>
					<input type="checkbox" name="size[]" value="<?=$va?>" <?=in_array($va,$siz)?"checked":""?>><span><?=$va?></span>	
				<?php }
				 ?>
				 </td>
			   </tr>
			   <tr>
				 <td>上架/下架</td>
				 <td><input type="radio" name="ifshow" value="0" <?=$ar['ifshow']==0?"checked":""?>>上架
					 <input type="radio" name="show" value="1" <?=$ar['ifshow']==1?"checked":""?>> 下架
				 </td>
			   </tr>
			   <tr>
				<td>图片库:</td>
					<?php
						$pimg=explode(";",$ar['pimgs']);
					?>
				<td>
					<?php
						foreach($pimg as $vb){ ?>	
					<input type="file" name="upfile1[]">
					<span style="display:inline-block;width:20px;height:20px;background:url(<?=$vb?>)"></span></br>
				
				<?php	}
					?>
				</td>
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