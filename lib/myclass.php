<?php
require_once ("database.php");
class  myClass  //虚拟类处理
{
    var $_confContent;
    var $_classSet=array();
    var $_current=false; //当前虚拟对象

   function __construct($conf)  //构造方法：实例化类时候调用
   {   //根据$conf传来的文件名字读取文件内容

       $this->_confContent=file_get_contents("lib/myclassconf/".$conf.".xml");
     
       $this->loadConf();//解析配置文件
   }

    private  function loadConf()
    {   //读取解析xml文件
        $conf = (array)simplexml_load_string($this->_confContent);

        //非空判断，节点非空判断
        if (!$conf || count($conf["configs"])==0 || count($conf["configs"]->modules)==0) return;

        foreach ($conf["configs"]->modules->module as $module) //遍历modules下1个或多个节点
        {
            $tmp=array();
            $tmp["name"]=strval($module->name);
            $tmp["sql"]=$module->sql;
            $tmp["className"]=strval($module->className);
            $tmp["description"]=strval($module->description);
            $tmp["resultType"]=strval($module->resultType);

            if (isset($this->_classSet[$tmp["className"]]))  //判断临时数组中没有这个module类名
            {   //有这个类的话则，则把数组放进已经有类的数组中，以此类为key
                $temp_set=$this->_classSet[$tmp["className"]];
                $temp_set[]=$tmp;
                $this->_classSet[$tmp["className"]]=$temp_set;
            }
            else //没有的话把tep数组加进_classSet数组，并以当前className为key
            {
                $this->_classSet[$tmp["className"]]=array($tmp);
            }
        }

    }

    function __get($classname) //get魔术方法，设置当前module类名
    {
        if (array_key_exists($classname, $this->_classSet)) //传进来的类名（key）有没有在_classSet数组里
        {
            $this->_current=$this->_classSet[$classname]; //把匹配类名赋值给_current当前要使用的类名
        }
    }

    function __call($methodname, $params)
    {
        if (!$this->_current) return;  //如果当前module数组没有值，直接退出
        foreach ($this->_current as $c)
        {
            if ($methodname==$c["name"])  //匹配module名执行对应的sql语句
            {
                $sql=$c["sql"]; //取出对应的sql并调用database的方法执行语句
                $myDB=new myDataBase(); //实例化数据库处理类

                //判断xml节点里sql语句数量
                if (count($sql)==1){
                    //判断类型执行数据库方法
                    if ($c["resultType"]=="none"){
                        return $myDB->execForNothing(strval($sql));}
                    else if ($c["resultType"]=="array"){
                        return $myDB->execForArray(strval($sql));}
                    else{
                        return $myDB->execForOne(strval($sql));} //返回结果集

                }
                else //多sql代表要开启事务处理
                {
                    $sqllist=array();
                    foreach ($sql as $str_sql){
                        $sqllist[]=$str_sql;
                    }
                    return $myDB->execForTrac($sqllist,$c[resultType]);
                }

            }
        }
    }
}