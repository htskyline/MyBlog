<?php

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
	else
	{
		return 200;
	}
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

function sortArr($text)//整理成有9个有效元素的数组
{
	$preg1 = "/\<td.+?\>(.+?)\<\/td\>/";
	$preg2 = "/<td.*?>(<span.*?>)?(?'name'.+?)(<\/span>)?<\/td>/";
	$result = preg_match_all($preg2, $text, $arr);
	array_walk_recursive($arr, function(&$v) { $v = trim($v); });//去除数组元素两旁空白
	$arrTemp = $arr[0];
	preg_match_all("/[\x{4e00}-\x{9fa5}]+/u",$arrTemp[0],$arr0);
	preg_match_all("/[\x{4e00}-\x{9fa5}]+/u",$arrTemp[1],$arr1);
	preg_match_all("/[\x{4e00}-\x{9fa5}]+/u",$arrTemp[2],$arr2);
	preg_match_all("/[1-9]\d+/",$arrTemp[3],$arr3);
	preg_match_all("/[1-9]\d+/",$arrTemp[4],$arr4);
	preg_match_all("/[1-9]\d+/",$arrTemp[5],$arr5);
	preg_match_all("/[1-9]\d+/",$arrTemp[6],$arr6);
	preg_match_all("/[1-9]\d+/",$arrTemp[7],$arr7);
	preg_match_all("/[1-9]\d+/",$arrTemp[8],$arr8);
	preg_match_all("/^[A-Za-z]+$/",$arrTemp[9],$arr9);
	for($x=0; $x<=9; $x++)
	{
		switch ($x)
		{
			case 0:
				$arrSort[0] = $arr0[0][0];//姓名
				break;
			case 1:
				$arrSort[1] = $arr1[0][0];//学校
				break;			
			case 2:
				$arrSort[2] = $arr2[0][0];//考试等级
				break;
			case 3:
				$arrSort[3] = $arr3[0][0];//string型的准考证号
				break;
			case 4:
				$arrSort[4] = intval($arr4[0][0]);//转换为整形后的笔试总分
				break;
			case 5:
				$arrSort[5] = intval($arr5[0][2]);//转换为整形后的听力分
				break;
			case 6:
				$arrSort[6] = intval($arr6[0][2]);//转换为整形后的阅读分
				break;
			case 7:
				$arrSort[7] = intval($arr7[0][2]);//转换为整形后的写作和翻译分
				break;
			case 8:
				$arrSort[8] = $arr8[0][0];//string型的口试准考证号
				break;
			case 9:
				$arrSort[9] = $arr9[0][0];//A/B/C口试等级
				break;
			default:
				$arrSort[$x] = $arrTemp[$x];//无用
		}
	}
	return $arrSort;
}
?>