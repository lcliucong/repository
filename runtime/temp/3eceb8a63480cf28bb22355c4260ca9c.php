<?php /*a:1:{s:74:"D:\phpstudy_pro\WWW\tp51t\application\admin\view\indexshow\noticeedit.html";i:1636954968;}*/ ?>
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
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
            <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
            <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]--></head>
    
    <body>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form">
                    <input type='hidden' name='id' value='$li.id'>   <!--本条数据ID-->
                    <input type='hidden' name='type' value='update'>
                    <div class="layui-form-item">
                        <label for="notice_title" class="layui-form-label">
                            <span class="x-red">*</span>标题</label>
                        <div class="layui-input-inline">
                            <input type="text" id="notice_title" value="$li.notice_title" name="notice_title" required=""  autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="notice_content" class="layui-form-label">
                            <span class="x-red">*</span>通知内容</label>
                        <div class="layui-input-block">
                            <textarea name="notice_content" class="layui-textarea">$li.notice_content</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="notice_auth" class="layui-form-label">
                            <span class="x-red"></span>作者</label>
                        <div class="layui-input-inline">
                            <input type="text" id="notice_auth" value="$li.notice_auth" name="notice_auth" required=""  autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="images" class="layui-form-label">
                            <span class="x-red"></span>图片</label>
                        <div class="layui-input-inline">
                            <input type="file" id="images" value="$li.images" name="images" required=""  autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn" lay-filter="add" lay-submit="">确定</button></div>
                </form>
            </div>
        </div>
        <script>layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;
                //监听提交
                form.on('submit(add)',
                function(data) {
                    $.ajax({
                        type: 'post',
                        url: 'artedit',
                        data: data.field,
                        success: function (res) {
                            if(res.code==1){
                                layer.msg(res.msg, {icon: 6,time:1000}, function(){
                                    //关闭当前frame
                                    xadmin.close();
                                    // 可以对父窗口进行刷新
                                    xadmin.father_reload();
                                });
                            } else {
                                layer.msg(res.msg, {icon: 5, time: 1000});
                            }
                        },
                    });
                    return false;
                });

                });
            </script>
    </body>
</html>