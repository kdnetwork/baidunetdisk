<?php
header("Content-type: text/html; charset=utf-8");
ignore_user_abort(true);
if(strlen($_POST['bduss']) <=0){
$bduss=$_COOKIE['bduss'];}
else{$bduss=$_POST["bduss"];}
if(strlen($_POST["dl_url"])>0){
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
echo "<meta http-equiv=\"Refresh\" content=\"5;url=./?m=dl\">添加成功!";
}else{echo "<meta http-equiv=\"Refresh\" content=\"5;url=./?m=dl&error=false\">添加失败!请检查您的链接";}
}else{
$dl_l="https://pan.baidu.com/rest/2.0/services/cloud_dl?need_task_info=1&status=255&start=0&limit=20&method=list_task&app_id=250528&channel=chunlei&web=1&app_id=250528&bdstoken=null&logid=MTQ4ODA4NjIxOTE4NzAuOTY2MDcxNzQ1NjY0ODAxOA==&clienttype=0";
$zh = curl_init($dl_l);
curl_setopt($zh,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
curl_setopt($zh,CURLOPT_RETURNTRANSFER,1);
curl_setopt($zh,CURLOPT_COOKIE,'BDUSS='.$bduss);
curl_setopt($zh, CURLOPT_REFERER,'pan.baidu.com');
$dl_link = curl_exec($zh);
curl_close($zh);
$b=json_decode($dl_link,1);
//echo $_GET["error"];
//if($_GET["error"] == false){echo '获取失败，请检查您的链接是否无法使用或者属于违法违规链接';}else{echo '';}
echo "<div class=\"col-md-12\" role=\"main\"><div class=\"table-responsive\"><table class=\"table table-hover table-striped table-condensed table-responsive mdl-data-table mdl-js-data-table mdl-shadow--2dp\" border=\"1\"><th class=\"mdl-data-table__cell--non-numeric\">任务</th><th class=\"mdl-data-table__cell--non-numeric\">文件名称</th><th class=\"mdl-data-table__cell--non-numeric\">离线路径</th>";
$x=0;
do{
echo "<tr><td class=\"mdl-data-table__cell--non-numeric\">任务".($x+1)."</td><td class=\"mdl-data-table__cell--non-numeric\">{$b["task_info"][$x]["task_name"]}</td><td class=\"mdl-data-table__cell--non-numeric\">";
if($b["task_info"][$x]["od_type"] ==2){echo "<a href=\"./?m=list&path={$b["task_info"][$x]["save_path"]}\">{$b["task_info"][$x]["save_path"]}</a></td></tr>";}else{echo "<a href=\"./?m=suv&path={$b["task_info"][$x]["save_path"]}\">{$b["task_info"][$x]["save_path"]}</a></td></tr>";}
    $x++;
}while ($x <= $b["total"]-1);
echo '</table></div><div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">说明</h3></div><div class="panel-body">本次离线下载将保存到"我的资源"文件夹(链接支持http/https/ftp/电驴/磁力链协议)</div></div><center><form action="./?m=dl" method="post"><div class="input-group"><input type="url" placeholder="请输入链接地址..." class="form-control" name="dl_url" aria-describedby="sizing-addon1"><span class="input-group-btn"><button class="btn btn-default" type="submit">提交</button></span></div></div></form></center>';
}
if(strlen($bduss) > 0){
}else{echo '<meta http-equiv="Refresh" content="5;url=/">';
echo '找不到bduss,请尝试重新登录,5秒后回到<a href="/">主页</a>';}