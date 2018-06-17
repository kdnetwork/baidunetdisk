<?php
header("Content-type: text/html; charset=utf-8");
echo '<title>百度网盘直链获取工具</title>';
echo '<meta name="keywords" content="百度网盘,KDWNIL," />';
echo '<h1>百度网盘直链获取工具</h1>';
echo '<meta name="viewport" content="width=device-width,maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">';
echo '指南：请先输入链接地址(暂不支持文件夹以及文件夹内文件、加密分享、部分https链接)，点击上面的<b>提交按钮</b>后获得验证码（若无验证码请重新获取）</b><br>';


if(strlen($_POST['url']) >0){
$url=$_POST["url"];

echo "您输入的网址:<a href=\"{$url}\">{$url}</a>";
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_HEADER,1);
$content = curl_exec($ch);
curl_close($ch);
preg_match_all('/window.yunData = (.+?);/iu',$content,$kd);
$json = json_decode($kd[1][0],1);
$zh = curl_init("http://pan.baidu.com/share/download?bdstoken=null&web=5&app_id=250528&logid=MTQ4NzA2NzE5MDU0NzAuMDg2MzE0ODYwNzMxMzYzMw==&channel=chunlei&clienttype=5&uk={$json["uk"]}&shareid={$json["shareid"]}&fid_list=%5B{$json["file_list"][0]["fs_id"]}%5D&sign={$json["downloadsign"]}&timestamp={$json["timestamp"]}");
curl_setopt($zh,CURLOPT_USERAGENT,'Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba');
curl_setopt($zh,CURLOPT_RETURNTRANSFER,1);
$furljson = curl_exec($zh);
curl_close($zh);
$yzm=json_decode($furljson,1);
if($yzm["errno"] == -19){
echo '<br /><img src="'.$yzm["img"].'" width="300" height="90" />';
echo '<form action="bus.php?uk='.$json["uk"].'&shareid='.$json["shareid"].'&fid_list=%5B'.$json["file_list"][0]["fs_id"].'%5D&downloadsign='.$json["downloadsign"].'&timestamp='.$json["timestamp"].'&vcode='.$yzm["vcode"].'" method="post">请输入图中验证码: <input type="text" name="input"><br><input type="submit"></form><br><a href="./">继续获取</a>';}
else{echo "<br>请<a href=\"./\">重新输入</a>";}
echo '<br>Power by <a href="https://kdcloud.ml">KDWNIL</a>';
}else{
    echo '<form action="./" method="post">请输入网址: <input type="url" name="url"><br><input type="submit"></form>';

}
