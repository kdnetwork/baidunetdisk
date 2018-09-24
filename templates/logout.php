<?php
if(is_login(@$_COOKIE["bduss"],'')){
	//$lo=curl_init('https://wappass.baidu.com/passport/?logout');
	//curl_setopt($lo,CURLOPT_COOKIE,'BDUSS='.$_COOKIE['bduss']);
	//curl_setopt($lo,CURLOPT_RETURNTRANSFER,1);
	//$kkk = curl_exec($lo);
	//curl_close($lo);
	setcookie('bduss','',time()-9999,'/',$_SERVER['HTTP_HOST']);
	//setcookie('stoken','',time()-9999,'/',$_SERVER['HTTP_HOST']);
	//setcookie('baiduid','',time()-9999,'/',$_SERVER['HTTP_HOST']);
	echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-info"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["logouting"].'</p></div></div></div>';
	
}
else{
	echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["nologin"].'</p></div></div></div>';
}
