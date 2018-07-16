<?php
/*head*/
echo '<!DOCTYPE html>';
echo '<html lang="zh-CN">';
echo '<head>';
echo '<meta charset="utf-8">';
echo '<meta name="theme-color" content="#f8f9fa">';
echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
echo '<link rel="icon shortcut" type="image/ico" href="./favicon.ico">';
echo '<link rel="icon" href="./favicon.ico">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
echo '<meta name="author" content="KDNETWORK(https://github.com/kdnetwork)" />';
echo '<meta name="description" content="'.$seo_info["description"].'" />';
echo '<meta name="keywords" content="'.$seo_info["keywords"].'" />';
echo '<title>'.$seo_info["title"].'_' . $show_page_info[$mode][$language.'_name'] . '</title>';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">';
echo '';
/*链接修正*/
echo '<style type="text/css">';
echo 'a:link{';
echo '	text-decoration:none;';
echo '	word-break:break-all;';
echo '}';
echo 'a:visited{';
echo '	text-decoration:none;';
echo '	word-break:break-all;';
echo '}';
echo 'a:hover{';
echo '	text-decoration:none;';
echo '	word-break:break-all;';
echo '}';
echo 'a:active{';
echo '	text-decoration:none;';
echo '	word-break:break-all;';
echo '}';
echo '</style>';
echo '</head>';
echo '<body>';
/*nav*/
echo '<nav class="navbar navbar-expand-lg navbar-light bg-ligh"><a class="navbar-brand" href="./">'.$seo_info["title"].'</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button><div class="collapse navbar-collapse" id="navbarNavDropdown"><ul class="navbar-nav">';
$isloginn=is_login(@$_COOKIE["bduss"],@$_REQUEST["bduss"]);
if($isloginn){
	foreach(array_keys($show_page_info) as $key){
		if($key!="login" && $key!="admin" && $key!="logout"){
			echo '<li class="nav-item';
			if($mode==$key){
				echo ' active';
			}
			echo '"><a class="nav-link" href="./?m='.$key.'">'.$show_page_info[$key][$language.'_name'].' </a></li>';
		}
	}
	if(is_admin(@$_COOKIE["bduss"],$admin_id)){
		echo '<li class="nav-item"><a class="nav-link" href="./?m=admin">'.$show_page_info["admin"][$language.'_name'].' </a></li>';
	}
}
elseif($mode=="login"){
	echo '<li class="nav-item"><a class="nav-link" href="./?m=home">'.$show_page_info["home"][$language.'_name'].' </a></li><li class="nav-item active"><a class="nav-link" href="./?m=login">'.$show_page_info["login"][$language.'_name'].' </a></li>';
}
else{
	echo '<li class="nav-item active"><a class="nav-link" href="./?m=home">'.$show_page_info["home"][$language.'_name'].' </a></li><li class="nav-item"><a class="nav-link" href="./?m=login">'.$show_page_info["login"][$language.'_name'].' </a></li>';
}
echo '    </ul>  </div></nav>';
/*body*/
if($mode!='' && file_exists(SYSTEM_ROOT.'/templates/'.$mode.'.php')){
	include(SYSTEM_ROOT.'/templates/'.$mode.'.php');
}
else{
	include(SYSTEM_ROOT.'/templates/home.php');
}
echo '<div align="center">';
if(file_exists(SYSTEM_ROOT.'/templates/about.php')){
	echo ' · <a href="./?m=about". target="_blank">' . $translate["about"] . '</a>';
}
elseif(file_exists(SYSTEM_ROOT.'/about.html')){
	echo ' · <a href="./about.html". target="_blank">' . $translate["about"] . '</a>';
}
if(file_exists(SYSTEM_ROOT.'/templates/status.php')){
	echo ' · <a href="./?m=status". target="_blank">' . $translate["status"] . '</a>';
}
if($isloginn){
	echo ' · <a href="./?m=logout">'.$show_page_info["logout"][$language.'_name'].' </a> · ';
}
echo '</div>';
echo '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>';
if($mode=='login' && $secret!==''){
	echo '<script src="https://www.recaptcha.net/recaptcha/api.js"></script>';
}
echo '</body>';
echo '</html>';
