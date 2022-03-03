<?php /*a:1:{s:65:"D:\phpstudy_pro\WWW\tp51t\application\admin\view\login\login.html";i:1635738851;}*/ ?>
<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>后台登录</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="\tp51t\public/static/admin/css/font.css">
    <link rel="stylesheet" href="\tp51t\public/static/admin/css/login.css">
	<link rel="stylesheet" href="\tp51t\public/static/admin/css/xadmin.css">
    <link rel="stylesheet" href="\tp51t\public/static/admin/css/style.css">
    <script src="\tp51t\public/static/admin/js/xadmin.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="\tp51t\public/static/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script src="\tp51t\public/static/admin/js/vector.js"></script>
    <srript src="\tp51t\public/static/admin/js/"></srript>
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-bg">
<div id="container">
    <div id="output">
        <div class="containerT">
            <div style="display: inline ;position: relative;bottom: 10px;">
                <p style="position:relative;top: 59px;left: 12px;font-size: 25px;color: white;cursor: default"></p>
                <p style="position:relative;top: 63px;left: 6px;font-size: 10px;color: white;cursor: default"></p>

            </div>
            <form class="layui-form" method="post">
                <input type="hidden" value="<?php echo htmlentities($data); ?>" name="token" id="hidtok">
                <input style="width: 300px;margin-top: 20px;" type="text" placeholder="用户名" id="user_phone" name="user_phone" placeholder="用户名"  type="text" lay-verify="required">
                <input style="width: 300px;" type="password" placeholder="密码" id="user_password" name="user_password"   lay-verify="required">
<!--                <div class="capt"><img src="<?php echo captcha_src(); ?>" alt="这是个验证码"  /></div>-->
                <hr class="hr15">
<!--                <input name="captcha" style="width: 300px" type="text" placeholder="请输入上发图片中的验证码" lay-verify="required">-->
<!--                <input name="mail" placeholder="邮件验证码"  type="text" lay-verify="required" class="layui-input" >-->
<!--                <hr class="hr15">-->
<!--                <input value="发送邮件验证码" lay-submit lay-filter="mail" onclick="sendemail()" id="emailbtn" style="width:100%;" type="button">-->
                <hr class="hr20" >
                <input value="登录" lay-submit lay-filter="login" style="width:332px;" type="submit">
                <hr class="hr20" >
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        Victor("container", "output");   //登陆背景函数
        $("#entry_name").focus();

    });
</script>
    <script>
        $(function  () {
            layui.use(['form', 'layer'],
                function(){
                    $ = layui.jquery;
                    var form = layui.form,
                    layer = layui.layer;
                form.on('submit(login)', function(data){
                    // console.log(data);
                    $.ajax({
                        type:'post',
                        url:'login',
                        data:data.field,
                        dataType:"json",
                        success:function(ress){
                            if(ress.code==1){
                                layer.msg(ress.msg,{icon:6,time:1000},function(){
                                  location.href='<?php echo url("admin/index"); ?>';
                                })
                            }else{
                                layer.msg(ress.msg,{icon:5,time:2000},function(){
                                    xadmin.father_reload();
                                })
                            }
                        },
                        error:function(){
                            layer.msg(ress.msg,{icon:5,time:2000},function(){
                                xadmin.father_reload();
                            })
                        }
                    })
                    return false;
                });

                $('#emailbtn').click(
                    function(){
                        $.ajax({
                            type:'post',
                            url:'setemail',
                            success:function(res){
                                if(res.code==1){
                                    layer.msg(res.msg,{icon:6,time:1000})
                                }else{
                                    layer.msg(res.msg,{icon:5,time:1000},function(){
                                        // xadmin.father_reload();
                                    })
                                }
                            },
                        })
                        return false;
                    }
                )
            });

        })
    </script>

<!--    <script>-->
<!--        function beforetok(){-->
<!--            $.ajax({-->
<!--                type:'get',-->
<!--                url:'login',-->
<!--                success:function (res){-->
<!--                    console.log(res.data);-->
<!--                }-->
<!--            })-->
<!--        }-->
<!--        $(document).ready(function(){-->
<!--            beforetok();-->
<!--        })-->


<!--    </script>-->
    <!-- 底部结束 -->
</body>
<script>
    var countdown=20;
    function sendemail(){
        var obj = $("#emailbtn");
        settime(obj);

    }
    function settime(obj) { //发送验证码倒计时
        if (countdown == 0) {
            $('#emailbtn').css({'background':'rgb(24, 159, 146)'})
            obj.attr('disabled',false);
            //obj.removeattr("disabled");
            obj.val("获取验证码");
            countdown = 20;
            return;
        } else {
            $('#emailbtn').attr("disabled","disabled");
            $('#emailbtn').css({'background':'#c2c2c2','font-color':'black'})
            obj.val("重新发送(" + countdown + ")");
            countdown--;
        }
        setTimeout(function() {
                settime(obj) }
            ,1000)
    }
</script>
</html>