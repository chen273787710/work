<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/14 0014
 * Time: 16:54
 */

namespace app\lib\exception;


use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandle extends Handle
{
    /*
     * 定义返回参数
     * */
    private $code;
    private $msg;
    private $errCode;

    //重写异常处理函数，
    //参数为php异常类
    public function render(\Exception $e)
    {
        //判断是否为来自自定义异常
        if($e instanceof BaseException){
            $this->code = $e->code ;
            $this->msg  = $e->msg  ;
            $this->errCode = $e->errCode ;
        }else{
            $this->recodeErrorLog($e);
            if(config('app_debug')){
                return parent::render($e);
            }else{
                $this->code = 500 ;
                $this->msg  = '服务器内部错误！';
                $this->errCode = 999;
            }
        }
        //获取请求的路由
        $request = Request::instance();
        $url = $request->url();
        $result = [
            'errCode'  => $this->errCode ,
            'msg'      => $this->msg     ,
            'url'      => $url ,
        ];
        return json($result,$this->code);
    }
    //只将错误信息写入日志，减少日志量，需要在配置文件中配置 log['type'] => 'test'关闭日志
    public function recodeErrorLog(\Exception $e){
        Log::init([
            'type' => 'File' ,
            'path' => LOG_PATH,
            'level' => ['error'],
        ]);
        Log::record($e->getMessage(),'error');
    }
}