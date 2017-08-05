<?php
session_start();  	
include("conn.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>暨南大学2017年度学宿费查询</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<div data-role="page" id="pageone" style="background:url(http://i1.piimg.com/1949/f2fd03ad31035deb.jpg) 50% 0 no-repeat;background-size:cover">

    <div data-role="header" data-position="fixed" data-fullscreen="true" data-theme="a">
        <h1>暨南大学2017年度学宿费查询</h1>
        <div data-role="navbar">
            <ul>
                <li><a href="https://www.jnugeek.cn">网研首页</a></li>
                <li><a href="https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzAwOTEwMjI0Ng==#wechat_redirect">暨妹妹</a></li>
                <li><a href="http://fee.jnu.edu.cn">在线缴学费</a></li>
            </ul>
        </div>
    </div>

    <div data-role="content" style="padding: 115px 0 125px;width: 85%;margin-top: 0px;margin-right: auto;margin-bottom: 0px;margin-left: auto;position: relative;">
    <?php
		if (isset($_SESSION['name'])) 
		{
	?>
        <div data-role="content">
            <ul data-role="listview">
                <li data-theme="c">姓名：<span style="float:right;"><?php echo $_SESSION['name']; ?></span></li>
                <li data-theme="c">学号：<span style="float:right;"><?php echo $_SESSION['id']; ?></span></li>
                <li data-theme="c">专业：<span style="float:right;"><?php echo $_SESSION['major']; ?></span></li>
                <li data-theme="d">学费：<span style="float:right;"><?php echo $_SESSION['tuition']; ?></span></li>
                <li data-theme="d">住宿费：<span style="float:right;"><?php echo $_SESSION['dorm']; ?></span></li>
                <li data-theme="d">代收医保费：<span style="float:right;"><?php echo $_SESSION['medicare']; ?></span></li>
                <li data-theme="d">合计：<span style="float:right;"><?php echo $_SESSION['fee']; ?></span></li>
            </ul><br><br>
    		<button onclick="location='logout.php';return;" data-icon="back">点击重新输入学号&nbsp&nbsp&nbsp&nbsp</button>
        </div>
	<?php
		}
		else
		{
	?>
        <br><br>
        <form action="regcheck.php" method="post" data-ajax="false">
            <div data-role="fieldcontain">
                <label style="vertical-align:middle; color:white;text-shadow:none;font-weight:bold;" for="ID">学号：</label>
                <input type="text" placeholder="请填入正确的学号" name="ID" id="ID">    
                <br><br><br><br><br> 
            </div>
            <input type="submit" name="submit" data-icon="search" data-iconpos="top" value="查看本年度学宿费">
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