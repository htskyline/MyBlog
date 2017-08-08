<?php
session_start(); 
include("conn.php");
echo '<meta charset="utf-8">';
if(!empty($_POST['submit']))
{
	
	$regID = $_POST['ID'];
	$pcreID = '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_]{5,20}$/u';
	$sql="select * from fee2017 where id='$regID'";
	$result=mysql_fetch_array(mysql_query($sql));
	if ($result['id']!='')
	{
		$_SESSION['id']=$result['id'];
		$_SESSION['name']=$result['name'];
		$_SESSION['major']=$result['major'];
		$_SESSION['tuition']=$result['tuition'];
		$_SESSION['dorm']=$result['dorm'];
		$_SESSION['medicare']=$result['medicare'];
		$_SESSION['fee']=$result['fee'];
		$_SESSION['credit']=$result['credit'];
		$_SESSION['item']=$result['item'];	
		echo "<script>location='fee.php';</script>";	
	} 
	else if(!preg_match($pcreID,$regID))
	{
		echo "<script>alert('请输入正确的学号！');history.go(-1);</script>";	
		exit();
	}
	else
	{
		echo "<script>alert('抱歉，没能在数据库中找到您的信息，请确认学号是否输入正确！');history.go(-1);</script>";	
		exit();	
	}
}
?>