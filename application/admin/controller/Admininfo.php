<?php
namespace app\admin\controller;

use app\common\Basic;
use stdClass;
use think\facade\Env;
use think\facade\Session;
use app\admin\model\Admin;

class Admininfo extends Basic
{
    public function admininfo(){
//        $id = $this->request->get('id');
//        $admins = new Admins;
//        $admininfo = $admins->where('id',$id)->find();
          $admininfo = Session::get('info');
          define('arr',[
             'a'=>'apple',
             'b'=>'banana',
             'c'=>'cmp',
             'd'=>'doctor'
          ]);
          dump(arr);die;
        return $this->fetch('admininfo',['userinfo'=>$admininfo]);
    }
    public function infoedit(){
        $admin = new Admin;
        $id = $this->request->param();
//        var_dump($id);die;
       if(isset($id['user_password'])){
          if(trim($id['user_password'], ' ')==null){
              echo $this->error('请输入密码');
          }
//          if(trim($id['user_password']).strstr($id['user_password'],$rstr)==true || trim($id['repassword']).strstr($id['repassword'],$rstr)==true){
//              echo $this->error('请不要输入空格');
//          }
          if(trim($id['user_password'])==''){
              echo $this->error('请输入密码');
          }
          if(trim($id['user_password'])<>trim($id['repassword'])){
              echo $this->error('密码和确认密码不一致');
          }
          $res = $admin->save(['user_password'=>$id['user_password']],['id'=>$id['id']]);
          if($res){
              echo $this->success('修改成功');
          }
       }else{
           $info = $admin::get($id['id']);
               $res= $admin->allowField(true)->save($id,['id'=>$info['id']]);
           if($res){
               return json(['code'=>1,'message'=>'修改成功']);
           }else{
               return json(['code'=>2,'message'=>'修改失败']);
           }
       }


    }
    /**
     *
     * localhost本地上传头像，本地预览，上传后删除上次上传的头像
     *
     **/
    public function imgadds()
    {
        $file = request()->file('image');
        if ($file) {
            if(Session::get('delimg.lastimgname')&&Session::get('delimg.imgdate')){
                //session中有 就删除上次头像
                unlink( Env::get('ROOT_PATH')  .'public\\'.'static\\' .'adminheadimgs\\'. Session::get('delimg.imgdate'). '\\'  .Session::get('delimg.lastimgname'). ".jpg");
                //删除头像后，清除session
                Session::delete('delimg.lastimgname');Session::delete('delimg.imgdate');
            }
            $ipt = input('hidid');
            $type = input("file_type");
            $name = date("Ymd") . rand(1000, 9999);
            $info = $file->move("public/static/".'adminheadimgs/' . date("Ymd") . "/", $name);
            if ($info) {
                $file = $info->getSaveName();
                $sqlurl = "/tp51t/public/static/" . 'adminheadimgs/' . date("Ymd") . "/";
                $files = $sqlurl . $file;
                $infos = Admin::get($ipt);
                $admin = new Admin;
                $res = $admin->save([
                    'head_img'=>$files
                ],['id'=>$infos['id']]);
                //上传头像后存到session里边
                Session::set('delimg.lastimgname',$name);
                Session::set('delimg.imgdate',date('Ymd'));
                if($res){
                    $infos1 = Admin::get($ipt);
                    Session::set('info',$infos1);
                    echo $this->success('图片上传成功','admininfo',$files);
                }
            } else {
                echo $this->error(2, "admininfo");
                exit;
            }
        }else{
            echo '失败';
        }
    }
}
