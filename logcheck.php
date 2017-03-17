<?php
session_start();
include("conn.php");
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
if(!empty($_POST['submit']))
{
	$logName = $_POST['username'];
	$logPwd = $_POST['userpwd'];
	$sql="select * from user where username='$logName'";
	$result=mysql_fetch_array(mysql_query($sql));
	if (($result['username']==$logName)&&($result['userpwd']==$logPwd))
	{
		$_SESSION['user']=$logName;
		echo "<script>location='index.php'</script>";	
	}
	else
	{
		echo "<script>alert('用户名错误或密码错误！');history.go(-1);</script>";
	}
}
?>