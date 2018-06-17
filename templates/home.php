<?php
if(is_login(@$_COOKIE["bduss"],@$_REQUEST["bduss"])){
	echo '<div class="col-md-10 offset-md-1"><div class="card border-info mb-3"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["tips_home"].'<!--<br /><a href="./wap?fr=new">wap版入口</a>--></p></div></div>' . quota($appid,$_COOKIE["bduss"]) . '<br><form action="./?m=getlink" method="post"><input type="hidden" name="l" value="pcs"/><div class="input-group mb-3"><input type="text" class="form-control" placeholder="'. $translate["path"].'" name="path" id="input"><div class="input-group-append"><button class="btn btn-primary" type="submit">'. $translate["go"].'</button></div></div></form></div>';
}
else{
	include(SYSTEM_ROOT.'/templates/getlink.php');
}