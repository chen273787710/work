<?php

/*
 * 重写异常处理类
 *
 * */
namespace app\lib\exception;

use think\Exception;

class BaseException extends Exception
{

    public $code = 500 ;   //定义返回状态码
    public $msg  = '服务器异常'  ;  //定义返回信息
    public $errCode = 999  ;  //定义错误码，用于本地区分异常
    //定义构造函数用户复制对应参数，传入一个数组
    public function __construct($params=[])
    {
        if(!is_array($params)){return;}
        if(array_key_exists('code',$params)){
            $this->code = $params['code'];
        }
        if(array_key_exists('msg',$params)){
            $this->msg = $params['msg'];
        }
        if(array_key_exists('errCode',$params)){
            $this->errCode = $params['errCode'];
        }
    }
}