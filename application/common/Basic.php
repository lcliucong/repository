<?php
namespace app\common;
use think\Controller;
use think\facade\Session;

class Basic extends Controller
{
    //如果你的控制器类继承了\think\Controller类的话，可以定义控制器初始化方法_initialize，在该控制器的方法调用之前首先执行。
    public function initialize()
    {
        //判断有无admin_username这个session，如果没有，跳转到登陆界面
//        if (!Session::get('info')) {

//            echo $this->error('您没有登陆','Login/login');

//        }
    }
}