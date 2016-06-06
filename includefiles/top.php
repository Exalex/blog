<?php 
include 'includefiles/config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $config_defaulttitle; ?></title>
<!--<link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">-->
<script src="/scripts/jq.js"></script>
<script src="/scripts/common.js"></script>
    
<style>
*{margin:0 auto;text-align:center;font-size: 15px;font-family: 微软雅黑}
body{background: url("/images/bg.jpg");}

.container{background-color: midnightblue;height: 130px;margin: 0 auto;color: white;}
.container a{color: white;text-decoration: none;}
.container a:hover{text-decoration: underline;}
.container .top{width: 1000px;}

.logo{float: left;width: 300px;margin-top: 30px;width: 400px;}
.container .menu{float:left;width:400px;margin-top: 30px;text-align: left;}
.container .userinfo{float: right;text-align: right;width: 500px;}
.container .search{border:solid 1px gray;width: 150px;height: 21px;line-height: 21px;background: url("/images/topsearch.gif")no-repeat #fff right;}

.myTable{margin:30px auto;}
input{text-align:left;text-indent:3px;}
/*.text{width: 150px;height: 22px;border:0;border-bottom: solid 1px #000;}*/


/*新闻首页css:index.tpl*/
.outer{width:100%;margin:20px auto;min-height:500px;_height:500px;}
.content{width:1000px;margin:0 auto;}
.content .left{float:left; width:69%;}
.content .right{float:right; width:29%}

.newsregion{background:#fff;float:left;margin:5px auto;border-radius:10px;width:100%;border:solid 1px #ddd;}
.newsregion{color:#9c9c9c;}
.newsregion dt{width:90%;line-height:20px;height:20px;border-bottom:solid 1px #ddd;text-align:left;padding:6px;color:black;}
.newsregion dd{width:90%;line-height:20px;text-align:left;padding:6px;text-indent:2em;}
.newsregion .author{border-top:solid 1px #ddd;background:url(/images/newsbar.jpg);height:30px;width:98%;padding-top:10px;}

</style>
</head>
<body>
    <div class="container">  <!--外部大div-->
        <div class="top">  <!--宽度为1000px-->
            <div class="logo"><a href="/"><img src="/images/logo1.png" alt="程序员在囧图"/></a></div>

            <div class="userinfo">
                <span>
                    <?php
                        require_once "module/webuser.php";
                        echo webuser::getCurrentUser();//获取用户名（静态调用）

                    ?>
                </span>

                <?php if (webuser::userIsLogin()):?> <!--根据是否登录来显示登录和注销链接-->
                |<a href="../index.php?type=logout">注销</a>
                <?php else:?>
                |<a href="../index.php?type=login">立即登录</a>
                <?php endif;?>

            </div>

            <div class="menu">
                <a href="index.php">首页</a> | <a href="index.php?type=news">新闻列表</a> | <a href="index.php?type=reg">用户注册</a>
                <input type="text" class="search"/>
            </div>
        </div>
    </div>

    <?php func_loadTpl();//加载模版?>

