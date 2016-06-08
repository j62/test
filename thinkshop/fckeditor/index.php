<?php
include_once("fckeditor.php");
$fckeditor = new FCKeditor("content");//定义默认值 name
$fckeditor->Width = "800px";//定义编辑器的宽度
$fckeditor->Height = "350px";//定义编辑器的高度
$fckeditor->Value = "1111111111";//定义默认值
$fckeditor->BasePath='../fckeditor/';
$fckeditor->ToolbarSet = "Default";
$fckeditor->Create();//创建编辑器
?>