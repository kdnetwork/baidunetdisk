<?php
header("Content-type: text/html; charset=utf-8");
ignore_user_abort(true);
echo '<title>百度网盘直链获取工具</title>';
echo '<meta name="keywords" content="百度网盘,KDWNIL," />';
echo '<h1>百度网盘直链获取工具</h1>';
echo '<meta name="viewport" content="width=device-width,maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">';
if(strlen($_POST['bduss']) <=0){
$bduss=$_COOKIE['bduss'];}
else{$bduss=$_POST["bduss"];}
if(strlen($_POST['dl_url']) <=0){$dl_url=urlencode($_GET['dl_url']);
}else{$dl_url=urlencode($_POST['dl_url']);}
if(strlen($dl_url) <=0){
echo '<meta http-equiv="Refresh" content="1;url=./">链接输入错误,请重新输入';
}else {
if(strlen($bduss) > 0){
$dl_url=urlencode($_POST["dl_url"]);
$url='http://pan.baidu.com/rest/2.0/services/cloud_dl?channel=chunlei&web=1&app_id=250528&bdstoken=null&logid=MTQ4ODAyOTAyMDA3NDAuMTQ4NzkzNjI2NzA2NTg1NDc=&clienttype=0';
$data="method=add_task&app_id=250528&source_url={$dl_url}&save_path=%2F我的资源";
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_COOKIE,'BDUSS='.$bduss);
curl_setopt($ch, CURLOPT_REFERER,'pan.baidu.com');
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
$content = curl_exec($ch);
curl_close($ch);
$dl=json_decode($content,1);
if(strlen($dl["task_id"]) >0){
echo "<meta http-equiv=\"Refresh\" content=\"5;url=./\">添加成功!";
}else{echo "<meta http-equiv=\"Refresh\" content=\"5;url=./\">添加失败!请检查您的链接";}
}else{echo '<meta http-equiv="Refresh" content="5;url=./">';
echo '找不到bduss,请尝试重新登录,5秒后回到<a href="./">主页</a>';}}
echo '<meta name="keywords" content="百度网盘,KDWNIL," />';
echo '<br />Power by KDWNIL<br/>getbduss service power by <a href="https://bduss.tbsign.cn">简云</a>';
