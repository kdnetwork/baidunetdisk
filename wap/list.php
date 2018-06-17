<?php
require '../config.php';
header("Content-type: text/html; charset=utf-8");
ignore_user_abort(true);
$list=$_GET['page'];
$bduss=urlencode($_COOKIE['bduss']);
echo '<title>文件列表</title>';
echo '<meta name="viewport" content="width=device-width,maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">';
if(strlen($_GET['path']) <= 0){
  $path='%2F';
}else{$path=$_GET['path'];}
if(strlen($list) <=0){
 echo '<meta http-equiv="Refresh" content="2;url=./list.php?path='.$path.'&page=1">';
//$list=1
$url='http://pcs.baidu.com/rest/2.0/pcs/file?path=/'.$path.'&method=list&app_id='.$appid.'&by=name&order=asc&limit=0-10';}
elseif($list<=0){echo'<meta http-equiv="Refresh" content="0;url=./list.php">参数非法<br/>';}
else{ $url='http://pcs.baidu.com/rest/2.0/pcs/file?path=/'.$path.'&method=list&app_id='.$appid.'&by=name&order=asc&limit='.($list-1).'0-'.$list.'0';}
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_COOKIE,'BDUSS='.$bduss);
curl_setopt($ch, CURLOPT_REFERER,'pcs.baidu.com');
curl_setopt($ch, CURLOPT_POST,1);
$content = curl_exec($ch);
curl_close($ch);
//echo $content;
if(json_decode($content,1)["error_code"] == 31045){
    echo '<meta http-equiv="Refresh" content="2;url=./list.php">您还没有登录或文件不存在';
}else{
$b=json_decode($content,1);
echo '<a href="./">返回首页</a><br />';
$x=0;
do{
if($b["list"][$x]["isdir"] == 1){echo '文件夹:<a href="./list.php?path='.urlencode($b["list"][$x]["path"]).'&page=1">'.$b["list"][$x]["server_filename"].'</a><br />';
}else{echo '文件:'.$b["list"][$x]["server_filename"].' <a href="./car.php?path='.urlencode($b["list"][$x]["path"]).'"target="_blank">获取高速连接1</a> <a href="./suv.php?path='.urlencode($b["list"][$x]["path"]).'"target="_blank">获取高速链接2</a><br />';}
    $x++;
}while ($x <= count($b["list"])-1);

}
echo '<a href="./list.php?path='.urlencode($path).'&page='.($list-1).'">上一页</a> <a href="./list.php?path='.urlencode($path).'&page='.($list+1).'">下一页</a>';
