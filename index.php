
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
	}  
    else  
	{
		header("Location:demo.php");
	}
 ?>


<!DOCTYPE html>
<html lang="en" >

<head>
<meta charset="UTF-8">
<title>企业猫Android网址封装系统-用户登录</title>

<!--图标样式-->

<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>

<body>
<!--
  <h2>欢迎使用企业猫Android网址封装系统</h2>
 -->
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="#">
			<h1>注册</h1>
			<!--
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>第三方账号注册</span>
			-->
			<input id="reg_name" type="text" placeholder="昵称" />
			<input id="reg_user" type="number" placeholder="账号" />
			<input id="reg_pass" type="password" placeholder="密码" />
			<button onclick="reg()">注册</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="#">
			<h1>登录</h1>
			<!--
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>第三方账号登录</span>
			-->
			<input id="user" type="number" placeholder="账号" />
			<input id="pass" type="password" placeholder="密码" />
			<!--<a href="#" onclick="alert('暂未提供找回密码服务')">忘记密码？</a>-->
			<button onclick="login()">登录</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>欢迎回来！</h1>
				<p>请您先登录的个人信息，进行操作。</p>
				<button class="ghost" id="signIn">登录</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>你好朋友！</h1>
				<p>输入您的个人信息注册成为会员。</p>
				<button class="ghost" id="signUp">注册</button>
			</div>
		</div>
	</div>
</div>

<footer>
	<p>
		企业猫源码www.qymao.cn
	</p>
</footer>
  
  






</body>
<script>
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>

</html>
