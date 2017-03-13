<?php
include("conn.php");
if(!empty($_POST['submit']))
{
	$regName = $_POST['username'];
	$regPwd = $_POST['userpwd'];
	$pcreName = '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_]{5,20}$/u';
	$pcrePwd = '/^[0-9a-zA-Z]{5,20}$/';
	$sql="select username from user where username='$regName'";
	$result=mysql_fetch_array(mysql_query($sql));
	if ($result['username']!='')
	{
		echo "<script>alert('用户名已存在！');history.go(-1);</script>";
		exit();	
	} 
	if(!preg_match($pcreName,$regName))
	{
		echo "<script>alert('用户名不合法！');history.go(-1);</script>";	
		exit();
	}
	if($_POST['userpwd2']!=$regPwd)
	{
		echo "<script>alert('两次输入密码不相同！');history.go(-1);</script>";
		exit();	
	}
	if(!preg_match($pcrePwd,$regPwd))
	{
		echo "<script>alert('密码不合法！');history.go(-1);</script>";
		exit();
	}
	else
	{
		$sql="insert into user (id,username,userpwd,createtime) 
	    values (null,'$regName','$regPwd',now())";	
	    mysql_query($sql);
		echo "<script>alert('注册成功！')</script>";
		echo "<script>location='login.php'</script>";
	}
}
?>