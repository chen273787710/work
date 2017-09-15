<?php

namespace app\lib\validate;
use app\lib\exception\BaseException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    //验证方法
    public function gonCheck(){
        //获取参数
        $request = Request::instance();
        $params  = $request->param();
        //执行验证规则
        $result = $this->batch()->check($params);
        if($result){
            //验证通过
            return true;
        }else{
            throw new BaseException(['msg'=>$this->error]);
        }
    }
}