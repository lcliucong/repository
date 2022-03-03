<?php /*a:1:{s:73:"D:\phpstudy_pro\WWW\tp51t\application\admin\view\admininfo\admininfo.html";i:1630742094;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-X-admin2.2</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="stylesheet" href="\tp51t\public/static/admin/css/font.css">
        <link rel="stylesheet" href="\tp51t\public/static/admin/css/xadmin.css">
        <script type="text/javascript" src="\tp51t\public/static/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="\tp51t\public/static/admin/js/xadmin.js"></script>
        <link rel="stylesheet" href="\tp51t\public/static/admin/lib/layui/css/layui.css"  media="all">
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
            <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
            <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>


    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">基本资料</li>
            <li>头像</li>
            <li>密码</li>
            <li>订单管理</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form class="layui-form">
                    <input type="hidden" name="id" value="<?php echo htmlentities(app('session')->get('info.id')); ?>">
                <div class="layui-form-item">
                    <label for="user_name" class="layui-form-label">
                        <span class="x-red"></span>昵称
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="user_name" name="user_name" required="" lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo htmlentities(app('session')->get('info.user_name')); ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="user_phone" class="layui-form-label">
                        <span class="x-red"></span>手机号
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="user_phone" name="user_phone" value="<?php echo htmlentities(app('session')->get('info.user_phone')); ?>" lay-verify="phone" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="email" class="layui-form-label">
                        <span class="x-red"></span>邮箱
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="email" name="email" value="<?php echo htmlentities(app('session')->get('info.email')); ?>" lay-verify="email" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">

                            <input type="radio" name="sex" value="<?php echo htmlentities(app('session')->get('info.sex')); ?>" checked title="男" >
                            <input type="radio" name="sex" value="<?php echo htmlentities(app('session')->get('info.sex')); ?>" checked  title="女" >
                            <input type="radio" name="sex" value="<?php echo htmlentities(app('session')->get('info.sex')); ?>" checked title="其他">

                    </div>
                </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            上次登录时间：<span><?php echo htmlentities(app('session')->get('last_time')); ?></span>
                            <br>
                            本次登录时间：<span><?php echo htmlentities(app('session')->get('now')); ?></span>
                        </div>
                    </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" lay-filter="add" lay-submit="">
                        修改
                    </button>
                </div>
                </form>
            </div>
            <div class="layui-tab-item">
                <img class="layui-upload-img" id="demo1" style="height: 150px;width: 150px;" src="<?php echo htmlentities(app('session')->get('info.head_img')); ?>">
                <form id="form1">
                    <label for="exampleInputEmail1">↑您的头像</label>
                    <br>
                    <input type="button" value="上传图片" onclick="image.click()" class="btn_mouseout"/><br>
                    <input type="hidden" value="<?php echo htmlentities(app('session')->get('info.id')); ?>" name="hidid">
                    <p><input type="file" id="image" name="image" onchange="sc(this);" style="display:none"/></p>
                </form>
            </div>
            <div class="layui-tab-item">
                <form class="layui-form">
                    <input type="hidden" value="<?php echo htmlentities(app('session')->get('info.id')); ?>" name="id">
                <div class="layui-form-item">
                    <label for="user_nowpassword" class="layui-form-label">
                        <span class="x-red"></span>当前密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="user_nowpassword" name="user_nowpassword" value="<?php echo htmlentities(app('session')->get('info.user_password')); ?>" lay-verify="pass" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="user_password" class="layui-form-label">
                        <span class="x-red"></span>新密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="user_password" name="user_password"  lay-verify="pass"
                               autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        6到16个字符
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="repassword" class="layui-form-label">
                        <span class="x-red"></span>确认密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="repassword" name="repassword"  lay-verify="repass" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" lay-filter="add" lay-submit="">
                        确定
                    </button>
                </div>
                </form>
            </div>

            <div class="layui-tab-item">内容4</div>
        </div>
    </div>

    </body>
    <script src="\tp51t\public/static/admin/js/jquery.min.js"></script>
        <script>layui.use(['form', 'layer','element'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;
                var element = layui.element;

                //监听提交
                form.on('submit(add)',
                function(data) {
                    // 发异步，把数据提交给php
                    $.ajax({
                        type: 'post',
                        url: 'infoedit',
                        data: data.field,
                        success: function (res) {
                            if (res.code == 1) {
                                layer.msg(res.msg, {icon: 6, time: 1000}, function () {
                                    //关闭当前frame
                                    xadmin.close();
                                    // 可以对父窗口进行刷新
                                    xadmin.father_reload();
                                });
                            } else {
                                layer.msg(res.msg, {icon: 5, time: 1000}, function () {
                                    //关闭当前frame
                                    // 可以对父窗口进行刷新
                                });
                            }

                        }
                    });
                    return false;
                })

            });</script>


    <script>
            function sc(){
            var animateimg = $("#image").val(); //获取上传的图片名 带//
            var imgarr=animateimg.split('\\'); //分割
            var myimg=imgarr[imgarr.length-1]; //去掉 // 获取图片名
            var houzui = myimg.lastIndexOf('.'); //获取 . 出现的位置
            var ext = myimg.substring(houzui, myimg.length).toUpperCase(); //切割 . 获取文件后缀
            var file = $('#image').get(0).files[0]; //获取上传的文件
            var fileSize = file.size;      //获取上传的文件大小
            var maxSize = 11048576;       //最大1MB
            if(ext !='.PNG' && ext !='.GIF' && ext !='.JPG' && ext !='.JPEG' && ext !='.BMP'){
            parent.layer.msg('文件类型错误,请上传图片类型');
            return false;
        }else if(parseInt(fileSize) >= parseInt(maxSize)){
            parent.layer.msg('上传的文件不能超过1MB');
            return false;
        }else{
            var data = new FormData($('#form1')[0]);
            $.ajax({
            url: "imgadds",
            type: 'POST',
            data: data,
            dataType: 'JSON',
            cache: false,
            processData: false,
            contentType: false,
            success:function(res){
                $('#demo1').attr('src',res.data);
                layer.msg('修改成功!');
                //修改img路径
            }
        })
            return false;
        }
        }

    </script>
</html>
