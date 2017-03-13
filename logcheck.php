<?php
session_start();
include("conn.php");
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
		echo "no!";
	}
}
?>