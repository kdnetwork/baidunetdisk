<?php
require './config.php';
header("Content-type: text/html; charset=utf-8");
ignore_user_abort(true);
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
echo '<div class="col-md-12" role="main"><b>请尽量少用本功能，本功能可能导致您的百度账号进入黑名单导致今后10kb/s的下载速度</b><br>';
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
$href = $json["urls"][$x]["url"];
echo '<div class="panel panel-default"><div class="panel-body">直链地址'.($x+1).':<a href="'.$href.'" >'.$href.'</a></div></div>';
$x++;
}while ($x <= count($json["urls"])-1);
echo '<br /><div class="btn-group" role="group" aria-label="..."><a href="./?posturl=suv" text-decoration="none"><button type="button" class="btn btn-default">回到主页</button></a></div>';
}else{echo '<meta http-equiv="Refresh" content="5;url=./?posturl=suv">';
echo '找不到bduss,请尝试重新登录,5秒后回到<a href="./?posturl=suv">主页</a>';}
}
