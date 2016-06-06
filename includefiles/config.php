<?php

require 'functions.php';
require 'lib/database.php';
require 'lib/myclass.php';

$config_defaulttitle='_程序员聚合器';
$get_pagepath=$_SERVER["PHP_SELF"];

if (isset($_POST) && count($_POST)>0) //代表有表单提交
{
    func_doAction($_POST);
}

if (strpos($get_pagepath, '/index.php')!==FALSE) {
    $config_defaulttitle = '首页'.$config_defaulttitle;
}else if (strpos($get_pagepath, '/news.php')!==FALSE) {
    $config_defaulttitle = '新闻'.$config_defaulttitle;
}else if (strpos($get_pagepath, '/userreg.php')!==FALSE) {
    $config_defaulttitle = '用户注册'.$config_defaulttitle;
    
    /*if ($_POST["cmdLogin"]) {
       $get_userName = $_POST["userName"];
       echo $get_userName;
    }*/
    
}