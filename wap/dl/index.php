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
$dl_l="https://pan.baidu.com/rest/2.0/services/cloud_dl?need_task_info=1&status=255&start=0&limit=20&method=list_task&app_id=250528&channel=chunlei&web=1&app_id=250528&bdstoken=null&logid=MTQ4ODA4NjIxOTE4NzAuOTY2MDcxNzQ1NjY0ODAxOA==&clienttype=0";
$zh = curl_init($dl_l);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
curl_setopt($zh,CURLOPT_RETURNTRANSFER,1);
curl_setopt($zh,CURLOPT_COOKIE,'BDUSS='.$bduss);
curl_setopt($zh, CURLOPT_REFERER,'pan.baidu.com');
$dl_link = curl_exec($zh);
curl_close($zh);
$b=json_decode($dl_link,1);
echo "已存在的离线任务(显示最后的20个)<br><br>";
$x=0;
do{
echo "任务".($x+1).":<b>文件名称</b>:{$b["task_info"][$x]["task_name"]} <b>文件地址</b>:";
if($b["task_info"][$x]["status"] ==10){echo "<a href=\"../list.php?path={$b["task_info"][$x]["save_path"]}\">{$b["task_info"][$x]["save_path"]}</a><br>";}else{echo "<a href=\"../car.php?path={$b["task_info"][$x]["save_path"]}\">{$b["task_info"][$x]["save_path"]}</a><br>";}
    $x++;
}while ($x <= $b["total"]-1);


echo '<br>本次离线下载将保存到"我的资源"文件夹<br>';
echo '<form action="./dl.php" method="post">请输入链接地址:<input type="url" name="dl_url"><br><input type="submit"></form>';
if(strlen($bduss) > 0){
}else{echo '<meta http-equiv="Refresh" content="5;url=./">';
echo '找不到bduss,请尝试重新登录,5秒后回到<a href="./">主页</a>';}
echo '<meta name="keywords" content="百度网盘,KDWNIL," />';
echo '<br><a href="../">回到主页</a> <a href="../logout.php">退出</a><br />Power by KDWNIL<br/>getbduss service power by <a href="https://bduss.tbsign.cn">简云</a>';
