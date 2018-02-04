<?php
require './config.php';
ignore_user_abort(true);
if (strlen($_POST['bduss'])<=0){
	$bduss=$_COOKIE['bduss'];
}else {
	$bduss=$_POST["bduss"];
}
$path=urlencode($_REQUEST['path']);
if (strlen($path)<=0){
	echo '<meta http-equiv="Refresh" content="0;url=./?posturl=suv">';
	echo '<div class="col-md-8 col-md-offset-2" role="main"><div class="panel panel-default"><div class="panel-body"><p class="text-center">参数非法</p></div></div></div>';
}else {
	if (strlen($bduss)>0){
	    echo '<div class="col-md-8 col-md-offset-2" role="main"><form action="./" method="get"><div class="input-group"><span class="input-group-addon" id="basic-addon3">/</span><input value="'.urldecode($path).'" type="text" placeholder="文件路径..." class="form-control" name="path" aria-describedby="sizing-addon1"><input type="hidden" name="m" value="suv"/><span class="input-group-btn"><button class="btn btn-default" type="submit">点击获取直链</button></span></div></div></form></div>';
		echo '<div class="col-md-8 col-md-offset-2" role="main"><b>请尽量少用本功能，本功能可能导致您的百度账号进入黑名单导致今后10kb/s的下载速度</b>下载本页解析的链接请将user-agent更改为“netdisk;7.8.1;Red;android-android;4.3”<br>';
		$url='https://d.pcs.baidu.com/rest/2.0/pcs/file?method=locatedownload&app_id=250528&ver=2.0&dtype=0&esl=1&ehps=0&check_blue=1&clienttype=1&path=/'.$path.'&logid=MTQ4Nzg2MTc5NjcyNTAuMzAzMjk0NDAxODQyNzQ0OQ==';
		$ch=curl_init($url);
    curl_setopt($ch,CURLOPT_USERAGENT ,'netdisk;7.8.1;Red;android-android;4.3');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER ,1);
		curl_setopt($ch,CURLOPT_COOKIE ,'BDUSS='.$bduss);
		$content=curl_exec($ch);
		curl_close($ch);
		//echo $content;
		//echo count($json["urls"]);
		$json=json_decode($content,1);
		$x=0;
		do {
			$href=$json["urls"][$x]["url"];
			//$slink=file_get_contents($siteurl.'/s.php?type=1&url='.base64_encode($href));
			echo '<div class="panel panel-default"><div class="panel-body">直链地址'.($x+1).':<a href="'.$href.'">'.$href.'</a><br /></div></div>';
			$x++;
		}
		while ($x<=count($json["urls"])-1);
	}else {
		echo '<meta http-equiv="Refresh" content="5;url=./?posturl=suv">';
		echo '<div class="col-md-8 col-md-offset-2" role="main"><div class="panel panel-default"><div class="panel-body"><p class="text-center">找不到bduss,请尝试重新登录,5秒后回到<a href="./?posturl=suv">主页</a></p></div></div></div>';
	}
}