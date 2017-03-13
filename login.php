<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>登录时间到！</title>
</head>
<body>
	<a href="index.php">主页</a>
	<form action="logcheck.php" method="post" name="logform">
		<span>用户名：</span>
		<span><input type="text" name="username" placeholder="请输入您的用户名"></span><br>
		<span>密码：</span>
		<span><input type="password" name="userpwd" placeholder="请输入您的密码"></span><br>
		<span><input type="submit" name="submit" value="登陆"></span>
		<span><a href="register.php">注册</a></span>
	</form>
</body>
</html>