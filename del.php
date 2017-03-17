<?php
session_start();
include("conn.php");
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
function delete($id)
{
	$sql="select * from content where id='$id'";
	$result=mysql_fetch_array(mysql_query($sql));
	if ($result['writer']==$_SESSION['user'])
	{
		return true;
	}
	else
	{
		return false;
	}
}
if (!empty($_GET['del'])) 
{
	$d=$_GET['del'];
	$sql="delete from content where id = $d";
	mysql_query($sql);
	echo "<script>alert('删除成功！')</script>";
	echo "<script>location='index.php'</script>";
}
?>