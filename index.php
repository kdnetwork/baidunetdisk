<?php
ob_implicit_flush();
$mode=@$_GET["m"];
if($mode==""){
	$mode='home';
}
require(dirname(__FILE__).'/init.php');
switch($mode){
	case 'avatar';
		if(is_login(@$_COOKIE["bduss"],'')){
			header("Content-type: image/webp charset=utf-8");
			echo file_get_contents(json_decode(scurl('http://top.baidu.com/user/pass','get','','BDUSS='.$_COOKIE['bduss'],'www.baidu.com',1,'',''),true)["avatarUrl"]);
		}
		else{
			header("Content-type: image/webp charset=utf-8");
			echo file_get_contents(SYSTEM_ROOT.'/favicon.ico');
		}
		break;
	case 'api':
	    break;
	default:
		/*load templates*/
		include(SYSTEM_ROOT.'/templates/ui.php');
	break;
}
