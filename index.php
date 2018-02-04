<?php
ob_implicit_flush();
require(dirname(__FILE__).'/config.php');
require(dirname(__FILE__).'/ip/IP.class.php');
require(dirname(__FILE__).'/lib/scurl.php');
if(strlen($banlocation)>0){
    if($_GET['m']==error && $_GET['errno']==451){
    header("HTTP/1.1 451 Unavailable For Legal Reasons"); 
}
$userlocation=IP::find($_SERVER["HTTP_X_FORWARDED_FOR"])[0];
if(preg_match_all("/{$banlocation}/",$userlocation) && $_GET['m']!=='error' && $_GET['m']!=='avatar'){
    //header("HTTP/1.1 301 Moved Permanently");//301大坑货x2
	header('Location: ./?m=error&errno=451');
	die;//老子怂还不行吗
}
}
switch ($_GET["m"]) {
    case 'ip':
        echo json_encode(IP::find($_GET['ip']));
        break;
    case 'avatar';
    if(strlen($_COOKIE["bduss"])>0){
        require(dirname(__FILE__).'/lib/head.php');
        header("Content-type: image/webp charset=utf-8");
        echo file_get_contents(json_decode(scurl('http://top.baidu.com/user/pass','get','','BDUSS='.$_COOKIE['bduss'],'www.baidu.com',1,'',''),1)["avatarUrl"]);
    }else{
        header("Content-type: image/webp charset=utf-8");
        echo file_get_contents('./favicon.ico');
    }
        break;
    default:
        $bduss=$_COOKIE["bduss"];
        include(dirname(__FILE__).'/templates/ui.php');
        break;
}