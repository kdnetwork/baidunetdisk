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
    <title>百度网盘直链工具</title>
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
          <a class="navbar-brand" href="./">百度网盘直链工具</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="./"><span class="glyphicon glyphicon-home"></span> 主页 </a></li>
            <?php if(strlen($_COOKIE['bduss']) > 0){echo '<li><a href="./?m=bus"><span class="glyphicon glyphicon-link"></span> 分享链接直链 </a></li><li><a href="./?m=dl"><span class="glyphicon glyphicon-cloud-download"></span> 离线下载 </a></li><li><a href="./?m=list&path=%252F&page=1"><span class="glyphicon glyphicon-folder-open"></span> 文件列表 </a></li><li></ul><ul class="nav navbar-nav navbar-right"><li><a href="./logout.php"><span class="glyphicon glyphicon-off"</span> 退出 </a></li></ul>';
            }
            ?>
              
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <?php
                        if($_GET["m"] == 'bduss'){
                            include('./lib/bduss.php');
                        }elseif($_GET["m"] == 'bus'){
                            include('./lib/bus.php');
                        }elseif($_GET["m"] == 'car'){
                            include('./lib/car.php');
                        }elseif($_GET["m"] == 'list'){
                            include('./lib/list.php');
                        }elseif($_GET["m"] == 'suv'){
                            include('./lib/suv.php');
                        }elseif($_GET["m"] == 'dl'){
                            include('./lib/dl.php');
                        }elseif($_GET["m"] == 'about'){
                            include('./lib/about.php');
                        }else{
                            include('./lib/main.php');
                        }
                        ?>
    <center>
        <b>
            v5.0.13<br>©2015-<?php echo date("Y") ?> <a href="https://kdwnil.ml">KDWNIL</a>
        </b>
    </center>
  </body>
  <!--js-->
  <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>