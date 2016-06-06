<?php
    require_once("module/webuser.php");
    $user=new webuser();
    $user->logout();
?>

<p style="height: 500px;padding-top: 50px;font-size: 20px" >
    正在注销中...<a href="/">返回首页</a>
</php>