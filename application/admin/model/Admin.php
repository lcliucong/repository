<?php
namespace app\admin\model;
use think\Model;

class Admin extends Model
{
    public $autoWriteTimestamp=true;
    /**
     * @var mixed|string
     */
    private $head_img;
}