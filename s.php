<?php
if ($chinamode==1){
	echo 'undo';
	die ;
}
require dirname(__FILE__).'/config.php';
function  qrcode (){
	$geturl=$GLOBALS["siteurl"].'/s.php?surl='.$_GET["url"];
	header("Content-type: text/html; charset=utf-8");
	$img=file_get_contents('https://chart.googleapis.com/chart?cht=qr&chs=100x100&choe=UTF-8&chl='.$geturl);
	echo 'data:image/png;base64,'.base64_encode($img);
}
if ($_GET["type"]==1){
	qrcode ();
	/*
	    echo '短链接已停用';
	    die;
	if(strlen($_GET["url"])>0){
	$geturl=base64_decode($_GET["url"]);
	}else{$geturl=base64_decode($_POST["url"]);}
	if(strlen($geturl)<=0){
	echo '参数非法';
	}else{
	$t='k'.s_url();
	$fp = fopen('./surl_data/data.php',"a");
	    flock($fp,LOCK_EX);
	    fwrite($fp,'$'.$t.' = "'.$geturl.'";'."\r\n");
	    fclose($fp,LOCK_UN);
	echo $siteurl.'/s/'.$t;
	}*/
}else {
	$gtt=base64_decode($_GET["surl"]);
	//require dirname(__FILE__).'/surl_data/data.php';
	//header("HTTP/1.1 301 Moved Permanently");
	header('Location: '.$gtt);
}