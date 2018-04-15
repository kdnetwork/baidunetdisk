<?php
ob_implicit_flush();
require(dirname(__FILE__).'/config.php');
require(dirname(__FILE__).'/lib/scurl.php');
require(dirname(__FILE__).'/lib/head.php');
require(dirname(__FILE__).'/lib/quota.php');
switch($_GET["m"]){
	case "info":
		if(strlen($_COOKIE["bduss"])>0){
			if(preg_match('/'.$admin_id.'/',json_decode(head($_COOKIE["bduss"]),1)["un"])){
				$role='<a href="./?m=admin"><span class="label label-success">admin</span></a>';
			}
			else{
				$role='<span class="label label-info">user</span>';
			}
			echo '<center><img src="./?m=avatar" class="img-circle"><li role="separator" class="divider"></li>'.$role.'<li role="separator" class="divider"></li>'.quota($_COOKIE["bduss"]).'<li role="separator" class="divider"></li><li class="active"><a href="./logout.php">退出</a></li></center>';
		}
	break;
	case 'avatar';
		if(strlen(@$_COOKIE["bduss"])>0){
			header("Content-type: image/webp charset=utf-8");
			echo file_get_contents(json_decode(scurl('http://top.baidu.com/user/pass','get','','BDUSS='.$_COOKIE['bduss'],'www.baidu.com',1,'',''),1)["avatarUrl"]);
		}
		else{
			header("Content-type: image/webp charset=utf-8");
			echo file_get_contents(dirname(__FILE__).'/favicon.ico');
		}
	break;
	default:
		$bduss=@$_COOKIE["bduss"];
		include(dirname(__FILE__).'/templates/ui.php');
	}