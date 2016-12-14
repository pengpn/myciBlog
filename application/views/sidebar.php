</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            后台管理
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?=site_url('admin/home');?>"><?php echo $_SESSION['userName']?></a></li>
                <li><a href="<?=site_url('admin/user/logOut');?>">登出</a></li>
                <li><a>网站</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a>新建文章</a></li>
                <li><a>所有文章</a></li>
                <li><a>分类目录</a></li>
                <li><a>标签</a></li>
                <li><a>个人资料</a></li>
                <li><a>常规设置</a></li>
                <li><a>关于设置</a></li>
                <li><a>测试</a></li>
            </ul>
        </div>