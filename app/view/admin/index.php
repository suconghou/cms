<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-dns-prefetch-control" content="on" />
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" href="/static/css/admin.css">
    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <title>管理后台 - <?=SITENAME?></title>
</head>
<body>
    <div id="container">
        <header id="header">
            <h1 class="site-title"><?=SITENAME?></h1>
        </header>
        <nav id="nav">
            <ul class="menu">
                <li data-page="index">管理首页</li>
                <li data-page="posts">文章管理</li>
                <li data-page="forum">板块管理</li>
                <li data-page="users">会员管理</li>
                <li data-page='files'>下载管理</li>
                <li data-page='files'>文件管理</li>
                <li data-page="system">系统信息</li>
                <li data-page='index4'>系统设置</li>
                <li data-page='index1'>登陆日志</li>
                <li data-page='index5'>统计信息</li>
                <li data-page='index6'>统计信息</li>
                <li data-page='index7'>统计信息</li>
                <li data-cmd="logout">安全退出</li>
            </ul>
        </nav>
        <div id="wrapper">
            <div id="page-container">
                <div id="shows">
                    <div class="location-bar">
                        <ul>
                            <li>管理首页</li>
                        </ul>
                    </div>
                    <div class="page-content">
                        <div class="padding-box">
                            <div class="panel success">
                            <p style="text-indent:2em;">
                                欢迎,你已经成功登陆!
                            </p>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end wrapper -->
        <footer id="footer">
            
        </footer>
        <div class="helper">
            <div id="alert"></div>
        </div>
    </div> <!-- end container -->
    <div>
        <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
        <script src="/static/js/admin.js"></script>
    </div>
</body>
</html>