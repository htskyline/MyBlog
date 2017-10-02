<?php 
session_start(); 	
include("conn.php");
include("del.php")
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" media="screen and (max-device-width: 960px)" href="stylemobile.css" />
	<link rel="stylesheet" type="text/css" media="screen and (min-width: 960px)" href="style.css" />
	<title>登录时间到！</title>
</head>
<body>
	<script src="myScript.cs"></script>
	<div class="wrapper">
		<div class="header">
				<div class="head-right">
				<?php
					if (isset($_SESSION['user'])) 
					{
						echo "<font>".$_SESSION['user']."</font>";	
				?>
					<button type="button" onmouseover="overButton(this)" onmouseout="outButton(this)" onclick="location='logout.php'">注销</button>
				<?php
					}
					else
					{
				?>
					<button type="button" onmouseover="overButton(this)" onmouseout="outButton(this)" onclick="location='login.php'">登录</button>
					<button type="button" onmouseover="overButton(this)" onmouseout="outButton(this)" onclick="location='register.php'">注册</button>
				<?php
					}
				?>
				</div>
		</div>
		<div class="container">
			<div id="input-frame-log">
				<form action="logcheck.php" method="post" name="logform">
					<div class="input-top" >
						<P>登录</P>
					</div>
					<div class="input-center">
						<p>
						<span>用户名：</span>
						<input type="text" class="input-box" name="username" placeholder="请输入您的用户名"><br>
						<p>
						<span>密码：</span>
						<input type="password" class="input-box" name="userpwd" placeholder="请输入您的密码"><br>
						<br>
					</div>
					<div class="input-bottom">
						<input type="submit" name="submit" value="登录" style="cursor:pointer; background:#1BB8BD; border:none; border-radius:3px; 
						height:40px; color:#fff; font-size:16px; width:100%;" onmouseover="overButton(this)" onmouseout="outButton(this)">
					</div>
				</form>
			</div>
		</div>
		<div class="footer">
			<font>©2016-<?php echo date("Y")?> 黄天晟的个人博客</font>
		</div>	
	</div>
</body>
</html>