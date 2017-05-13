<?php
if(!file_exists('./install/install.lock')){
    echo '<meta charset="utf-8"><title>跳转中</title><meta http-equiv="Refresh" content="1;url=./install">您未安装本程序,正在跳转至安装页面';
    EOF;
}