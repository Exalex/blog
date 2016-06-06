<?php
require ("../lib/myclass.php");

$sql1 = "insert into users(username,userpwd,useremail,addtime) values('yang','123','yang@qq.com','2013-2-2 22:33:33');";
$sql2="select LAST_INSERT_ID() into @usernewid;";
$sql3="insert into usersinfo(userid) values(@usernewid);"; //@usernewid表示临时变量
$sql4="select @usernewid";

$db=new myDataBase();
$ret=$db->execForTrac(array($sql1,$sql2,$sql3,$sql4),"int");
echo $ret;
