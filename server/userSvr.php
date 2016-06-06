<?php
//处理用户层面 ajax方法
if (isset($_GET['type']))
{
    switch (intval($_GET['type']))
    {
        case 1: //用户注册名重复判断
            exit('1');
            break;
    }
}
exit('');