<?php
require ("adodb.inc.php"); //引入adodb数据库框架

class myDataBase // 数据库处理类
{
    public $_dbAddr ='localhost'; //数据库ip
    public $_dbName ='money'; //数据库名
    public $_dbUser ='root'; //用户名
    public $_dbPwd ='006134'; //密码
    public $_db = false;

    function myDataBase() //构造函数=__construct
    {
        //数据库初始化过程，connect
    }

    function __destruct() //析构函数：页面执行完毕时执行此方法
    {
        if ($this->_db && $this->_db->IsConnected())
        {
            $this->_db->disconnect(); //关闭数据库
        }
    }

    function initConnect() //初始化连接
    {
        if ($this->_db && $this->_db->IsConnected()) //判定是否连接过，减小数据库压力
        return;

        $this->_db=NewADOConnection("mysqli");
        $this->_db->connect($this->_dbAddr,$this->_dbUser,$this->_dbPwd,$this->_dbName);
        $this->_db->Query("set names utf8");
        $this->_db->SetFetchMode(ADODB_FETCH_ASSOC);

    }

    function execForArray($sql) //执行一个sql语句，返回数组
    {

        $this->initConnect();
        $result=$this->_db->Execute($sql); //执行adodb的方法

        if ($result)
        {
            while (!$result->EOF) //当EOF到底时结束便利数组
            {
                $resultArray[] = $result->fields; //取得fields字段的数组加入变量数组
                $result->MoveNext(); //往下移动一格
            }
            
            return $resultArray;
        }
        else
        {
            return false;
        }
    }
    
    function execForOne($sql) //执行一个sql语句，返回字符串
    {
        $this->initConnect();
        $result=$this->_db->GetOne($sql); //adodb GerOne方法(获取单个值，一行一列数据)
        return $result;
    }

    function execForNothing($sql) //执行一个sql语句，不返回任何数据
    {
        $this->initConnect();
        $this->_db->Excute($sql);
    }

    function execForTrac($sqllist,$resulttype) //用事物来执行数据库操作(按sql数组顺序执行)
    {
        //参数：$sqllist---sql数组  $resulttype---返回值类型

        $type=array("none","string","array","int"); //返回值类型
        if (!in_array($resulttype, $type)) return false;//参数判断1：不符合返回值类型则退出
        if (count($sqllist)==0) return false; //参数判断2：sql数组个数为0则退出
        $this->initConnect();
        $this->_db->BeginTrans(); //adodb开启事物方法
        $sqlindex=0;
        $ret=false;
        foreach ($sqllist as $sql)
        {
            if ($sqlindex==count($sqllist)-1) //如果是最后一个sql语句，则根据返回类型做不同处理
            {
                if ($resulttype=="none") //无返回值
                {
                    $this->_db->Execute($sql);
                }
                else if ($resulttype=="array")
                {
                    $ret=$this->execForArray($sql); //返回数组
                }else
                {
                    $ret=$this->execForOne($sql); //返回字符串
                }
            }
            else
            {
                $this->_db->Execute($sql);
                $sqlindex++;
            }
        }
        $this->_db->CommitTrans();//提交事务
        if($ret) return $ret; //如果有返回值则返回
    }
}
    
    $myDb = new myDataBase();
    