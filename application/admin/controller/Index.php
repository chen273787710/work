<?php

namespace app\admin\controller;
class Index
{
    public function index(){
        $res = self::add();
        return $res;
    }

    private static function add(){
        return 1+1;
    }
}