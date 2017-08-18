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
}else {
	$gtt=base64_decode($_GET["surl"]);
	header('Location: '.$gtt);
}