<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Article;
use think\Loader;
use think\Request;
class Indexshow extends Controller
{
    #####查询
    public function indexshow(Request $request){
        $article = new Article;
        if($request->isGet()){
            $list = $article->field('*')->paginate(5);
            return $this->fetch('showlist',['data'=>$list,'list'=>$list]);
        }else{
            $data = $request->param();
            $res = $article->where('art_title','like','%'.$data['art_title'].'%')->paginate(20);
            if($res){
                return $this->fetch('showlist',['data'=>$res,'list'=>$res]);
            }else{
                return '暂无数据';
            }
        }
    }

    //多图上传
    public function imgadds(Request $request)
    {
        header("Content-Type:text/html;charset=utf8");
        header("Access-Control-Allow-Origin: *"); //解决跨域
        header('Access-Control-Allow-Methods:POST');// 响应类型
            $file = request()->file('image');
            if ($file) {
                $ipt = input('hidid');
                $type = input("file_type");
                $name = date("Ymd") . rand(1000, 9999);
                $info = $file->move('images/' . date("Ymd") . "/", $name);
                if ($info) {
                    $file = $info->getSaveName();
                    $url = 'http://yst.kuguoyunfu.com/public/' . 'images/' . date("Ymd") . "/";
                    $sqlurl = 'http://yst.kuguoyunfu.com/' . 'images/' . date("Ymd") . "/";
                    $files = $sqlurl . $file;
                    $officialnotice = Officialnotice::get($ipt);
                    $officialnotice->images=$files;
                    $res = $officialnotice->save();
                    if($res){
                        echo $this->success('图片上传成功','indexshow');
                    }
                } else {
                    echo $this->returnres(1, "图片上传失败");
                    exit;
                }
            }
    }
    public function noticeadds(Request $request){
        if($request->isGet()){
            return $this->fetch('noticeadd');
        }else{
            $data = $request->param();
                if (!$data){
                    return $this->returnres(22,'数据获取失败');
                }else{
                    $validate = Loader::validate('Indexshow');
                    if(!$validate->check($data)){
                        $this->error($validate->getError());
                    }else{
                        $officialnotice = new Officialnotice;
                        $res = $officialnotice->data([
                            'notice_title'=>$data['notice_title'],
                            'notice_content'=>$data['notice_content'],
                            'notice_auth'=>$data['notice_auth'],
                        ])->save();
                        if($res){
                            echo $this->success('ok');
                        }else{
                           echo $this->error('no');
                        }
                    }
                }
       }
    }
    public function artedit(Request $request){
            
        if($request->isGet()){
            $id = $request->param();
            $article = Article::get($id);
            return $this->fetch('noticeedit');//,['li'=>$msult]
        }else{
            $data = $request->param();
//            var_dump($data);die;
            if(isset($data['type'])  &&  $data['type']==='update'){
                $article = new Article;
                    $result = $article->save($data,['id'=>$data['id']]);
                    if($result){
                      echo $this->success('修改成功');
                    }else{
                       echo $this->error('修改失败');
                    }

            }else{
                $res = Article::update($data);
                if($res) {
                    echo $this->success('修改成功');
                }else{
                    echo $this->error('修改失败');
                }
            }
        }
    }
    public function artdel(Request $request){
        $id = $request->param();
       // var_dump($id['id']);die;
        $res = Article::destroy($id['id']);
        if($res){
            return json(['code'=>1,'message'=>'删除成功']);
        }else{
            return json(['code'=>2,'message'=>'删除失败']);
        }
    }
    public function returnres($code='',$msg="",$data=array()){
        return json_encode(array(
            "code"=>$code,
            "msg"=>$msg,
            "data"=>$data
        ));
    }

}