<?php
function  scurl ($url,$type,$data,$cookie,$referer,$user_agent,$timeout,$header){
	$ch=curl_init($url);
	switch($user_agent){
	    case 1:
	        curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/5.0 (Linux; Android 5.1.1; Nexus 6 Build/LYZ28E) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Mobile Safari/537.36');
	        break;
	    case 2:
	        curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1');
	        break;
	    case 3:
	        curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36');
	        break;
	    default:
	        curl_setopt($ch,CURLOPT_USERAGENT ,$user_agent);
	        break;
	}
	switch(type){
	    case "get":
	        $curltype='get';
	        break;
	    case "post":
	        $curltype='post';
	        break;
	}
	curl_setopt($ch,CURLOPT_RETURNTRANSFER ,1);
	if(strlen($cookie)>0){
	    curl_setopt($ch,CURLOPT_COOKIE ,$cookie);
	}
	if(strlen($referer)>0){
	    curl_setopt($ch, CURLOPT_REFERER,$referer);
	}
	if ($curltype=1){
		curl_setopt($ch,CURLOPT_POST ,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS ,$data);
	}
	if(strlen($timeout)>0){
	    curl_setopt($ch, CURLOPT_TIMEOUT,$timeout); 
	}
	if(strlen($header)>0){
	    curl_setopt($ch,CURLOPT_HTTPHEADER ,1);
	}
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}