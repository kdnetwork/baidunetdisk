<?php
require('./config.php');
if(file_get_contents('https://pan.kdwnil.ml?m=ban&site='.base64_encode($url)) == 'ban'){
    echo '您的站点已被封禁,详情请到kdwnil查看更多';
    die;
}
if(!file_exists('./install/install.lock')){
    echo '<meta charset="utf-8"><title>跳转中</title><meta http-equiv="Refresh" content="1;url=./install">您未安装本程序,正在跳转至安装页面';
    die;
}