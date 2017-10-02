<?php
@mysql_connect("localhost","root","tian6660401")or die("mysql连接失败");
@mysql_select_db("jnu")or die("db连接失败");
//mysql_set_charset("gbk");
mysql_query("set names utf8");
ini_set('date.timezone', 'Asia/Shanghai');

function cetPost($ids,$name)//设置post信息
{
    $urlPost = "http://www.chsi.com.cn/cet/query?zkzh=$ids&xm=$name";	//POST地址
    $referer = 'http://www.chsi.com.cn/cet/';	//来源地址
    $ip = rand(1,254).'.'.rand(1,254).'.'.rand(1,254).'.'.rand(1,254);  //随机IP
	$html1 = cetCurl($urlPost,"",$referer,$ip);
    $regtest = "/<table[^>]*class=\"cetTable\">(.*?)<\/table>/is";
    $html1 = str_replace(array("\r\n", "\r", "\n", "\t", "&nbsp;")," ",$html1);
    preg_match_all($regtest , $html1 , $matches);//匹配table
	$text = $matches[1][0];
    if($text)
    {
		$arr = sortArr($text);//将匹配到的table送入函数整理成规则的数组
		return $arr;
    }
    else if(!$text)
    {
        return 100;
	}
	else{
		return 200;
	}
}

function sortArr($text)//整理成有9个有效元素的数组
{
	$preg1 = "/\<td.+?\>(.+?)\<\/td\>/";
	$preg2 = "/<td.*?>(<span.*?>)?(?'name'.+?)(<\/span>)?<\/td>/";
	$result = preg_match_all($preg2, $text, $arr);
	array_walk_recursive($arr, function(&$v) { $v = trim($v); });//去除数组元素两旁空白
	$arr0 = $arr[0];
	preg_match_all("/\d+/",$arr0[5],$arr1);
	preg_match_all("/\d+/",$arr0[6],$arr2);
	preg_match_all("/\d+/",$arr0[7],$arr3);
	for($x=0; $x<=9; $x++)
	{
		switch ($x)
		{
			case 5:
				$arrSort[5] = $arr1[0][2];
				break;
			case 6:
				$arrSort[6] = $arr2[0][2];
				break;
			case 7:
				$arrSort[7] = $arr3[0][2];
				break;
			default:
				$arrSort[$x] = $arr0[$x];
		}
	}
	return $arrSort;
}

function cetCurl($url , $post = '' , $referer = '' , $ip = '8.8.8.8')//Curl模拟登陆 
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 600);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);	
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Accept-Language: ch-CN","X-FORWARDED-FOR:$ip","CLIENT-IP:$ip"));
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	if ($referer) {
		curl_setopt($curl, CURLOPT_REFERER, $referer);
	} else {
		curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
	}
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	if (!empty($post)) {
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
	}
		curl_setopt($curl, CURLOPT_COOKIE, '');

	$nres = curl_exec($curl);
	curl_close($curl);
	if ($nres) {
		return $nres;
	}
}

?>