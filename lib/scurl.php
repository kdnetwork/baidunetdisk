<?php
function scurl($url,$type,$data,$cookie,$referer,$user_agent,$timeout,$header=false,$followlocation=false,$connecttimeout=false,$nobody=false,$curlfile=null){
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	switch($user_agent){
		case 1:
			curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; Android 5.1.1; Nexus 6 Build/LYZ28E) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Mobile Safari/537.36');
		break;
		case 2:
			curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1');
		break;
		case 3:
			curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36');
		break;
		default:
			curl_setopt($ch,CURLOPT_USERAGENT,$user_agent);
		break;
	}
	switch($type){
		case "post":
			$curltype='post';
		break;
		default:
			$curltype='get';
		break;
	}
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	if($cookie!=""){
		curl_setopt($ch,CURLOPT_COOKIE,$cookie);
	}
	if($referer!=""){
		curl_setopt($ch,CURLOPT_REFERER,$referer);
	}
	if($curltype="post"){
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	}
	if($timeout!=""){
		curl_setopt($ch,CURLOPT_TIMEOUT,$timeout);
	}
	if($header!=false){
		curl_setopt($ch,CURLOPT_HEADER,true);
	}
	if($followlocation=true){
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
	}
	if($connecttimeout!=false){
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$connecttimeout);
	}
	if($nobody==true){
		curl_setopt($ch,CURLOPT_NOBODY,1);
	}
	if($curlfile != null){
	    curl_setopt($ch,CURLOPT_FILE,$curlfile);
	}
	//if($httpheader!=false){
	//	curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
	//}
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}