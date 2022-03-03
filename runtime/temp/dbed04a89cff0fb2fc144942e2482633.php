<?php /*a:2:{s:72:"D:\phpstudy_pro\WWW\tp51t\application\admin\view\indexshow\showlist.html";i:1630468051;s:67:"D:\phpstudy_pro\WWW\tp51t\application\admin\view\public\header.html";i:1630630735;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>测试5.1</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="\tp51t\public/static/admin/css/font.css">
    <link rel="stylesheet" href="\tp51t\public/static/admin/css/xadmin.css">
    <link rel="stylesheet" href="\tp51t\public/static/admin/css/theme5.css">
    <script src="\tp51t\public/static/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="\tp51t\public/static/admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        // 是否开启刷新记忆tab功能
        // var is_remember = false;
    </script>
</head>

    <body>
        <div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">演示</a>
            <a>
              <cite>导航元素</cite></a>
          </span>
          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5" action='indexshow' method='post'>
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="开始日" name="start" id="start">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="截止日" name="end" id="end">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="art_title" id='art_title' for='sreach' required placeholder="标题" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input type='submit' class="layui-btn" id='sreach' value='搜索' name='sreach' lay-submit="" lay-filter="sreach"></input>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-header">
                            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
                            <button class="layui-btn" id="btnid" onclick="xadmin.open('添加通知','noticeadds',1000,800)"><i class="layui-icon"></i>添加</button>
                        </div>
                        <div class="layui-card-body layui-table-body layui-table-main">
                            <table class="layui-table layui-form">
                                <thead>
                                  <tr>
                                    <th>
                                      <input type="checkbox" lay-filter="checkall" name="id" lay-skin="primary">
                                    </th>
                                    <th>ID</th>
                                    <th>标题</th>
                                    <th>内容</th>
                                    <th>作者</th>
                                    <th>图片</th>
                                    <th>时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "<h1>sorry~暂时没有数据</h1>" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                  <tr>
                                    <td>
                                     <input type="checkbox" name="id" value="6" lay-skin="primary">
                                    </td>
                                    <td><?php echo htmlentities($vo['id']); ?></td>
                                    <td><?php echo htmlentities($vo['art_title']); ?></td>
                                    <td><?php echo htmlentities($vo['art_content']); ?></td>
                                    <td><?php echo htmlentities($vo['art_auth']); ?></td>
                                    <td><?php echo htmlentities($vo['art_image']); ?></td>
                                    <td><?php echo htmlentities($vo['create_time']); ?></td>
                                    <td class="td-status">
                                        <?php switch($vo['status']): case "1": ?>
                                       <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
                                        <?php break; case "0": ?>
                                       <span class="layui-btn layui-btn-danger layui-btn-mini">已禁用</span>
                                        <?php break; ?>
                                      <?php endswitch; ?>
                                    <td class="td-manage">
                                      <?php if($vo['status'] == '1'): ?>
                                      <a onclick="member_stop('确定要禁用吗?',this,id='<?php echo htmlentities($vo['id']); ?>',0)" href="javascript:;"  title="禁用">
                                          <i class="layui-icon">&#x1006;</i>
                                      </a>
                                      <?php else: ?>
                                      <a onclick="member_stop('确定要启用吗?',this,id='<?php echo htmlentities($vo['id']); ?>',1)" href="javascript:;"  title="启用">
                                          <i class="layui-icon">&#xe605;</i>
                                      </a>
                                      <?php endif; ?>
                                      <a title="编辑"  onclick="xadmin.open('编辑','artedit?id=<?php echo htmlentities($vo['id']); ?>',600,400)" href="javascript:;">
                                        <i class="layui-icon">&#xe642;</i>
                                      </a>
                                      <a title="删除" onclick='art_del(this,"<?php echo htmlentities($vo['id']); ?>")' href="javascript:;">
                                        <i class="layui-icon">&#xe640;</i>
                                      </a>
                                      <form action="imgadds" enctype="multipart/form-data" method="post">
                                          <input type="file" name="image" /> <br>
                                          <input type="hidden" value="id" name="hidid">
                                          <input type="submit" value="上传" />
                                      </form>
                                  </td>
                                  </tr>
                                <?php endforeach; endif; else: echo "<h1>sorry~暂时没有数据</h1>" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page">
                                <div>
                                    <?php echo $list; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
    <script>
      layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        var  form = layui.form;
        // 监听全选
        form.on('checkbox(checkall)', function(data){

          if(data.elem.checked){
            $('tbody input').prop('checked',true);
          }else{
            $('tbody input').prop('checked',false);
          }
          form.render('checkbox');
        }); 
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });


      });
       /*用户-停用*/
          function member_stop(msg,obj,id,status){
              layer.confirm(msg,function(index){
                  $.ajax({
                      type:'post',
                      url:'artedit',
                      data:{
                          id:id,
                          status:status,
                      },
                      success:function(res){
                          if(res.code==1){
                              if(status==0){
                                  //添加操作按钮
                                  $(obj).parents('td').prepend('<a onclick="member_stop(\'确定要启用吗?\',this,id,1)" href="javascript:;"  title="启用"><i class="layui-icon">&#xe605;</i></a>');
                                  //修改状态按钮
                                  $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-normal').addClass('layui-btn-danger').html('已禁用');
                              }else{
                                  //添加操作按钮
                                  $(obj).parents('td').prepend('<a onclick="member_stop(\'确定要禁用吗?\',this,id,0)" href="javascript:;"  title="禁用"><i class="layui-icon">&#x1006;</i></a>');
                                  //修改状态按钮
                                  $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-danger').addClass('layui-btn-normal').html('已启用');
                              }
                              layer.msg('修改成功',{icon:6,time:1000});
                          }
                          $(obj).remove();
                      }
                  })
              })
          }
      function srea(obj){
          layui.use('form', function(){
              var form = layui.form;
              form.on('submit(sreach)', function(data){
                  console.log(data);
                  $.ajax({
                      type:'post',
                      url:'indexshow',
                      data:data.field,
                      success:function(res){
                          if(res.code==2){
                              layer.alert('抱歉,您搜索的数据不存在',{icon:5,time:1000});
                          }
                      },

                  })
              });
          });
      }

      /*用户-删除*/
      function art_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              $.ajax({
                  type:'post',
                  url:'artdel',
                  data:{
                      id:id
                  },
                  success:function(res){
                      if(res.code==1){
                          layer.msg(res.message,{icon:6,time:1000},function(){
                              $(obj).parents('tr').remove();
                          })
                      }else{
                          layer.msg(res.message,{icon:5,time:1000});
                      }

                  }
              })
          });
      }



      function delAll (argument) {
        var ids = [];
        // 获取选中的id
          $('input:checkbox:checked').parent().next().each(function(idx,element){
              ids.push($(element).text());
          });

        // $('tbody input').each(function(index, el) {
        //     if($(this).prop('checked')){
        //        ids.push(el.text)
        //     }
        // });
          ids.shift();
        layer.confirm('确认要删除吗？'+ids.toString(),function(index){
            //捉到所有被选中的，发异步进行删除
            $.ajax({
                type:'post',
                url:'artdel',
                data: {
                    id:ids
                },
                success:function (res){
                    if(res.code==1){
                        console.log(res.code)
                    }

                }
            })
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
</html>