<?php
error_reporting(E_ALL ^ E_NOTICE);

    function func_doAction($posts)
    {
            if (isset($_GET["type"]))
            {
                if ($_GET["type"]=="login" && isset($posts["cmdLogin"])) //代表点击了login
                {
                    require_once ("module/webuser.php");
                    $user=new webuser();
                    $user->login($posts["userName"], $posts["userPwd"]);
                    header("location:/"); //回到首页
                }

            }
    }

//创建通用函数供调用
function func_loadTpl(){
    $tpl_root="tpl/";
   
    //加载模版  $_GET["type"]---网址参数
    $get_type=$_GET["type"];
    
    if ($get_type) {
        
        if ($get_type=="news") {
            include $tpl_root."news.tpl";
        }
        
        if ($get_type=="reg") {
            include $tpl_root."userreg.tpl";
        }

        if ($get_type=="login") {
            include $tpl_root."userlogin.tpl";
        }
        
        if ($get_type=="logout") {
            include $tpl_root."userlogout.tpl";
        }
    }else {
        //没有参数传递就加载首页
        include $tpl_root.'index.tpl';
        
    }
}


   
