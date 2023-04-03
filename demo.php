<?  
	include 'condition.php';
	include 'sql.php';
	$keys=$_COOKIE['keys'];
	$sql="select * from `rookie_user` where `keys`='$keys'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result, 3);  
    if (!mysqli_num_rows($result))  
	{  
		//keys不存在
		header("Location:index.php");
	}  
	$userid=$row['id'];
 ?>
<?php
$id=$_GET['id'];
if($id<1 or $id>5){
	$id=1;
}
if($id==1){$title='个人中心-管理后台';}
if($id==2){$title='我的应用-管理后台';}
if($id==3){$title='资源中心-管理后台';}
if($id==4){$title='企业猫资源-管理后台';}
if($id==5){$title='项目中心-管理后台';}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="UTF-8">
<title><?echo $title;?></title>

<link rel="stylesheet" href="css/demo.css">
<!--page5_2-->
<link rel="stylesheet" href="css/style-index.css"> 
<script type="text/javascript" src="js/jquery.min.js"></script>



<!--主要样式-->
<link type="text/css" rel="stylesheet" href="css/iosOverlay.css">
</head>
<body>

<div class="bg-gray-100 dark:bg-gray-900 dark:text-white text-gray-600 h-screen flex overflow-hidden text-sm">
  <!--引入左侧导航-->
  <?  include './code/header.php'; ?>
  <div class="flex-grow overflow-hidden h-full flex flex-col">
	<!--顶部导航栏-->
    <?  include './code/top.php'; ?>
    <div class="flex-grow flex overflow-x-hidden">
		<!--左侧列表-->
	<?  include './code/page'.$id.'.php'; ?>
</div>

  
</body>
</html>
