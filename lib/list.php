<?php
function  showlistname ($path){
	$listname=strtok($path,"/");
	$a='[';
	while ($listname!==false){
		$a.="\"{$listname}\",";
		$listname=strtok("/");
	}
	$a.="\"\"]";//强行构造一个数组
	$b=json_decode($a,1);
	$aaa='';
	for ($x=0;
	$x<=count($b)-2;
	$x++){
		$aaa.= '<li><a href="./?m=list&order='.$_GET['order'].'&by='.$_GET['by'].'&page=1&path=';
		for ($y=0;
		$y<=$x;
		$y++){
			$aaa.= '/'.$b[$y];
		}
		$aaa.= '">'.$b[$x].'</a></li>';
	}
	return $aaa;
}
$list=$_GET['page'];
$bduss=urlencode($_COOKIE['bduss']);
$order=$_GET['order'];
$by=$_GET['by'];
if (strlen($_GET['path'])<=0){
	$path='%2F';
}else {
	$path=$_GET['path'];
}
if (strlen($list)<=0){
    echo '<meta http-equiv="Refresh" content="0;url=./?m=list&order='.$order.'&by='.$by.'&page=1&path=/">';
	$url='http://pcs.baidu.com/rest/2.0/pcs/file?path=/'.$path.'&method=list&app_id='.$appid.'&by=name&by='.$by.'&order='.$order.'&limit=0-10';
}
elseif ($list<=0){
	echo '<meta http-equiv="Refresh" content="0;url=./?m=list&order='.$order.'&by='.$by.'&page=1&path=/"><div class="col-md-8 col-md-offset-2" role="main"><div class="panel panel-default"><div class="panel-body"><p class="text-center">参数非法</p></div></div></div><br/>';
}else {
	$url='http://pcs.baidu.com/rest/2.0/pcs/file?path=/'.$path.'&method=list&app_id='.$appid.'&by=name&by='.$by.'&order='.$order.'&limit='.($list-1).'0-'.$list.'0';
}
$ch=curl_init($url);
curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
curl_setopt($ch,CURLOPT_RETURNTRANSFER ,1);
curl_setopt($ch,CURLOPT_COOKIE ,'BDUSS='.$bduss);
curl_setopt($ch,CURLOPT_REFERER ,'pcs.baidu.com');
$content=curl_exec($ch);
curl_close($ch);
if (json_decode($content,1)["error_code"]==31045){
	echo '<meta http-equiv="Refresh" content="2;url=./"><div class="col-md-8 col-md-offset-2" role="main"><div class="panel panel-default"><div class="panel-body"><p class="text-center">您还没有登录或文件不存在</p></div></div></div>';
}else {
	$b=json_decode($content,1);
	echo '<div class="col-md-12" role="main"><ol class="breadcrumb"><li><a href="./?m=list&order='.$order.'&by='.$by.'&page='.$list.'&path=/">根目录</a></li>'.showlistname(urldecode($path)).'</ol><center><div class="table-responsive"><table  class="table table-hover table-striped table-condensed table-responsive" ><th class="mdl-data-table__cell--non-numeric"  style="width:5%">类型</th><th class="mdl-data-table__cell--non-numeric ">文件名称</th><th class="mdl-data-table__cell--non-numeric"  style="width:9%">下载1</th><th class="mdl-data-table__cell--non-numeric"  style="width:9%">下载2</th>';
	for ($x=0;
	$x<=count($b["list"])-1;
	$x++){
		if ($b["list"][$x]["isdir"]==1){
			echo '<tr><td class="mdl-data-table__cell--non-numeric">文件夹</td><td class="mdl-data-table__cell--non-numeric"><a href="./?m=list&by='.$by.'&order='.$order.'&path='.urlencode($b["list"][$x]["path"]).'&page=1">'.$b["list"][$x]["server_filename"].'</a></td><td class="mdl-data-table__cell--non-numeric"></td><td class="mdl-data-table__cell--non-numeric"></td></tr>';
		}else {
			echo '<tr><td class="mdl-data-table__cell--non-numeric">文件</td><td class="mdl-data-table__cell--non-numeric">'.$b["list"][$x]["server_filename"].'</td><td class="mdl-data-table__cell--non-numeric"><a href="./?m=car&path='.urlencode($b["list"][$x]["path"]).'"target="_blank">获取高速连接1</a></td><td class="mdl-data-table__cell--non-numeric"><a href="./?m=suv&path='.urlencode($b["list"][$x]["path"]).'"target="_blank">获取高速链接2</a></td></tr>';
		}
	}
}
echo '</table></div></center></div><br><br><nav aria-label="..."><ul class="pager">';
if ($list>1){
	echo '<li class="previous"><a href="./?m=list&by='.$by.'&order='.$order.'&path='.urlencode($path).'&page='.($list-1).'"><span aria-hidden="true">&larr;</span> 上一页 </a></li>';
}
if (count($b["list"])>=10){
	echo '<li class="next"><a href="./?m=list&by='.$by.'&order='.$order.'&path='.urlencode($path).'&page='.($list+1).'"> 下一页 <span aria-hidden="true">&rarr;</span></a></li></ul></nav>';
}
echo '</div>';