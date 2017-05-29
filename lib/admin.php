<?php
require('./config.php');
$bduss=$_COOKIE["bduss"];
$zh=curl_init('https://www.baidu.com');
curl_setopt($zh,CURLOPT_USERAGENT ,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
curl_setopt($zh,CURLOPT_RETURNTRANSFER ,1);
curl_setopt($zh,CURLOPT_COOKIE ,'BDUSS='.$bduss);
$namehhh=curl_exec($zh);
curl_close($zh);
preg_match("/<span class=user-name>(.+?)<\/span>/u",$namehhh,$kdpicname);
$username=$kdpicname[1];
if ($_COOKIE["baiduid"]==$username && preg_match("/{$admin_id}/",$_COOKIE["baiduid"])){
	$update_check=json_decode(file_get_contents('https://raw.githubusercontent.com/kdwnil/baidunetdisk/git-page/README.md'),1);
	if (str_replace('.','',$update_check["version"])<=str_replace('.','',$version)){
		echo '无更新';
	}else {
		echo "检测到更新\n版本:{$update_check["version "]}\n更新说明:{$update_check["info "]}";
	}
	echo 'hh';
}else {
	echo 'ban';
}