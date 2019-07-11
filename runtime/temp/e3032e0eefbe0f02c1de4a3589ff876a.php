<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"/opt/lampp/htdocs/application/index/view/dianka/index.html";i:1547799220;s:52:"/opt/lampp/htdocs/application/index/view/layout.html";i:1558683364;}*/ ?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>代理管理</title>
    <meta name="description" content="完美网服 旺旺：raven_718">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--<link rel="icon" type="image/png" href="/public/static/amz/i/favicon.png">-->
    <!--<link rel="apple-touch-icon-precomposed" href="/public/static/amz/i/app-icon72x72@2x.png">-->
    <!--<meta name="apple-mobile-web-app-title" content="Amaze UI"/>-->
    <link rel="stylesheet" href="/public/static/amz/css/amazeui.min.css"/>
    <link rel="stylesheet" href="/public/static/amz/css/admin.css">
    <link rel="stylesheet" href="/public/static/amz/css/app.css">
    <!--<script src="/public/static/amz/js/echarts.min.js"></script>-->

    <!--old  下-->

    <!--<link rel="stylesheet" href="/public/static/assets/css/fonts/linecons/css/linecons.css">-->

    <link rel="stylesheet" href="/public/static/assets/css/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/static/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/public/static/assets/css/xenon-core.css">
    <!--<link rel="stylesheet" href="/public/static/assets/css/xenon-forms.css">-->
    <!--<link rel="stylesheet" href="/public/static/assets/css/xenon-components.css">-->
    <!--<link rel="stylesheet" href="/public/static/assets/css/xenon-skins.css">-->
    <!--<link rel="stylesheet" href="/public/static/assets/css/custom.css">-->

    <script src="/public/static/assets/js/jquery-1.11.1.min.js"></script>


    <!--old  上-->


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->


    <!--<link rel="stylesheet" href="/public/static/assets/css/fonts/elusive/css/elusive.css">-->

</head>

<body data-type="index">


<header class="am-topbar am-topbar-inverse admin-header">
    <div class="am-topbar-brand">
        <?php if(session('power')=='0'){?>
        <a href="javascript:;" class="tpl-logo">
            <img src="/public/static/amz/img/logo.png" alt="">
        </a>
        <?php } ?>


    </div>
    <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">

    </div>


    <?php if(session('power')=='1'){?>
    <div class="am-fl am-margin-right" style=" margin-left: 20px; ">

        <div class="am-dropdown-toggle tpl-header-list-link">
            <span class="am-icon-bell-o"></span> <?php echo yue(); ?>元
        </div>
    </div>
    <div class="am-fl am-margin-right" style=" margin-left: 20px; ">
        <button class="btn btn-gray" onclick="daili_money('0',<?php echo id(); ?>)">代理充值</button>
    </div>


    <?php } ?>
    <!--
          <?php echo share(); ?>
            <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>
    -->

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">

            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="am-badge tpl-badge-danger am-round"><?php echo power(); ?></span>
                </a>


            </li>


            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="tpl-header-list-user-nick"><?php echo name(); ?></span><span class="tpl-header-list-user-ico"> <img
                        src="/public/static/amz/img/user.png"></span>
                </a>

            </li>
            <li><a href="<?php echo url('login/login/dologin'); ?>" class="tpl-header-list-link"><span
                    class="am-icon-sign-out tpl-header-list-ico-out-size"></span></a></li>
        </ul>
    </div>
</header>


<div class="tpl-page-container tpl-page-header-fixed">


    <div class="tpl-left-nav tpl-left-nav-hover">
        <div class="tpl-left-nav-title">
            菜单列表
        </div>
        <div class="tpl-left-nav-list">
            <ul class="tpl-left-nav-menu">
                <li class="tpl-left-nav-item">
                    <a href="<?php echo url('/index/index/index'); ?>" class="nav-link active">
                        <i class="am-icon-home"></i>
                        <span>管理中心</span>
                    </a>
                </li>


                <!--
                  <li class="tpl-left-nav-item">
                      <a href="<?php echo url('user/daoqi'); ?>" class="nav-link active">
                          <i class="am-icon-home"></i>
                          <span>即将到期</span>
                      </a>
                  </li>
                -->


                <li class="tpl-left-nav-item">
                    <a href="<?php echo url('admin/appconfig'); ?>" class="nav-link active">
                        <i class="am-icon-home"></i>
                        <span>APP设置</span>
                    </a>
                </li>


                <?php if(session('power')=='0'){?>

                <li class="tpl-left-nav-item">
                    <a href="<?php echo url('admin/sysconfig'); ?>" class="nav-link active">
                        <i class="am-icon-home"></i>
                        <span>系统设置</span>
                    </a>
                </li>


                <li class="tpl-left-nav-item">
                    <a href="<?php echo url('admin/index'); ?>" class="nav-link active">
                        <i class="am-icon-home"></i>
                        <span>管&nbsp;&nbsp;理&nbsp;&nbsp;员</span>
                    </a>
                </li>


                <?php }?>


                <li class="tpl-left-nav-item">
                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-wpforms"></i>
                        <span>激活码管理</span>
                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                    </a>
                    <ul class="tpl-left-nav-sub-menu" style="display: block;">
                        <li>
                            <a href="<?php echo url('dianka/index'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>激活码生成</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>


                            <a href="<?php echo url('dianka/ylog'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>有效激活码</span>
                            </a>


                            <a href="<?php echo url('dianka/slog'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>激活码使用记录</span>
                            </a>

                        </li>
                    </ul>
                </li>


                <!--<?php if(session('power')=='0'){?>-->

                <li class="tpl-left-nav-item">
                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-table"></i>
                        <span>广告管理</span>
                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                    </a>
                    <ul class="tpl-left-nav-sub-menu">
                        <li>
                            <a href="<?php echo url('/index/banner/index/id/1'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>APP首页轮播图</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>

                            <a href="<?php echo url('/index/banner/index/id/2'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>APP首页观影区</span>
                                <i class="tpl-left-nav-content tpl-badge-success"> 18 </i>
                            </a>
                            <a href="<?php echo url('/index/banner/index/id/12'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>APP首页文字广告</span>
                                <i class="tpl-left-nav-content tpl-badge-primary">5 </i>
                            </a>

                            <a href="<?php echo url('/index/banner/index/id/3'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>APP首页底部大图</span>

                            </a>

                            <a href="<?php echo url('/index/banner/index/id/4'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>APP首页底部图标</span>
                                <i class="tpl-left-nav-content tpl-badge-primary">5 </i>
                            </a>

                            <a href="<?php echo url('/index/banner/index/id/8'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>APP首页右上角图标</span>

                            </a>


                            <a href="<?php echo url('/index/banner/index/id/5'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>福利页轮播图</span>

                            </a>


                            <a href="<?php echo url('/index/banner/index/id/6'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>福利页小图标</span>

                            </a>


                            <a href="<?php echo url('/index/banner/index/id/7'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>福利页底部广告图</span>

                            </a>


                        </li>
                    </ul>
                </li>


                <li class="tpl-left-nav-item">
                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-table"></i>
                        <span>电影/直播管理</span>
                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                    </a>
                    <ul class="tpl-left-nav-sub-menu">
                        <li>
                            <a href="<?php echo url('video/index'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>电影推荐</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>


                            <a href="<?php echo url('mn/index'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>美女视频</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>


                            <a href="<?php echo url('tv/index'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>电视直播</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>


                            <!--               <a href="<?php echo url('zhibo/index'); ?>">
                             <i class="am-icon-angle-right"></i>
                             <span>游戏直播（推荐）</span>
                             <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                         </a>
-->


                        </li>
                    </ul>
                </li>

                <!--<?php } ?>-->


                <li class="tpl-left-nav-item">
                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-table"></i>
                        <span>用户管理</span>
                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                    </a>
                    <ul class="tpl-left-nav-sub-menu">
                        <li>


                            <a href="<?php echo url('vip/index'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>用户管理</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>

                            <a href=" <?php echo url('user/index'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>代理管理</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>


                            <a href="<?php echo url('user/clog'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>充值记录</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>
                            <a href="<?php echo url('user/xlog'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>开通记录</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>

                            <?php if(session('power')=='0'){?>


                            <a href="<?php echo url('user/mlog'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>代理记录</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>


                            <a href="<?php echo url('user/daoqi'); ?>">
                                <i class="am-icon-angle-right"></i>
                                <span>即将到期</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>


                            <?php } ?>


                        </li>
                    </ul>
                </li>


                <!--



                <li class="tpl-left-nav-item">
                    <a href="chart.html" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-bar-chart"></i>
                        <span>数据表</span>
                        <i class="tpl-left-nav-content tpl-badge-danger">
           12
         </i>
                    </a>
                </li>

                <li class="tpl-left-nav-item">
                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-table"></i>
                        <span>表格</span>
                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                    </a>
                    <ul class="tpl-left-nav-sub-menu">
                        <li>
                            <a href="table-font-list.html">
                                <i class="am-icon-angle-right"></i>
                                <span>文字表格</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>

                            <a href="table-images-list.html">
                                <i class="am-icon-angle-right"></i>
                                <span>图片表格</span>
                                <i class="tpl-left-nav-content tpl-badge-success"> 18  </i>

                                <a href="form-news.html">
                                    <i class="am-icon-angle-right"></i>
                                    <span>消息列表</span>
                                    <i class="tpl-left-nav-content tpl-badge-primary">5 </i>


                                    <a href="form-news-list.html">
                                        <i class="am-icon-angle-right"></i>
                                        <span>文字列表</span>

                                    </a>
                        </li>
                    </ul>
                </li>

                <li class="tpl-left-nav-item">
                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-wpforms"></i>
                        <span>表单</span>
                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                    </a>
                    <ul class="tpl-left-nav-sub-menu" style="display: block;">
                        <li>
                            <a href="form-amazeui.html">
                                <i class="am-icon-angle-right"></i>
                                <span>Amaze UI 表单</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>

                            <a href="form-line.html">
                                <i class="am-icon-angle-right"></i>
                                <span>线条表单</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="tpl-left-nav-item">
                    <a href="login.html" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-key"></i>
                        <span>登录</span>

                    </a>
                </li>

-->


            </ul>
        </div>
    </div>


    <div class="tpl-content-wrapper">
        <!-- <div class="tpl-content-page-title">
             Amaze UI 首页组件
         </div>
         <ol class="am-breadcrumb">
             <li><a href="#" class="am-icon-home">首页</a></li>
             <li><a href="#">分类</a></li>
             <li class="am-active">内容</li>
         </ol> -->


        <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">


            <!--标题-->

            <div class="panel-heading">

                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 激活码生成：单个激活码生成
                </div>

            </div>


            <!--标题-->


            <div class="panel-body">


                <div class="form-group">
                    <label class="control-labell" for="field-5"></label>
                    <select name="ctime" id="ss" class="form-control">

                        <option value="1" }>体验卡:1元</option>
                        <option value="3" }>月卡:3元</option>
                        <option value="7" }>季卡:7元</option>
                        <option value="12" }>半年卡:12元</option>
                        <option value="20" }>年卡:20元</option>
                        <option value="60" }>永久:60元</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-labell" for="field-5">备注</label>
                    <input type="text" id="comment" class="form-control" value="" name="comment">
                </div>

                <div class="form-group">
                    <div id="singleKeyText"></div>
                    <button type="submit" onclick="dangetian()" class="btn btn-success">生成</button>

                </div>
                <script>

                    function dangetian() {
                        var ctime = $('#ss').val();
                        var fen = 1;
                        var comment = $('#comment').val();
                        $.ajax({
                            'type': 'post',
                            'url': '/index/dianka/dangesheng.html',
                            'data': {
                                'ctime': ctime,
                                'fen': fen,
                                'comment':comment
                            },
                            'dataType': 'json',
                            'success': function (msg) {
                                if (msg.code == '1') {

                                    $("#singleKeyText").html(msg.dian)

                                    // layer.msg('成功！正在跳转…', {
                                    //     icon: 1,//提示的样式
                                    //     time: 2000, //2秒关闭（如果不配置，默认是3秒）//设置后不需要自己写定时关闭了，单位是毫秒
                                    //     end: function () {
                                    //         location.href = ('/index/dao/txt.html?content=' + msg.dian);
                                    //     }
                                    // });

                                } else {
                                    layer.msg(msg.dian);
                                }
                            },
                            'error': function () {
                                layer.alert('服务器错误');
                            }
                        })
                    }


                </script>


                <?php

foreach($dian as $v)
{
echo $v."<br>";
                }
                ?>
            </div>

        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">


            <!--标题-->

            <div class="panel-heading">

                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 激活码批量生成:一次性购卡100张以上请联系上级代理批发购买
                </div>

            </div>


            <!--标题-->


            <div class="panel-body">


                <div class="form-group">
                    <label class="control-labell" for="field-5"></label>
                    <select name="ctime" id="sss" class="form-control">

                        <option value="1" }>体验卡:1元</option>
                        <option value="3" }>月卡:3元</option>
                        <option value="7" }>季卡:7元</option>
                        <option value="12" }>半年卡:12元</option>
                        <option value="20" }>年卡:20元</option>
                        <option value="60" }>永久:60元</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-labell" for="field-5">份数</label>
                    <input type="number" id="fen" class="form-control" value="" name="fen">
                </div>
                <div class="form-group">
                    <label class="control-labell" for="field-5">备注</label>
                    <input type="text" id="comment2" class="form-control" value="" name="comment">
                </div>

                <div class="form-group">
                    <button type="submit" onclick="tian()" class="btn btn-success">批量生成</button>
                    <button type="reset" class="btn btn-white">重置</button>
                </div>
                <script>
                    function tian() {
                        var ctime = $('#sss').val();
                        var fen = $('#fen').val();
                        var comment = $('#comment2').val();
                        $.ajax({
                            'type': 'post',
                            'url': '/index/dianka/sheng.html',
                            'data': {
                                'ctime': ctime,
                                'fen': fen,
                                'comment':comment
                            },
                            'dataType': 'json',
                            'success': function (msg) {
                                if (msg.code == '1') {
                                    layer.alert(msg.dian, {
                                        btn: ['txt导出', 'excel导出', '取消'],
                                        btn1: function (index, layero) {
                                            var form = $('<form method="POST" action="/index/dao/txt.html">');
                                            form.append($('<input type="hidden" name="content" value="' + msg.dian + '">'));
                                            form.appendTo('body').submit().remove();
                                        }
                                        , btn2: function (index, layero) {
                                            var form = $('<form method="POST" action="/index/dao/excel.html">');
                                            form.append($('<input type="hidden" name="content" value="' + msg.dian + '">'));
                                            form.appendTo('body').submit().remove();
                                            return false
                                        }
                                    })
                                } else {
                                    layer.alert(msg.dian);
                                }
                            },
                            'error': function () {
                                layer.alert('服务器错误');
                            }
                        })
                    }


                </script>
                <?php

foreach($dian as $v)
{
echo $v."<br>";
                }
                ?>
            </div>

        </div>
    </div>

</div>           <!-- 调用index/下的文件 -->


    </div>

</div>


<!--  <script src="/public/static/amz/js/jquery.min.js"></script> -->

<script src="/public/static/amz/js/amazeui.min.js"></script>
<script src="/public/static/amz/js/iscroll.js"></script>


<!--原JS 数据调用-->

<!-- Bottom Scripts -->
<script src="/public/static/assets/js/bootstrap.min.js"></script>
<script src="/public/static/assets/js/TweenMax.min.js"></script>
<script src="/public/static/assets/js/resizeable.js"></script>
<script src="/public/static/assets/js/joinable.js"></script>
<script src="/public/static/assets/js/xenon-api.js"></script>
<script src="/public/static/assets/js/xenon-toggles.js"></script>


<!-- Imported scripts on this page -->
<script src="/public/static/assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/public/static/assets/js/jvectormap/regions/jquery-jvectormap-world-mill-en.js"></script>
<script src="/public/static/assets/js/xenon-widgets.js"></script>
<script src="/public/static/assets/js/devexpress-web-14.1/js/globalize.min.js"></script>
<script src="/public/static/assets/js/devexpress-web-14.1/js/dx.chartjs.js"></script>

<script src="/public/static/assets/js/jquery-validate/jquery.validate.js"></script>
<!-- JavaScripts initializations and stuff -->
<script src="/public/static/assets/js/xenon-custom.js"></script>
<script src="/public/static/layer/layer.js"></script>

<script src="/public/static/amz/js/app.js"></script>
<script>
    function daili_money(status, id) {
        if (status == '1') {
            var str = 'all';
        } else {
            if (id == '') {
                var str = "";
                $("input:checkbox[name='checkname']:checked").each(function () {
                    str += $(this).val() + ",";
                });

                if (str == '') {
                    return false
                }
            } else {
                var str = id
            }
        }


        layer.prompt({title: '请输入充值点数', formType: 3}, function (pass, index) {
            if (!isNaN(pass)) {
                if (pass < 100) {
                    $('.layui-layer-content').append('<br><span style="color: red">最低起充金额100元</span>')
                    return false;
                }
                window.location.href = 'http://www.juhys.com/daili_pay/?id=' + id + '&name=代理自助充点&fee=' + pass;
                /*$.ajax({
                    'type'  :   'post',
                    'url'   :   '<?php echo url("http://www.juhys.com/daili_pay/?name='+pass+'&fee='+pass+'"); ?>',
                    'data'  :   {
                        'id'    :   str,
                        'status':   status,
                        'money' :   pass,
                        'type'  :   1
                    },
                    'dataType'  :   'json',
                    'success'   :   function (msg)
                    {
                        if(msg.code=='1')
                    {

                        window.location.reload();
                    }else{
                        layer.closeAll();
                        $('#del').php('<div class="col-md-6" id="alert">' +
                            '<div class="alert alert-danger"  style="position:fixed;right:0px;bottom:0px;  width: 350px">' +
                            ' <button type="button" class="close" data-dismiss="alert">' +
                            '<span aria-hidden="true">×</span>' +
                            '<span class="sr-only">Close</span>' +
                            '</button>' +
                            '<strong> 糟糕 !</strong> '+msg.msg+
                            '' +
                            '</div>' +
                            '</div>');
                        setTimeout("yalert()", 2000)
                    }

                        layer.closeAll();
                        setTimeout("$('#alert').fadeOut(1000)", 2000)
                    },
                    'error'     :   function (err)
                    {
                        layer.closeAll();
                        $('#del').php('<div class="col-md-6" id="alert">' +
                            '<div class="alert alert-danger"  style="position:fixed;right:0px;bottom:0px;  width: 350px">' +
                            ' <button type="button" class="close" data-dismiss="alert">' +
                            '<span aria-hidden="true">×</span>' +
                            '<span class="sr-only">Close</span>' +
                            '</button>' +
                            '<strong> 糟糕 !</strong> 服务器错误'+
                            '.请刷新后重试' +
                            '</div>' +
                            '</div>');
                        setTimeout("yalert()", 2000)
                    }
                })*/
                layer.close(index);
            } else {
                $('.layui-layer-content').append('<br><span style="color: red">请填入纯数字</span>')
                return false;
            }


        })


    }

</script>

</body>

</html>