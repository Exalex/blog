<?php
    function get_frindLinks() //获取友情链接
    {

        //封装数据层后的写法
        $c=new myClass("friendlinks"); //调用__construct构造函数，实例化虚拟类
        $c->pageUtil;  //调用__get魔法方法，设置module类，
        return $c->getFrdLinks1();//调用__call魔法方法，设置其为module名，返回数据库结果集（数组）
        

        //封装数据层前的写法
//        global $myDb;
//        return $myDb->execForArray("select * from friendlinks order by id DESC");


    }

?>