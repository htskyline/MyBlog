<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>注册时间到！</title>
</head>
<body>
	<a href="index.php">主页</a>
	<form action="regcheck.php" method="post" name="regform">
		<span>用户名：</span>
		<span><input type="text" name="username" placeholder="请输入有效用户名"></span><br>
		<span>密码：</span>
		<span><input type="password" name="userpwd" placeholder="请输入正确格式的密码"></span><br>
		<span><input type="password" name="userpwd2" placeholder="请重复输入密码"></span><br>
		<span><input type="submit" name="submit" value="注册"></span>
		<span><a href="login.php">登陆</a></span>
	</form>
</body>
</html>