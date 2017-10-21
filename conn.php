<?php
@mysql_connect("localhost","root","test123456")or die("mysql连接失败");
@mysql_select_db("myblog")or die("db连接失败");
//mysql_set_charset("gbk");
mysql_query("set names utf8");
ini_set('date.timezone', 'Asia/Shanghai');
?>