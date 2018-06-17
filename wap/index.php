<?php
require dirname(__FILE__) .'/../init.php';
header("Content-type: text/html; charset=utf-8");
echo '<link rel="shortcut icon" href="./favicon.ico" />';
if($_GET["posturl"] == 'suv'){
$posturl='./suv.php';
}else{$posturl='./car.php';}
echo '<title>百度网盘直链获取工具</title>';
echo '<meta name="keywords" content="百度网盘,KDWNIL," />';
echo '<h1>百度网盘直链获取工具</h1>';
echo '<meta name="viewport" content="width=device-width,maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">';
if(strlen($_COOKIE['bduss']) > 0){
    $tbscurl=curl_init('http://tieba.baidu.com/dc/common/tbs');
    curl_setopt($tbscurl,CURLOPT_COOKIE,'BDUSS='.$_COOKIE['bduss']);
    curl_setopt($tbscurl,CURLOPT_RETURNTRANSFER,1);
    $tbsjson = curl_exec($tbscurl);
    curl_close($tbscurl);
    $check_login=json_decode($tbsjson,1)["is_login"];
    if($check_login == 1){echo '<form action="'.$posturl.'" method="post">文件目录: <input type="text" name="path"><br><i>*填写绝对路径</i><br>**';if($posturl == './suv.php'){echo '若需要用第一种获取方式请点<a href="./" >这里</a>';}else{echo'若需要用第二种获取方式请点<a href="./?posturl=suv" >这里</a>';}
    echo '<br><input type="submit"></form><br />*绝对路径:如在首页名为"x"的文件夹内名称为"k.png"的文件请填写"x/k.png"<br /><b>还是不会填?点击<a href="./list.php?page=1">这里</a>直接访问文件列表</b><br /><a href="../?fr=old">回到新版</a><br><a href="../logout.php?fr=old">退出</a>';}
    else{echo '<title>跳转中</title><meta http-equiv="Refresh" content="1;url=../logout.php?fr=old">bduss无效...';}
}    
elseif(strlen($_GET['bduss']) > 0){
    $tbscurl=curl_init('http://tieba.baidu.com/dc/common/tbs');
    curl_setopt($tbscurl,CURLOPT_COOKIE,'BDUSS='.$_GET['bduss']);
    curl_setopt($tbscurl,CURLOPT_RETURNTRANSFER,1);
    $tbsjson = curl_exec($tbscurl);
    curl_close($tbscurl);
    $check_login=json_decode($tbsjson,1)["is_login"];
    if($check_login == 1){
    setcookie('bduss',$_GET['bduss'],time()+315705600,'/',$_SERVER['HTTP_HOST']);
    setcookie('ptoken',$_GET['ptoken'],time()+315705600,'/',$_SERVER['HTTP_HOST']);
    setcookie('stoken',$_GET['stoken'],time()+315705600,'/',$_SERVER['HTTP_HOST']);
    echo '<title>跳转中</title><meta http-equiv="Refresh" content="0;url=./">跳转中...';}
    else{echo '<title>跳转中</title><meta http-equiv="Refresh" content="1;url=./">bduss无效...';}}
    else{
    echo '<b>您还没有登录!</b><br /><a href="../?m=bduss&fr='.urlencode($_SERVER['HTTP_HOST'].'/old').'">点我登录</a>';
}echo '<br /><a href="./bus">分享链接直链获取工具</a><br>*免责声明：您在本站进行的任何行为所造成的任何后果本站概不负责<br />Power by KDWNIL<br/>Getbduss service by <a href="https://bduss.tbsign.cn">简云</a>';
