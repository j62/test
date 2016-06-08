<?php
 header("content-type:text/html;charset=utf-8");
 error_reporting(0);
 session_start();
 date_default_timezone_set("PRC");
 define("HOST","localhost");
 define("USER","root");
 define("PWD","root");
 define("PORT","3306");
 define("DBNAME","ymshop");
 $re=@mysql_connect(HOST,USER,PWD);//连接数据库
 if(!is_resource($re)){
	echo "<p style='color:red'>".mysql_error()."</p>链接数据库失败,用户名密码出错";
 }else{
	$result=@mysql_select_db(DBNAME); //选择数据库 返回值true false
	if(!$result){
		echo "<p style='color:red'>".mysql_error()."</p>数据库选择失败";
	}else{
		mysql_query("set names utf8");
	}
 }
 //弹窗函数///////////////
 function msg($msg,$url){
		echo "
		<script>
			alert('$msg');
			location.href='$url';
		</script>
		";
	}
	///颜色 尺码库
	$colorlist=array("red","blue","green","yellow","black");
	$sizelist=array("s","m","l","xl","xxl");
	///////////////////////////////////////////////////
		//单文件上传函数 （必须上传图片版）
	function do_uploads($upload,$upfiles){
		$dir=$upload;
		$upfile=$_FILES["$upfiles"];
		$name=$upfile['name'];
		if($name==''){
			msg("请上传商品图片","product_add.php");
			exit;
		}
			$types=array("png","jpg","jpeg","webp","gif");
			$type=strtolower(end(explode(".",$name)));//取出文件名后缀
		if(!in_array($type,$types)){
			exit("不支持的文件类型");
		}
			global $newname;
			$newname=$dir."/".date("YmdHis").rand(1,1000).".".$type;
		if(!move_uploaded_file($upfile["tmp_name"],$newname)){
			exit("上传失败");
		}
	}
	//配置项交互函数
	function getconfig($name){
		$sql="select sys_val from ts_sysconfig where sys_name='$name'";
		$re=mysql_query($sql);
		$data=mysql_fetch_assoc($re);
		return $data['sys_val'];
	}
?>