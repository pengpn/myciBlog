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
    <script src="/myciBlog/public/admin/js/jquery-3.1.1.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/myciBlog/public/admin/js/html5shiv.min.js"></script>
    <script src="/myciBlog/public/admin/js/respond.min.js"></script>
    <![endif]-->

    <style>
        .error{
            color:#F00;font-weight:bold;
        }
        #usernameError{
            position: absolute;
            left: 582px;
            top: 131px;
        }
        #passwordError{
            position: absolute;
            left: 582px;
            top: 171px;
        }
    </style>
</head>

<div class="container">
    <form id="formreg" action="<?=site_url('admin/user/register') ?>" method="post" enctype="multipart/form-data" class="form-signin">
        <h2 class="form-signin-heading">MY_BLOG</h2>

        <label for="inputEmail" class="sr-only">用户名</label>
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" autofocus="">
        <span id="usernameError" class="error"></span>
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" >
        <span id="passwordError" class="error"></span>
        <button class="btn btn-lg btn-primary btn-block"  id="submit">注册</button>
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

    $(function () {
        $("#inputEmail").blur(function(){
            var url = "<?=site_url('admin/user/checkUser');?>";
            var username = $("#inputEmail").val();
            if(username == ""){
                $("#usernameError").text("用户名不能为空");
            }else if(username.length<6 || username.length>20){
                $("#usernameError").text("用户名必须为6-20个字符");
            }else{
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {"userName" : username},
                    dataType: "json",
                    success: function (result) {
                        if(result.status == 0){
                            $("#formreg").submit(function(e){
                                e.preventDefault();
                            });
                        }
                        $("#usernameError").text(result.msg);
                    }
                });
            }
        });
        $("#inputPassword").blur(function(){
            var password = $("#inputPassword").val();
            if(password == ""){
                $("#passwordError").text("密码不能为空");
            }
        });
    });

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