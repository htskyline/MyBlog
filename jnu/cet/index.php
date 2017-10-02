<?php
session_start(); 
include("conn.php");
//include("regQuery.php"); 
error_reporting(0);
header("content-Type: text/html; charset=utf-8");
$title="全国英语四六级成绩查询（CET4、CET6）";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
<link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
<link rel="stylesheet" href="cetCSS.css">
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="cetScript.cs"></script>
<title><?php echo $title;?></title>
</head>
<body ontouchstart>
<header class="index-header">
    
</header>
<div id="queryPage">
    <h1 class="index-title">全国英语四六级成绩查询（CET4、CET6）</h1>
    <?php
    $names = trim($_POST['name']);
    $ids = trim($_POST['cetId']);
    if(!$names)
    {
    ?>
        <form name="queryCet" id="queryCet" method="post" action="">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell">
                    <div class="weui-cell__hd">
                        <label class="weui-label" for="name">姓名</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" placeholder="请输入您的姓名" name="name" type="text" id="name" value="">
                    </div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd">
                        <label class="weui-label" for="cetId">准考证号</label>
                    </div>
                    <div class="weui-cell__hd">            
                        <input class="weui-input" type="number" pattern="[15-20]*" placeholder="请输入准考证号" name="cetId" id="cetId" value="">
                    </div>
                </div>
            </div>
            <label for="clauseAgree" class="weui-agree">
                <input id="clauseAgree" type="checkbox" class="weui-agree__checkbox">
                <span class="weui-agree__text">
                    阅读并同意<a href="javascript:void(0);">《相关条款》</a>
                </span>
            </label>   
            <div class=" index-content-padded">            
                <input disabled class="weui-btn weui-btn_disabled weui-btn_primary" type="submit" name="button" class="buts" id="sub" value="立即查询" />
            </div>     
        </form>
    <?php
    }
    else
    {
        $cetArr = cetPost($ids,$names);
    
       
        switch($cetArr)
        {
            case 100:
                //echo("错误！");
                echo("<script>\$(document).ready(function(){\$(\"#queryPage\").hide();});</script>");
                echo("<script>\$(document).ready(function(){\$(\"#queryError\").show();});</script>");
                break;
            case 200:
                echo("未知错误！");
                break;
            default:
                echo("<script>\$(document).ready(function(){\$(\"#footer\").hide();});</script>");
                echo("<script>\$(document).ready(function(){\$(\"#queryTabbar\").show();});</script>");
                //print_r($cetArr);
        }
    ?>
        <div class="weui-tab">
            <div class="weui-tab__bd">
                <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
                    <div class="weui-cells__title">笔试成绩单</div>
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>姓名</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $cetArr[0]?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>学校</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $cetArr[1]?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>考试级别</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $cetArr[2]?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>准考证号</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $cetArr[3]?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>总分</p>
                            </div>
                            <div class="weui-cell__ft" style="color:red;"><?php echo $cetArr[4]?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>听力</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $cetArr[5]?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>阅读</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $cetArr[6]?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>写作和翻译</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $cetArr[7]?></div>
                        </div>
                    </div>
                    <div class="index-content-padded">
                        <input class="weui-btn weui-btn_primary" type="button" value="返 回"onclick="location.href='index.php';">
                    </div>
                </div>
            </div>
            <div class="weui-tab__bd">    
                <div id="tab2" class="weui-tab__bd-item">
                    <div class="weui-cells__title">口试成绩单</div>
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>准考证号</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $cetArr[8]?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>等级</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $cetArr[9]?></div>
                        </div>
                    </div>
                    <div class="index-content-padded">
                        <input class="weui-btn weui-btn_primary" type="button" value="返 回"onclick="location.href='index.php';">
                    </div>
                </div>
            </div>
            <div class="weui-tabbar" id="queryTabbar">
                <a href="#tab1" class="weui-tabbar__item weui-bar__item--on">
                    <div class="weui-tabbar__icon">
                        <img src="./images/icon_nav_article.png" alt="">
                    </div>
                    <p class="weui-tabbar__label">笔试</p>
                </a>
                <a href="#tab2" class="weui-tabbar__item">
                    <div class="weui-tabbar__icon">
                        <img src="./images/icon_nav_dialog.png" alt="">
                    </div>
                    <p class="weui-tabbar__label">口试</p>
                </a>
                <a href="#tab3" class="weui-tabbar__item">
                    <div class="weui-tabbar__icon">
                        <img src="./images/icon_nav_new.png" alt="">
                    </div>
                    <p class="weui-tabbar__label">吐槽</p>
                </a>
                <a href="#tab4" class="weui-tabbar__item">
                    <div class="weui-tabbar__icon">
                        <img src="./images/icon_nav_search_bar.png" alt="">
                    </div>
                    <p class="weui-tabbar__label">统计</p>
                </a>
            </div>
        </div>
        
    <?php 
    }
    ?>
</div>

<div class="weui-msg" id="queryError">
    <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg-primary"></i></div>
    <div class="weui-msg__text-area">
        <h2 class="weui-msg__title">查询失败</h2>
        <p class="weui-msg__desc">暂时无法查询到您的四、六级考试（含口试）成绩，请检查你的姓名与准考证号输入是否正确</p>
    </div>
    <div class="weui-msg__opr-area">
        <p class="weui-btn-area">
            <a href="javascript:;" class="weui-btn weui-btn_primary returnBefore">返回</a>
            <a href="javascript:;" class="weui-btn weui-btn_default closeAll">关闭</a>
        </p>
    </div>
</div>



<div class="weui-footer" id="footer">
        <p class="weui-footer__links">
            <a href="javascript:void(0);" class="weui-footer__link">底部链接</a>
            <a href="javascript:void(0);" class="weui-footer__link">底部链接</a>
        </p>
    <p class="weui-footer__text">Copyright © 2016-<?php echo date("Y")?> JNUGEEK</p>
</div>

</body>
</html>