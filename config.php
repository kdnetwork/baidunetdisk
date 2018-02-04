<?php
if($_SERVER['HTTPS']==on){
    $httptype='https';
}else{
    $httptype='http';
}
$logid='MTUxNzczMjQ3NzMzNDAuMzMzODQwMzYzNTI5ODMzMjY';//求大仙解释logid是啥。。。
$token='';//token
$appid='266719';
$url='';//主域名
$siteurl=$httptype.'://'.$url;
$admin_id='';//管理员id
$version='v5.8';
$seo='百度网盘直链工具';//seo信息
$language='zh_cn';//语言
$chinamode=1;//顾名思义
$secret='';//for reCAPTCHA
$data_sitekey='';//for reCAPTCHA
$banlocation='';//禁止访问的地区，填写国家和地区的名称，如禁止A国和B国则填写'A国|B国'，默认空白，如需更新数据库请登录后到https://www.ipip.net/free_download/下载并解压内容到ip文件夹
$myotherurl=$url;//多域名，已失效
    