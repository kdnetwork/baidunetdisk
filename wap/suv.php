<?php
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
echo '<meta http-equiv="Refresh" content="0;url=./?posturl=suv">';
echo '参数非法';
}else {
if(strlen($bduss) > 0){
echo '<h1>百度网盘直链获取工具</h1>请尽量少用本功能，本功能可能导致您的百度账号进入黑名单导致今后10kb/s的下载速度<br>';
$url='http://d.pcs.baidu.com/rest/2.0/pcs/file?method=locatedownload&app_id=250528&ver=2.0&dtype=0&esl=1&ehps=0&check_blue=1&clienttype=1&path=/'.$path.'&logid=MTQ4Nzg2MTc5NjcyNTAuMzAzMjk0NDAxODQyNzQ0OQ==';
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_COOKIE,'BDUSS='.$bduss);
curl_setopt($ch, CURLOPT_POST,1);
$content = curl_exec($ch);
curl_close($ch);
//echo $content;
//echo count($json["urls"]);
$json=json_decode($content,1);
$x=0;
do{
echo '直链地址'.($x+1).':<a href="'.$json["urls"][$x]["url"].'" >'.$json["urls"][$x]["url"].'</a><br />';
$x++;
}while ($x <= count($json["urls"])-1);
echo '<br /><a href="./?posturl=suv" text-decoration="none"<button>回到主页</button></a> <a href="./logout.php">退出</a>';
}else{echo '<meta http-equiv="Refresh" content="5;url=./?posturl=suv">';
echo '找不到bduss,请尝试重新登录,5秒后回到<a href="./?posturl=suv">主页</a>';}
}
echo '<meta name="keywords" content="百度网盘,KDWNIL," />';
echo '<br />Power by KDWNIL<br/>getbduss service power by <a href="https://bduss.tbsign.cn">简云</a>';
