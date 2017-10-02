<?php
if(!empty($_POST['submit']))
{
	$regName = trim($_POST['name']);
	$regId = trim($_POST['cetId']);
	$pcreName = '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_]{5,20}$/u';
	$pcreId = '/^[0-9a-zA-Z]{5,20}$/';
	//$sql="select username from user where username='$regName'";
	//$result=mysql_fetch_array(mysql_query($sql));
	if(!preg_match($pcreName,$regName))
	{
		echo "<script>alert('姓名输入不合法！');history.go(-1);</script>";	
		exit();
	}
	else if(!preg_match($pcrePwd,$regPwd))
	{
		echo "<script>alert('准考证输入不合法！');history.go(-1);</script>";
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