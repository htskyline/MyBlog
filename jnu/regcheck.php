<?php
session_start(); 
include("conn.php");
echo '<meta charset="utf-8">';
if(!empty($_POST['submit']))
{
	
	$regName = $_POST['wechatName'];
	$regPho = $_POST['phoneNum'];
	$gender = $_POST['gender'];
	$regNum = rand(520,666);
	$pcreName = '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_]{5,20}$/u';
	$sql="select * from wechatname where username='$regName'";
	$result=mysql_fetch_array(mysql_query($sql));
	if ($result['username']!='')
	{
		$_SESSION['user']=$result['username'];
		$_SESSION['num']=$result['luckynumber'];	
		echo "<script>location='luckynum.php';</script>";	
	} 
	else if(!preg_match($pcreName,$regName))
	{
		echo "<script>alert('微信号不合法！');history.go(-1);</script>";	
		exit();
	}
	else
	{
		$sql="insert into wechatname (id,dates,luckynumber,username,phonenumber,gender) 
	    	values (null,now(),'$regNum','$regName','$regPho','$gender')";
		mysql_query($sql);
		if(($regNum==520)||($regNum==666))
		{
			$sql="insert into luckyname (id,dates,luckynumber,username,phonenumber,gender) 
	    	values (null,now(),'$regNum','$regName','$regPho','$gender')";
			mysql_query($sql);
		}
		$_SESSION['user']=$regName;
		$_SESSION['num']=$regNum;	
		echo "<script>location='luckynum.php'</script>";
		exit;	
	}
}
?>