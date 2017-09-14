<?php

namespace app\admin\controller;
use app\lib\exception\BaseException;
use think\Exception;

class Index
{
    public function index(){
       throw new Exception('错误');
    }

}