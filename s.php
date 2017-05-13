<?php
require dirname(__FILE__).'/config.php';
function s_url(){
    $text= '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $s_u=substr(str_shuffle($text),0,6);
    return $s_u;
}
if($_GET["type"] == 1){
if(strlen($_GET["url"])>0){
$geturl=base64_decode($_GET["url"]);
}else{$geturl=base64_decode($_POST["url"]);
}
if(strlen($geturl)<=0){
echo '参数非法';
}else{
$t='k'.s_url();
$fp = fopen('./surl_data/data.php',"a");
    flock($fp,LOCK_EX);
    fwrite($fp,'$'.$t.' = "'.$geturl.'";'."\r\n");
    fclose($fp,LOCK_UN);
echo $siteurl.'/s.php?surl='.$t;
}
}else{
$gtt = $_GET["surl"];
require dirname(__FILE__).'/surl_data/data.php';
header('Location: '.${$gtt});
}