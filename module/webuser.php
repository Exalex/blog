<?php
class webuser //用户处理类
{
    /*
    public $userName; //类属性（用户名属性）
    public $userPwd;
    public $userAge;
    public $userDispalyName;
    */
    public  $erro_code="000";//错误码属性（默认001）

    public $userinfo = array(); //用户属性数组（定义属性太麻烦，用魔术方法赋值）

    function webuser()
    {
        //echo "用户类已经初始化";
    }

    function __set($key, $value)//用set方法给用户信息数组赋值
    {
        $this->userinfo[$key]=$value;
    }

    function __get($key)
    {
        if (array_key_exists($key,$this->userinfo)) //先非空判断键是否存在（和isset不一样，数据可能空）
        {
            return $this->userinfo[$key];
        }
        else
        {
            return  '';
        }
    }

    function validateArgs($args,$num)  //判断传来的参数是否为数组，里面是否为4个
    {
        if ($args && is_array($args) &&count($args==$num))
        {
            return true;
        }
        else
        {
            $this->erro_code='008';
            return false;
        }
    }

    function __call($methodName, $arg)//默认执行函数（当没有对应方法，自动调用此方法。）
    {
        if ($methodName=='add')//add方法的实现(用户注册方法)
        {
            if ($this->validateArgs($arg, 4))//调用参数判断方法再执行addUser方法
            {
                $this->addUser($arg[0],$arg[1],$arg[2],$arg[3]);//调用方法传参，参数为数组
            }
        }
        else if ($methodName=='login') //用户登录
        {
            if ($this->validateArgs($arg, 2)) //如果参数是两个，继续执行
            {
                $this->userLogin($arg[0],$arg[1]);
            }

        }
        else if ($methodName=='logout') //注销
        {
            $this->userLogout();
        }
    }

    static public function userIsLogin() //用户是否登录（判断cookie是否存在）
    {
        if (isset($_COOKIE["mywebuser"]) && $_COOKIE["mywebuser"]!='')
        {
            return true;
        }
        return false;
    }

    static public function getCurrentUser() //获取当前登录用户的名字
    {
        if (self::userIsLogin()) //登陆过则取cookie
        {
            return $_COOKIE["mywebuser"];
        }
        else
        {
            return "游客";
        }
    }

    private function userLogin($username,$userpwd)
    {
        //数据库暂时省略
        if (trim($username)=="") return;

        //设置cookie
        setcookie("mywebuser",$username,time()+100,"/");   //‘/’代表全局生效

    }

    private function userLogout()
    {
        //注销cookie
        setcookie("mywebuser",'',time()-3600,"/");
        
    }

    private function addUser($userName,$userEmail,$userPwd1,$userPwd2) //往数据库插入用户
    {
        if ($userPwd1=="" || $userPwd1!=$userPwd2){  //判断两次密码输入是否一致
            $this->erro_code=001;
            return false;
        }
        if ($userName=="" || $userEmail=="") //用户名和邮箱非空判断
        {
            $this->erro_code=002;
            return false;
        }
        if (isFormat($userName,$userEmail)) //（isFormat需实现）判断邮箱用户名是否合规
        {
            $this->erro_code=003;
            return false;
        }
        if (isRepeat($userName,$userEmail)) //（isRepeat需实现）判断邮箱用户名是否唯一
        {
            $this->erro_code=004;
            return false;
        }
        //都判断后执行代码(伪代码，需要实现数据库方法)
        $ret=dataBase::addData($userName,$userEmail,$userPwd1,$userPwd2);
        if ($ret && intval($ret)>0)//判断数据库返回值有值且>0
        {
            $this->erro_code=000;
            return ture;
        }
        $this->erro_code="009";
        return false;//其他未知的错误
    }


}

?>