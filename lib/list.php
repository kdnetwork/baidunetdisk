<?php
require './config.php';
header("Content-type: text/html; charset=utf-8");
ignore_user_abort(true);
$list=$_GET['page'];
$bduss=urlencode($_COOKIE['bduss']);
//echo '<title>文件列表</title>';
//echo '<meta name="viewport" content="width=device-width,maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">';
if(strlen($_GET['path']) <= 0){
  $path='%2F';
}else{$path=$_GET['path'];}
if(strlen($list) <=0){
 echo '<meta http-equiv="Refresh" content="2;url=./?m=list&path='.$path.'&page=1">';
//$list=1
$url='http://pcs.baidu.com/rest/2.0/pcs/file?path=/'.$path.'&method=list&app_id='.$appid.'&by=name&order=asc&limit=0-10';}
elseif($list<=0){echo'<meta http-equiv="Refresh" content="0;url=./?m=list">参数非法<br/>';}
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
    echo '<meta http-equiv="Refresh" content="2;url=./">您还没有登录或文件不存在';
}else{
$b=json_decode($content,1);
echo '<div class="col-md-12" role="main"><ol class="breadcrumb"><li><a href="'.$siteurl.'?m=list&path='.$path.'&page=1">根目录'.urldecode($path).'</a></li>
</ol><center><div class="table-responsive"><table  class="table table-hover table-striped table-condensed table-responsive" border="1"><th class="mdl-data-table__cell--non-numeric">类型</th><th class="mdl-data-table__cell--non-numeric">文件名称</th><th class="mdl-data-table__cell--non-numeric">下载1</th>';
$x=0;
do{
if($b["list"][$x]["isdir"] == 1){echo '<tr><td class="mdl-data-table__cell--non-numeric">文件夹</td><td class="mdl-data-table__cell--non-numeric"><a href="./?m=list&path='.urlencode($b["list"][$x]["path"]).'&page=1">'.$b["list"][$x]["server_filename"].'</a></td><td class="mdl-data-table__cell--non-numeric"></td></tr>';
}else{echo '<tr><td class="mdl-data-table__cell--non-numeric">文件</td><td class="mdl-data-table__cell--non-numeric">'.$b["list"][$x]["server_filename"].'</td><td class="mdl-data-table__cell--non-numeric"><a href="./?m=suv&path='.urlencode($b["list"][$x]["path"]).'"target="_blank">获取高速链接</a></td></tr>';}
    $x++;
}while ($x <= count($b["list"])-1);

}
echo '</table></div></center></div><br><br><nav aria-label="..."><ul class="pager">';
if($list == 1){echo'';
}else{echo '<li class="previous"><a href="./?m=list&path='.urlencode($path).'&page='.($list-1).'"><span aria-hidden="true">&larr;</span> 上一页 </a></li>';}
//if(urldecode($path) == '/'){
    echo '';
//}else{echo '<center><li><a href="'.$_SERVER['HTTP_REFERER'].'">上一目录</a></li></center>';}
if(count($b["list"]) < 10){echo'';
}else{echo '<li class="next"><a href="./?m=list&path='.urlencode($path).'&page='.($list+1).'"> 下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav>';}
echo '</div>';