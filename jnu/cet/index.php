<?php
session_start();
include("regQuery.php"); 
include("conn.php");
error_reporting(0);
header("content-Type: text/html; charset=utf-8");
$title="成绩查询 | CET";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
<link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
<link rel="stylesheet" href="cetCSS.css">
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="https://cdn.bootcss.com/echarts/3.7.2/echarts.min.js"></script>
<script src="cetScript.cs"></script>
<script src="cetChart.cs"></script>
<title><?php echo $title;?></title>
</head>
<body ontouchstart>

<div id="wapper">
<header class="index-header">
    <h1 class="index-title"><?php echo $title;?></h1>
</header>
<div id="main-content">
<div id="queryPage">
    <?php
    $names = trim($_POST['name']);
    $ids = trim($_POST['cetId']);
    if(!$names&&!isset($_SESSION['name']))//判断有无提交或者有无session
    {
    ?>
        <form name="queryCet" method="post" action="">
            <div class="weui-cells__title">2017年上半年</div>
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
            <label class="weui-agree">
                <input id="clauseAgree" type="checkbox" checked="checked" class="weui-agree__checkbox">
                <span class="weui-agree__text" style="pointer-events: auto;">
                    阅读并同意<a href="javascript:void(0)">《相关条款》</a>
                </span>
            </label>   
            <div class=" index-content-padded">            
                <input class="weui-btn weui-btn_primary" type="submit" name="button" class="buts" id="sub" value="立即查询" />
            </div>     
        </form>
    <?php
    }
    else
    {
        if(!isset($_SESSION['name']))//有提交且无session
        {
            $cetArr = regQuery($ids,$names);
            switch($cetArr)
            {
                case 100://查询失败
                    echo("<script>\$(document).ready(function(){\$(\"#queryPage\").hide();});</script>");
                    echo("<script>\$(document).ready(function(){\$(\"#queryError\").show();});</script>");
                    break;
                case 200://未知错误
                    echo("未知错误！");
                    break;
                default:
                    echo("<script>\$(document).ready(function(){\$(\"#footer\").hide();});</script>");
                    echo("<script>\$(document).ready(function(){\$(\"#queryTabbar\").show();});</script>");
            }
        }
        else if(isset($_SESSION['name']))//有提交且有session
        {
            echo("<script>\$(document).ready(function(){\$(\"#footer\").hide();});</script>");
            echo("<script>\$(document).ready(function(){\$(\"#queryTabbar\").show();});</script>");
        }
        else//未知错误
        {
            echo("未知错误！");
        }
    ?>
        <div class="weui-tab" id="cetTab">
            <div class="weui-tab__bd">
                <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
                    <div class="weui-cells__title">笔试成绩单</div>
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>姓名</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $_SESSION['name']?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>学校</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $_SESSION['school']?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>考试级别</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $_SESSION['level']?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>准考证号</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $_SESSION['cetId']?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>总分</p>
                            </div>
                            <div class="weui-cell__ft" style="color:red;"><?php echo $_SESSION['tScore']?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>听力</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $_SESSION['listening']?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>阅读</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $_SESSION['reading']?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>写作和翻译</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $_SESSION['writing']?></div>
                        </div>
                    </div>
                    <div class="index-content-padded">
                        <input class="weui-btn weui-btn_primary" type="button" value="重新查询"onclick="location='logout.php';">
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
                            <div class="weui-cell__ft"><?php echo $_SESSION['cetSId']?></div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>等级</p>
                            </div>
                            <div class="weui-cell__ft"><?php echo $_SESSION['Slevel']?></div>
                        </div>
                    </div>
                    <div class="index-content-padded">
                        <input class="weui-btn weui-btn_primary" type="button" value="重新查询"onclick="location='logout.php';">
                    </div>
                </div>
            </div>
            <div class="weui-tab__bd">
                <div id="tab3" class="weui-tab__bd-item">
                    <div class="weui-msg" id="tempError">
                        <div class="weui-msg__icon-area"><i class="weui-icon-waiting weui-icon_msg"></i></div>
                        <div class="weui-msg__text-area">
                            <h2 class="weui-msg__title">暂未上线</h2>
                            <p class="weui-msg__desc">该功能正在制作中，暂未上线，敬请期待</p>
                        </div>
                        <div class="weui-msg__opr-area">
                            <p class="weui-btn-area">
                                <a href="javascript:;" class="weui-btn weui-btn_default closeAll">关闭</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="weui-tab__bd">
                <div id="tab4" class="weui-tab__bd-item">
                    <div id="chart-cetScores"></div><!-- 为ECharts准备一个具备大小（宽高）的Dom -->
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
                <a href="#tab4" class="weui-tabbar__item chartingCetScores">
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
</div><!-- class=queryPage -->

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

</div><!-- id=main-content-->

<div class="weui-footer weui-footer_fixed-bottomweui-footer_fixed-bottom" id="footer">
        <p class="weui-footer__links">
            <a href="https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzAwOTEwMjI0Ng==#wechat_redirect" class="weui-footer__link">暨妹妹</a>
            <a href="https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIyMzE0NDY2Ng==#wechat_redirect" class="weui-footer__link">南同学</a>
            <a href="http://new.jnugeek.cn/" class="weui-footer__link">网研首页</a>
        </p>
    <p class="weui-footer__text">Copyright © 2016-<?php echo date("Y")?> JNUGEEK</p>
</div>

</div><!-- id=wapper-->

<script>
    function getScoresLevel()
    {
        var x;
        var a=0,b=0,c=0,d=0,e=0;
        var cetScore = new Array();
        var cetScoreLevel = new Array();
        <?php
            $i = 0;
            $sql="select * from cet201706";
            $query=mysql_query($sql);
            while ($content=mysql_fetch_array($query)) 
            {
        ?>
            cetScore[<?php echo $i?>] = <?php echo $content['cetScores']?>;
        <?php 
            $i++;
            }
        ?>
        for(x=0; x<=cetScore.length; x++)
        {
            if(cetScore[x]<=425&&cetScore[x]>350)//学弱
            {
                d++;
            }
            else if(cetScore[x]<=550&&cetScore[x]>425)//学民
            {
                c++;
            }
            else if(cetScore[x]<=610&&cetScore[x]>550)//学霸
            {
                b++;
            }
            else if(cetScore[x]<=710&&cetScore[x]>610)//学神
            {
                a++;
            }
            else if(cetScore[x]<=350&&cetScore[x]>0)//学渣
            {
                e++;
            }
        } 
        cetScoreLevel = [a,b,c,d,e];
        return cetScoreLevel;
    }
</script>
</body>
</html>