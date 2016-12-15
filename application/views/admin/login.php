<!DOCTYPE html>
<!-- saved from url=(0038)http://v3.bootcss.com/examples/signin/ -->
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://v3.bootcss.com/favicon.ico">

    <title>用户登录</title>

    <!-- Bootstrap core CSS -->
    <link href="/myciBlog/public/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/myciBlog/public/admin/css/signin.css" rel="stylesheet">


    <script src="/myciBlog/public/admin/js/ie-emulation-modes-warning.js"></script>
    <script src="/myciBlog/public/admin/js/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/myciBlog/public/admin/js/html5shiv.min.js"></script>
    <script src="/myciBlog/public/admin/js/respond.min.js"></script>
    <![endif]-->
</head>

<div class="container">
    <form action="<?=site_url('admin/user/login') ?>" method="post" enctype="multipart/form-data" class="form-signin">
        <h2 class="form-signin-heading">MY_BLOG</h2>
        <label for="inputEmail" class="sr-only">用户名</label>
        <input type="email" id="inputEmail" name="inputEmail" value="<?php echo set_value('inputEmail'); ?>" class="form-control" placeholder="Email address" autofocus="">
        <?php echo form_error('inputEmail'); ?>
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" id="inputPassword" name="inputPassword" value="<?php echo set_value('inputPassword'); ?>" class="form-control" placeholder="Password" >
        <?php echo form_error('inputPassword'); ?>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> 下次自动登录
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit"  id="submit">登录</button>
    </form>
</div><!-- /container -->

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/myciBlog/public/admin/js/ie10-viewport-bug-workaround.js"></script>

<script type="application/javascript">
    function check_mail(email){
        re = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/
        if(re.test(email)){
            return true;
        }else{
            return false;
        }
    }

    //    $("#submit").click(function(){
    //        var pwd = $("#inputPassword").val();
    //        var user = $("#inputEmail").val();
    //        if (pwd == null || user == "") {
    //            $("#msg").html("请填写完整，不要为空");
    //            $("#npassword").focus();
    //            return false;
    //        } else if (!check_mail(user)) {
    //            $("#msg").html("请填写正确的邮箱地址");
    //            // $("#inputEmail").attr("value", "3123123");
    //            $("#inputEmail").focus();
    //            return false;
    //        } else {
    //            var data=$("form").serialize();
    //            $.post("login", data );
    //        }
    //    });

</script>

</body></html>