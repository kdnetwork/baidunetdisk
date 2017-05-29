<?php
require './config.php';
header("Content-type: text/html; charset=utf-8");
ignore_user_abort(true);
echo '<meta name="viewport" content="width=device-width,maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">';
if (strlen($_POST['bduss'])<=0){
	$bduss=$_COOKIE['bduss'];
}else {
	$bduss=$_POST["bduss"];
}
if (strlen($_POST['path'])<=0){
	$path=urlencode($_GET['path']);
}else {
	$path=urlencode($_POST['path']);
}
if (strlen($path)<=0){
	echo '<meta http-equiv="Refresh" content="0;url=./">';
	echo '参数非法';
}else {
	if (strlen($bduss)>0){
		$url='https://d.pcs.baidu.com/rest/2.0/pcs/share?method=create&type=public&path=/'.$path.'&app_id='.$appid;
		$ch=curl_init($url);
		curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER ,1);
		curl_setopt($ch,CURLOPT_COOKIE ,'BDUSS='.$bduss);
		curl_setopt($ch,CURLOPT_REFERER ,'pcs.baidu.com');
		$content=curl_exec($ch);
		curl_close($ch);
		if (strlen(json_decode($content,1)["list"][0])>0){
			if ($_GET['type']==pic ){
				echo '<center><img src="'.json_decode($content,1)["list"][0].'"/></center>';
			}
			elseif ($_GET['type']==video ){
				echo '<center><div class="embed-responsive embed-responsive-16by9"><video src="'.json_decode($content,1)["list"][0].'" controls="controls"></video></div></center>';
			}else {
				if (substr(urldecode($path),'-4')=='.mp4'){
					echo '<div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 检测到支持的视频格式，点击<strong><a href="./?m=car&path='.$path.'&type=video" class="alert-link">这里</a></strong>可在线播放 </div>';
				}
				$slink=file_get_contents($siteurl.'/s.php?type=1&url='.base64_encode(json_decode($content,1)["list"][0]));
				echo '<div class="col-md-12" role="main"><div class="panel panel-default"><div class="panel-body">直链地址:'."\n <a href=\"".json_decode($content,1)["list"][0]."\">".json_decode($content,1)["list"][0]."</a>";
				echo '<br><img src="'.$slink.'"></div></div>';
				echo '<br /><div class="btn-group" role="group" aria-label="..."><a href="'.json_decode($content,1)["list"][0].'" text-decoration="none"><button type="button" class="btn btn-default">直链下载</button></a><a href="./" text-decoration="none"><button type="button" class="btn btn-default">继续获取</button></a></div>';
			}
		}else {
			echo '<meta http-equiv="Refresh" content="2;url=./">查无此文件,请检查您的账号信息及数据存储路径';
		}
	}else {
		echo '<meta http-equiv="Refresh" content="5;url=./">';
		echo '找不到bduss,请尝试重新登录,5秒后回到<a href="./">主页</a>';
	}
}