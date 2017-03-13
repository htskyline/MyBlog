<?php
@mysql_connect("localhost","root","tian6660401")or die("mysql连接失败");
@mysql_select_db("myblog")or die("db连接失败");
//mysql_set_charset("gbk");
//mysql_query("set names utf8");
ini_set('date.timezone', 'Asia/Shanghai');
?>