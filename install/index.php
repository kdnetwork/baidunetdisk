<?php
if(file_exists('./install.lock')){
    echo '<meta charset="utf-8"><title>百度网盘直链工具安装</title>您已安装程序,若需要重新安装,请先删除本目录下的<strong>install.lock</strong>文件再<a href="./">刷新</a>';
    die;
}
if($_POST["ok"] == 1){
    if($_POST["ok"]==1){
    fopen('./install.lock','w');
     $fp = fopen('./config.php','w');
    flock($fp,LOCK_EX);
    fwrite($fp,'<?php'."\n".'$appid=\''.$_POST["appid"]."';\n".'$url=\''.$_POST["url"]."';\n".'$token=\''.md5(md5($_POST["url"]).'kdcloud')."';\n".'$admin_id=\''.urldecode($_POST["admin_id"]))."';\n".'$siteurl=\'http://'.$_POST["url"]."';\n".'$version=\'v5.0.16\';';;
    fclose($fp,LOCK_UN);
}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="KDWNIL Union of Cloud Computing (https://kdwnil.ml)"/>
    <meta name="description" content="百度网盘直链工具" />
    <meta name="keywords" content="百度网盘,KDWNIL," />
    <link rel="icon" href="./favicon.ico">
    <title>百度网盘直链工具安装</title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <style type="text/css">
    a:link {
        text-decoration: none;
        word-break: break-all;
    }
    a:visited {
        text-decoration: none;
        word-break: break-all;
    }
    a:hover {
        text-decoration: none;
        word-break: break-all;
    }
    a:active {
        text-decoration: none;
        word-break: break-all;
    }
    </style>
  </head>

  <body>
     <!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，我们暂不支持。 请 <a href="http://browsehappy.com/"
                                                                 target="_blank">升级浏览器</a>
	以获得更好的体验！</p>
<![endif]-->

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">百度网盘直链工具</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../">百度网盘直链工具</a>
        </div>
      </div>
    </nav>
    <div class="col-md-12" role="main">
    <center>
        <form action="./" method="post">
        <label >您的网站地址</label>
        <div class="input-group">
            <input type="text" class="form-control" type="url" aria-describedby="basic-addon1">
        </div>
        <label >您的管理员的百度id(多个请用"|"隔开,最后一个后面不用加"|")</label>
        <div class="input-group">
            <input type="text" class="form-control" type="admin_id" aria-describedby="basic-addon1">
        </div>
        <input type="hidden" name="appid" value="266719">
        <input type="hidden" name="ok" value="1">
        <button class="btn btn-default" type="submit">提交</button>
    </form>
    </center>
    </div>
    <center>
        <b>
            <?echo $version ?><br>©2015-<?php echo date("Y") ?> <a href="https://kdwnil.ml">KDWNIL</a>
        </b>
    </center>
  </body>
  <!--js-->
  <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>