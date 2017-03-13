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
	<title>黄天晟的个人BLOG</title>
</head>
<body>
	<script src="myScript.cs"></script>
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
		
		<div id="content">
			<div class="underline">
				<font size="30px">留言板</font>
			</div>
		 	<?php
			 	if (isset($_SESSION['user'])) 
			 	{
			?>
				<form action="add.php" method="post">
				标题<input type="text" name="title"><br><br>
				内容<textarea rows="5" cols="50" name="con"></textarea><br><br>
				<input type="submit" name="sub" value="发表">
				</form>
			<?php
		 		}
		 		else
		 		{
		 	?>
		 	 	<a href="login.php">登陆</a> <a href="register.php">注册</a>
				<p>请登录后发表评论</p>
		  	<?php
		 		}
		 	?>
			<?php
				$sql="select * from content order by id desc limit 10";
				$query=mysql_query($sql);
				while ($content=mysql_fetch_array($query)) 
				{
			?>
			<strong><?php echo $content['title']?></strong>
			<li>
				<?php 
					echo "作者：".$content['writer']." ";
					echo "时间：".$content['dates'];
					if(delete($content['id']))
					{
				?> 
						<a href="del.php?del=<?php echo $content[id];?>">删除</a>
				<?php
					}
				?>
			</li>
			<p><?php echo $content['contents']?></p>
			<hr>
			<?php
				}
			?>
		</div>
	</div>
	<div class="footer">
			
	</div>
</body>
</html>