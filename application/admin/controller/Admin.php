<?php
namespace app\admin\controller;
use app\common\Basic;
use app\common\Returnres;
use app\admin\model\Admin as Admins;
use think\facade\Env;
use think\facade\Cache;
use think\facade\Session;
use think\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use think\facade\Request;

class Admin extends Basic
{
     public function delete_dir_file($dir_name) {
        $result = false;
        if(is_dir($dir_name)){
            if ($handle = opendir($dir_name)) {
                while (false !== ($item = readdir($handle))) {
                    if ($item != '.' && $item != '..') {
                        if (is_dir($dir_name . '\/' . $item)) {
                        $this->  delete_dir_file($dir_name . '\/' . $item);
                        } else {
                            unlink($dir_name . '\/' . $item);
                        }
                    }
                }
                closedir($handle);
                if (rmdir($dir_name)) {
                    $result = true;
                }
            }
        }
        var_dump();
        return $result;
     }

    public function clearcha(){
         $cachepath = Env::get('runtime_path');
         $s = Env::get('route_path');
//        $data = Cache::get('info');
//        var_dump($data);die;
        if ($this->delete_dir_file($cachepath) || $this->delete_dir_file($cachepath)) {
            $this->success('清除缓存成功');
        } else {
            $this->error('清除缓存失败');
        }
    }
    public function index()
    {
        $data = Session::get('info');
        $admins = new Admins;
        $datas = $admins->where('id',$data['id'])->find();
        return $this->fetch('',['data'=>$datas]);
    }
    public function welcome(){
        return $this->fetch('test');
    }
    public function welcome1(){
        return $this->fetch('welcome1');
    }
/**
     * tp5邮件
     * @param
     * @author
     * @return
     */
    public function setemail()
    {
        $mail = new PHPMailer();
        // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
        $mail->SMTPDebug = 1;
        $toemail = '1114123000@qq.com';//收件人
        $mail->isSMTP();// 使用SMTP服务
        $mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
        $mail->Host = "smtp.163.com";// 发送方的SMTP服务器地址
        $mail->SMTPAuth = true;// 是否使用身份验证
        $mail->Username = "lc1114123@163.com";/// 发送方的163邮箱用户名，就是你申请163的SMTP服务使用的163邮箱
        $mail->Password = "YXAYPSKUGXVXVASH";// 发送方的邮箱密码，注意用163邮箱这里填写的是“客户端授权密码”而不是邮箱的登录密码！
        $mail->SMTPSecure = "ssl";// 使用ssl协议方式
        $mail->Port = 465;// 163邮箱的ssl协议方式端口号是465/994

        $mail->setFrom("lc1114123@163.com","Mailer");// 设置发件人信息，如邮件格式说明中的发件人，这里会显示为Mailer(xxxx@163.com），Mailer是当做名字显示
        $mail->addAddress($toemail,'Liu');// 设置收件人信息，如邮件格式说明中的收件人，这里会显示为Liang(yyyy@163.com)
        $mail->addReplyTo("lc1114123@163.com","Reply");// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
        //$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
        //$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
        //$mail->addAttachment("bug0.jpg");// 添加附件

        $mail->Subject = "测试验证码：";// 邮件标题

        $num = rand(100000,999999);

        $mail->Body = "欢迎注册，您的验证码为".$num;// 邮件正文
        //$mail->AltBody = "This is the plain text纯文本";// 这个是设置纯文本方式显示的正文内容，如果不支持Html方式，就会用到这个，基本无用
        if(!$mail->send()){// 发送邮件
            // echo "Message could not be sent.";
            // echo "Mailer Error: ".$mail->ErrorInfo;// 输出错误信息
            echo 2;
        }else{
            echo 1;  //成功
        }
    }



    //前置方法
//    protected $beforeActionList = [
//        'valid_token', //valid_token方法不执行前置操作
//    ];

    //验证token
    protected function valid_token(){
        // request()->isAjax() or die('非法请求');

        $token = request()->param('token');

        if(empty($token)) {
            $this->error('token done');
            die;
        }

     //   $stu = Admin::name('admin')->where('token',$token)->find();

        if(empty($stu))  {
            $this->returnres(1,'token done');
            die;
        }

        if(time()>$stu['exp']){
            //token过期
            $this->error('token done');
            die;
        }

    }
}
