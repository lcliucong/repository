<?php
namespace app\admin\behavior;
use think\Hook;

class Hooks{
    /***
    * @param $params
    * 初始化标签位
    *
    */
    public function run($params)
    {
        echo $params;
        return true;
    }
}