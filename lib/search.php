<?php
$wd=$_GET["wd"];

    echo "<div class=\"col-md-8 col-md-offset-2\" role=\"main\">
            <center><h1>Mi<span style=\"color:#F00\">x</span> Search α </h1>For K<span style=\"color:#F00\">D</span>Cloud</center><br>  
            <form action=\"./\" method=\"get\">
            <div class=\"input-group input-group-lg\">  
            
            <input id=\"in\" type=\"text\" value=\"{$wd}\"class=\"form-control\" name=\"wd\" aria-describedby=\"sizing-addon1\"><span class=\"input-group-btn\">                    <button class=\"btn btn-default\">                        <span class=\"glyphicon glyphicon-search\"></span>               </button>                </span>        </div></div><input type=\"hidden\" name=\"m\" value=\"search\"></form>";
if(strlen($wd)>0){
    $bduss=$_COOKIE['bduss'];
require './config.php';
header("Content-type: text/html; charset=utf-8");
ignore_user_abort(true);
$url='https://pcs.baidu.com/rest/2.0/pcs/file?method=search&app_id='.$appid.'&path=%2F&wd='.$wd.'&re=1';
$ch=curl_init($url);
curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
curl_setopt($ch,CURLOPT_RETURNTRANSFER ,1);
curl_setopt($ch,CURLOPT_COOKIE ,'BDUSS='.$bduss);
curl_setopt($ch,CURLOPT_REFERER ,'pan.baidu.com');
$content=curl_exec($ch);
curl_close($ch);
//echo $content;
$a=json_decode($content,1);
if (count($a["list"])>0){
	echo '<div class="col-md-8 col-md-offset-2" role="main"><center><div class="table-responsive"><table  class="table table-hover table-striped table-condensed table-responsive" ><th class="mdl-data-table__cell--non-numeric"  style="width:5%">类型</th><th class="mdl-data-table__cell--non-numeric ">文件名称</th><th class="mdl-data-table__cell--non-numeric"  style="width:9%">下载1</th><th class="mdl-data-table__cell--non-numeric"  style="width:9%">下载2</th>';
	for ($x=0;
	$x<=count($a["list"])-1;
	$x++){
		if ($a["list"][$x]["isdir"]==1){
			echo '<tr><td class="mdl-data-table__cell--non-numeric">文件夹</td><td class="mdl-data-table__cell--non-numeric"><a href="./?m=list&by='.$ay.'&order='.$order.'&path='.urlencode($a["list"][$x]["path"]).'&page=1">'.$a["list"][$x]["server_filename"].'</a></td><td class="mdl-data-table__cell--non-numeric"></td><td class="mdl-data-table__cell--non-numeric"></td></tr>';
		}else {
			echo '<tr><td class="mdl-data-table__cell--non-numeric">文件</td><td class="mdl-data-table__cell--non-numeric">'.$a["list"][$x]["server_filename"].'</td><td class="mdl-data-table__cell--non-numeric"><a href="./?m=car&path='.urlencode($a["list"][$x]["path"]).'"target="_blank">获取高速连接1</a></td><td class="mdl-data-table__cell--non-numeric"><a href="./?m=suv&path='.urlencode($a["list"][$x]["path"]).'"target="_blank">获取高速链接2</a></td></tr>';
		}
	}
	echo '</table></div></center></div>';
}else {
	echo '<div class="col-md-8 col-md-offset-2" role="main"><div class="panel panel-default"><div class="panel-body"><p class="text-center">无结果~</p></div></div></div>';
}
}
