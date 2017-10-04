<?php
@mysql_connect("localhost","root","tian6660401")or die("mysql连接失败");
@mysql_select_db("jnu")or die("db连接失败");
//mysql_set_charset("gbk");
mysql_query("set names utf8");
ini_set('date.timezone', 'Asia/Shanghai');

function regQuery($regId,$regName)
{
	$pcreName = '/^[\x{4e00}-\x{9fa5}]{1,6}$/u';
	//$pcreName = '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_]{5,20}$/u';
	$pcreId = '/^\d{15,20}$/';
	if(!preg_match($pcreName,$regName))
	{
		echo "<script>alert('姓名输入不合法！');history.go(-1);</script>";	
		exit();
	}
	else if(!preg_match($pcreId,$regId))
	{
		echo "<script>alert('准考证输入不合法！');history.go(-1);</script>";
		exit();
	}
	else
	{
		$sqlName = check_input($regName);
		$sqlId = check_input($regId);
		$sql="select cetId from cet201706 where cetId='$sqlId'";
		$result=mysql_fetch_array(mysql_query($sql));
		if($result['cetId']=='')
		{
			$cetArr = cetPost($regId,$regName);//数据库中不存在相关数据，开始爬虫
			$cetScores = $cetArr[4];
			$lisScores = $cetArr[5];
			$reaScores = $cetArr[6];
			$wriScores = $cetArr[7];
			$sql="insert into cet201706 (cetName,cetId,cetScores,lisScores,reaScores,wriScores,createTimes) 
			values ($sqlName,'$sqlId','$cetScores','$lisScores','$reaScores','$wriScores',now())";
			mysql_query($sql);//数据库方面处理完毕
			cetSession($cetArr);//设置session	
			return $cetArr;
		}
		else
		{
			$cetArr = cetPost($regId,$regName);//数据库中存在相关数据，仍然开始爬虫
			cetSession($cetArr);//设置session
			return $cetArr;
		}
	}
}

function check_input($value)//预防数据库攻击
{
	// 去除斜杠
	if (get_magic_quotes_gpc())
	{
		$value = stripslashes($value);
	}
	// 如果不是数字则加引号
	if (!is_numeric($value))
	{
		$value = "'" . mysql_real_escape_string($value) . "'";
	}
	return $value;
}

function cetSession($cetArr)
{
	$_SESSION['name'] = $cetArr[0];
	$_SESSION['school'] = $cetArr[1];
	$_SESSION['level'] = $cetArr[2];
	$_SESSION['cetId'] = $cetArr[3];
	$_SESSION['tScore'] = $cetArr[4];
	$_SESSION['listening'] = $cetArr[5];
	$_SESSION['reading'] = $cetArr[6];
	$_SESSION['writing'] = $cetArr[7];
	$_SESSION['cetSId'] = $cetArr[8];
	$_SESSION['Slevel'] = $cetArr[9];
}

?>