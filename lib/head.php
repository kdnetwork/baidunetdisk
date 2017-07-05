<?php
function  head ($bduss){
	$ch=curl_init('http://top.baidu.com/user/pass');
	curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER ,1);
	curl_setopt($ch,CURLOPT_COOKIE ,'BDUSS='.$bduss);
	curl_setopt($ch,CURLOPT_REFERER ,'www.baidu.com');
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}
header("Content-type: image/webp charset=utf-8");
echo file_get_contents(json_decode(head($_COOKIE['bduss']),1)["avatarUrl"]);