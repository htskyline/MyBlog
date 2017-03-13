<?php
session_start();
include("conn.php");//引入连接数据库
if (!empty($_POST['sub'])) 
{
	$title=$_POST['title'];
	$con=$_POST['con'];
	$writer=$_SESSION['user'];
	$sql="insert into content (id,title,dates,contents,writer) 
    values (null,'$title',now(),'$con','$writer')";	
    mysql_query($sql);
    echo "<script>alert('发表成功！')</script>";
	echo "<script>location='index.php'</script>";
}
?>

