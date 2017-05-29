<?php
require('./config.php');
function quota(){
    $bduss=urlencode($_COOKIE['bduss']);
	$baiduid=$_COOKIE['baiduid'];
	$ch=curl_init('https://pcs.baidu.com/rest/2.0/pcs/quota?method=info&app_id='.$GLOBALS['appid']);
	curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER ,1);
	curl_setopt($ch,CURLOPT_COOKIE ,'BDUSS='.$bduss);
	curl_setopt($ch,CURLOPT_REFERER ,'pcs.baidu.com');
	$content=curl_exec($ch);
	curl_close($ch);
	$a= json_decode($content,1);
return '<li><div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'.$a["used"].'" aria-valuemin="0" aria-valuemax="'.$a["quota"].'" style="min-width: 2em; width: '.(($a["used"]/$a["quota"])*100).'%;">'.ceil(($a["used"]/$a["quota"]*100)).'%</div></div><li role="separator" class="divider"></li><li><center>'.ceil($a["used"]/1073741824).'GB/'.ceil($a["quota"]/1073741824).'GB</center></li></li>';
}
	