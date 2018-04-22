<!DOCTYPE html><html lang="zh-CN">    <head>        <meta name="robots” content="nofollow” />        <meta charset="utf-8">        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <link rel="shortcut icon" href="./favicon.ico" />        <meta name="viewport" content="width=device-width, initial-scale=1">        <meta name="author" content="KDWNIL Union of Cloud Computing (https://pan.nullmix.ml)" />        <meta name="description" content="百度网盘直链工具" />        <meta name="keywords" content="<?
echo $seo?>
" />        <link rel="icon" href="./favicon.ico">        <title>百度网盘直链工具</title>        <!-- 最新版本的 Bootstrap 核心 CSS 文件 --><link rel="stylesheet" href="./static/css/bootstrap.min.css">                <style type="text/css">a:link{
	text-decoration:none;
	word-break:break-all;
}
a:visited{
	text-decoration:none;
	word-break:break-all;
}
a:hover{
	text-decoration:none;
	word-break:break-all;
}
a:active{
	text-decoration:none;
	word-break:break-all;
}
</style>    </head>        <body>        <!--[if lte IE 9]>            <p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，我们暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>以获得更好的体验！</p>        <![endif]-->        <!-- Fixed navbar -->        <nav class="navbar navbar-default navbar-static-top">            <div class="container">                <div class="navbar-header">                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">百度网盘直链工具</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>                    </button>                    <a class="navbar-brand" href="./">                        <img alt="KD·Cloud" src="./kdcloud100.png">                    </a>                </div>                <div id="navbar" class="navbar-collapse collapse">                    <ul class="nav navbar-nav">                        <li><a href="./"><span class="glyphicon glyphicon-home"></span> 主页 </a>                        </li>                                                <?php
if(strlen($_COOKIE['bduss'])>0){
	echo '                        <li><a href="./?m=bus"><span class="glyphicon glyphicon-link"></span> 分享链接直链 </a>                        </li>                        <li><a href="./?m=search"><span class="glyphicon glyphicon-search"></span> 搜索 </a>                        </li>                        <li ><a href="./?m=dl"><span class="glyphicon glyphicon-cloud-download"></span> 离线下载 </a>                        </li>                        <li><a href="./?m=list&by=time&order=asc&path=%252F&page=1"><span class="glyphicon glyphicon-th-list"></span> 文件列表 </a>                            <!--<ul class="dropdown-menu">                                <li><a href="./?m=list&by=time&order=asc&path=%252F&page=1">修改时间顺序</a>                                </li>                                <li><a href="./?m=list&by=name&order=asc&path=%252F&page=1">文件名顺序</a>                                </li>                                <li><a href="./?m=list&by=size&order=asc&path=%252F&page=1">大小顺序</a>                                </li>                                <li><a href="./?m=list&by=time&order=desc&path=%252F&page=1">修改时间顺序(倒序)</a>                                </li>                                <li><a href="./?m=list&by=name&order=desc&path=%252F&page=1">文件名顺序(倒序)</a>                                </li>                                <li><a href="./?m=list&by=size&order=desc&path=%252F&page=1">大小顺序(倒序)</a>                                </li>                            </ul>-->                        </li>                        <li>                    </ul>                    <ul class="nav navbar-nav navbar-right">                        <li>                            ';
}
/*if(preg_match("/{$admin_id}/",$_COOKIE["baiduid"])){ echo '
                        <li><a href="./?m=admin"><span class="glyphicon glyphicon-cloud"></span> 网站后台 </a>
                        </li>'; }*/
if(strlen($_COOKIE['bduss'])>0){
	echo '                        <li class="dropdown" onclick="">                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-user" ></span> '.json_decode(head(@$_COOKIE["bduss"]),1)["un"].'</a>                            <ul class="dropdown-menu" id="info"></ul>                        </li>';
}
else{
	echo '<li class="active"><a href="./?m=bduss&fr='.urlencode($_SERVER['SERVER_NAME']).'">登录</a></li>';
}
?>
                    </ul>                </div>            </div>        </nav>        <?php
if(strlen($_GET["m"])>0 && file_exists('./lib/'.$_GET["m"].'.php')){
	include('lib/'.$_GET["m"].'.php');
}
else{
	include('./lib/main.php');
}
?>
        </div>        <div class="col-md-12">        <center> <b>            <?
echo $version?>
<br>© 2015-<?php
echo date("Y")?>
<a href="https://github.com/kdnetwork" target="_blank"> KD·lab </a><br><?
if(file_exists(dirname(__FILE__).'/../lib/about.php')){
	echo '<a href="./?m=about". target="_blank">ABOUT</a>';
}
elseif(file_exists(dirname(__FILE__).'/../about.html')){
	echo '<a href="./about.html". target="_blank">ABOUT</a>';
}
?>
        </b>        </center>        </div>    <!--js-->    <script src="./static/js/jquery.min.js"></script>    <script src="./static/js/bootstrap.min.js"></script>    <?
if($_COOKIE["bduss"]!=""){
	?>
		<script type="text/javascript">$.ajax({async:true,url:'./?m=info',type:"GET",data:{
}
	,dataType:'HTML',timeout:90000,success:function (data){
		$("#info").html(data);
	}
	,error:function (error){
		$("#info").html("信息读取失败");
	}
});
</script><?
}
if($_GET['m']=='bduss' && $chinamode==0 && $secret!==''){
echo '<script src=\'https://www.recaptcha.net/recaptcha/api.js\'></script>';
}
?>
</script></body></html>