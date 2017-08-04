<?php
session_start();  	
include("conn.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>暨妹妹的幸运小屋</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<div data-role="page" id="pageone" style="background:url(http://i1.piimg.com/1949/f2fd03ad31035deb.jpg) 50% 0 no-repeat;background-size:cover">

    <div data-role="header" data-position="fixed" data-fullscreen="true" data-theme="a">
        <a href="https://www.jnugeek.cn" data-role="button" data-icon="home">网研首页</a>
        <h1>暨妹妹的幸运小屋</h1>
    </div>

    <div data-role="content" style="padding: 115px 0 125px;width: 85%;margin-top: 0px;margin-right: auto;margin-bottom: 0px;margin-left: auto;position: relative;">
    <?php
		if (isset($_SESSION['user'])) 
		{
	?>
		<h1 style="color:white;text-shadow:none;">欢迎您，<?php echo $_SESSION['user']; ?></h1>
        <h1 style="color:white;text-shadow:none;">您的幸运数字是，<?php echo $_SESSION['num']; ?></h1>
        <button onclick="location='logout.php';return;" data-icon="back">重新输入微信号&nbsp&nbsp&nbsp&nbsp</button>
	<?php
		}
		else
		{
	?>
        <br><br>
        <form action="regcheck.php" method="post" data-ajax="false">
            <div data-role="fieldcontain">
                <label style="vertical-align:middle; color:white;text-shadow:none;font-weight:bold;" for="wechatName">微信号：</label>
                <input type="text" placeholder="请填入有效的微信名" name="wechatName" id="wechatName">    
                <label style="vertical-align:middle; color:white;text-shadow:none;font-weight:bold;" for="phoneNum">手机号：</label>
                <input type="text" placeholder="非必填项目" name="phoneNum" id="phoneNum">
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <legend align="center"></legend>
                    <label for="male">男生</label>
                    <input type="radio" name="gender" id="male" value="male">
                    <label for="female">女生</label>
                    <input type="radio" name="gender" id="female" value="female">	
                </fieldset> 
            </div>
            <input type="submit" name="submit" data-icon="search" data-iconpos="top" value="看看我的幸运数字">
        </form>
	<?php
		}
	?>
    </div>
    <div data-role="footer" data-theme="a">
        <h1>©2016-<?php echo date("Y")?> 暨南大学网络技术研讨会</h1>
    </div>

</div> 
</body>
</html>