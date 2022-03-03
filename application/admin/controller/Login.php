<?php
namespace app\admin\controller;
use PHPMailer\PHPMailer\PHPMailer;
use app\admin\controller\Common;
use think\facade\Cache;
use think\facade\Hook;
use think\facade\Request;
use app\admin\model\Admin;
use think\facade\Session;
use Firebase\JWT\JWT;
use think\captcha\Captcha;
use think\model\concern\TimeStamp;

class Login extends Common
{

    protected $param;
    protected $request;
    public function setemail()
    {
//        if (Request::isPost()){
        $mail = new PHPMailer();
        // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
        $mail->SMTPDebug = 1;
        $toemail = '1337039891@qq.com';//收件人
        $mail->isSMTP();// 使用SMTP服务
        $mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
        $mail->Host = "smtp.163.com";// 发送方的SMTP服务器地址
        $mail->SMTPAuth = true;// 是否使用身份验证
        $mail->Username = "lc1114123@163.com";/// 发送方的163邮箱用户名，就是你申请163的SMTP服务使用的163邮箱
        $mail->Password = "YXAYPSKUGXVXVASH";// 发送方的邮箱密码，注意用163邮箱这里填写的是“客户端授权密码”而不是邮箱的登录密码！
        $mail->SMTPSecure = "ssl";// 使用ssl协议方式
        $mail->Port = 465;// 163邮箱的ssl协议方式端口号是465/994

        $mail->setFrom("lc1114123@163.com","Tester");// 设置发件人信息，如邮件格式说明中的发件人，这里会显示为Mailer(xxxx@163.com），Mailer是当做名字显示
        $mail->addAddress($toemail,'Liu');// 设置收件人信息，如邮件格式说明中的收件人，这里会显示为Liang(yyyy@163.com)
        $mail->addReplyTo("lc1114123@163.com","Reply");// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
        //$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
        //$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
        //$mail->addAttachment("bug0.jpg");// 添加附件

        $mail->Subject = "来自聪仔的垃圾邮件：";// 邮件标题


        $num = rand(100000,999999);

        $mail->Body = "欢迎登陆，您的验证码为".$num;// 邮件正文
        //$mail->AltBody = "This is the plain text纯文本";// 这个是设置纯文本方式显示的正文内容，如果不支持Html方式，就会用到这个，基本无用
//        $this->Requestinfo('r');

        if($mail->send()){// 发送邮件
            // echo "Message could not be sent.";
            // echo "Mailer Error: ".$mail->ErrorInfo;// 输出错误信息
            Session::set('emailnum',$num);
//            return json(['code'=>1,'message'=>'邮件已发送，请注意查看邮箱']);
            echo $this->returnres(1,'邮件已发送，请注意查看邮箱');
           # return json(['code'=>2,'message'=>'发送失败']);
        }else{
            echo $this->returnres(2,$mail->ErrorInfo);
//            return json(['code'=>2,'message'=>$mail->ErrorInfo]);
        }
//        }
    }

    public function reg(){
        if(Request::isGet()){
            return $this->fetch();
        }else{
            $data = Request::param();
            if($data){
                $admin = new Admin;
                $res = $admin::create($data);
                if($res){
                    echo $this->returnres(1,'ok');
                }else{
                    echo $this->returnres(2,'no');
                }
            }
        }
    }

    public function login($key='',$exp_time = 0,$scopes=''){
        Hook::add("run","app\\admin\\behavior\\Hooks");
        $captcha = new Captcha();
        if (Request::isGet()){
            $key = 'TokenKey';
            $time = time(); //当前时间
            $a['btw'] = $time;
//            dump($a);die;
            $token['iss'] = 'Jouzeyu'; //签发者 可选
            $token['uid'] = 'id'; //接收该JWT的一方，可选
            $token['iat'] = $time; //签发时间
            $token['nbf'] = $time+3; //生效时间
            if (!$exp_time) {
                $exp_time = 30;//默认=2小时过期
            }
            $token['exp'] = $time + $exp_time; //token过期时间,这里设置2个小时

            $jwt = JWT::encode($token, $key);

//            $capt = $captcha->entry();
            return $this->fetch('',['data'=>$jwt]);
            //           return json(['code'=>1,'data'=>$jwt]);

        }else{
            $emailnum = Session::get('emailnum');
            $data = Request::param();
//            if(!$captcha->check($data['captcha'])){
//                echo $this->returnres(2,'图片验证码错误');
//                exit;
//            }
//            dump($data);die;
            if($data){
                $admin = new Admin;
                $res = $admin->where('user_phone',$data['user_phone'])->where('user_password',$data['user_password'])->find();

                if($res){
                    Session::delete('emailnum');
                    $last_time =date('Y-m-d H:i:s',$res['last_time']);
                    Session::set('last_time',$last_time);
                    $admin->save([
                        'token'=>$data['token'],
                        'last_time'=>time()
                    ],['id'=>$res['id']]);
                    Session::delete('info');
//                    Cache::set('info',$res);
                    $res1 = $admin->where('id',$res['id'])->find();
                    $timer = date('Y-m-d H:i:s',time());
                    Session::set('info',$res1);
                    Session::set('now',$timer);
                    $params = 'hello';
//                    $r = Hook::listen('login',$params);   //params1 是一个引入传值类型的参数，param2不是引用类型的参数

    //                    if($r){
                            echo $this->returnres(1,'登陆成功1',$res);
    //                    }else{
    //
    //                        die;
    //                    }
                }else{
                    echo $this->returnres(2,'登陆失败2');
                }
            }else{
                echo $this->returnres(22,'userinfo not found');
            }

        }
    }

    function JWTEncode($key='',$exp_time = 0,$scopes='')
    {
        $key = 'TokenKey';
        $time = time(); //当前时间
        $token['iss'] = 'Jouzeyu'; //签发者 可选
        $token['uid'] = ''; //接收该JWT的一方，可选
        $token['iat'] = $time; //签发时间
        $token['nbf'] = $time+3; //生效时间
        if (!$exp_time) {
            $exp_time = 30;//默认=2小时过期
        }
        $token['exp'] = $time + $exp_time; //token过期时间,这里设置2个小时
        $jwt = JWT::encode($token, $key);
        return $jwt;
        exit;
    }

    #生成token
    public function createtoken($data = "", $exp_time = 0,$scopes=''){
        $key = 'TokenKey';
        $time = time(); //当前时间
        $token['iss'] = 'Jouzeyu'; //签发者 可选
        $token['uid'] = ''; //接收该JWT的一方，可选
        $token['iat'] = $time; //签发时间
        $token['nbf'] = $time+3; //生效时间
        if ($scopes) {
            $token['scopes'] = $scopes; //token标识，请求接口的token
        }
        if (!$exp_time) {
            $exp_time = 30;//默认=2小时过期
        }
        $token['exp'] = $time + $exp_time; //token过期时间,这里设置2个小时
        if ($data) {
            $token['data'] = $data; //自定义参数
        }
        $jsons = JWT::encode($token, $key);

          return json(['code'=>1,'message'=>'yes','data'=>$jsons]);
          exit;
//        echo $this->returnres(1,'yes',$jsons);

    }
    public function done(){
        Session::clear();
        return redirect('login/login');
    }
    public function returnres($code='',$msg="",$data=array()){
        return json_encode(array(
            "code"=>$code,
            "msg"=>$msg,
            "data"=>$data
        ));
    }
}