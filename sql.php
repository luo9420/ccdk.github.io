<?php
$con=mysqli_connect('127.0.0.1','rookiebug','rookiebug','rookiebug',3306);
if(!$con)
{
	die(mysql_error());
	exit;
}
//__________________________________________________
mysqli_select_db($con,'abc123');//选择数据库
	//数据预处理 防止查询不到数据
mysqli_query($con,"set names 'utf8'");
	//进行数据查询
?>