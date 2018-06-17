<?php
require '../config.php';
header("Content-type: text/html; charset=utf-8");
ignore_user_abort(true);
echo '<title>百度网盘直链获取工具</title>';
echo '<meta name="viewport" content="width=device-width,maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">';
if(strlen($_POST['bduss']) <=0){
$bduss=$_COOKIE['bduss'];}
else{$bduss=$_POST["bduss"];}
if(strlen($_POST['path']) <=0){$path=urlencode($_GET['path']);
}else{$path=urlencode($_POST['path']);}
if(strlen($path) <=0){
echo '<meta http-equiv="Refresh" content="0;url=./">';
echo '参数非法';
}else {
if(strlen($bduss) > 0){
$url='http://pcs.baidu.com/rest/2.0/pcs/share?method=create&type=public&path=/'.$path.'&app_id='.$appid;
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_COOKIE,'BDUSS='.$bduss);
curl_setopt($ch, CURLOPT_REFERER,'pcs.baidu.com');
curl_setopt($ch, CURLOPT_POST,1);
$content = curl_exec($ch);
curl_close($ch);
if(strlen(json_decode($content,1)["list"][0]) > 0){
    if($_GET['type'] == pic){
    echo '<img src="'.json_decode($content,1)["list"][0].'"/>';}
elseif($_GET['type'] == video){
    echo '<video src="'.json_decode($content,1)["list"][0].'" controls="controls">
</video>';
}
else{
echo '直链地址:'.json_decode($content,1)["list"][0];
echo '<br /><a href="'.json_decode($content,1)["list"][0].'" text-decoration="none"<button>点我下载</button></a> <a href="./" text-decoration="none"<button>继续获取</button></a> <a href="./logout.php">退出</a>';
}
}else{echo '<meta http-equiv="Refresh" content="2;url=./">查无此文件,请检查您的账号信息及数据存储路径';}
}else{echo '<meta http-equiv="Refresh" content="5;url=./">';
echo '找不到bduss,请尝试重新登录,5秒后回到<a href="./">主页</a>';}}
echo '<meta name="keywords" content="百度网盘,KDWNIL," />';
echo '<br />Power by KDWNIL<br/>getbduss service power by <a href="https://bduss.tbsign.cn">简云</a>';
