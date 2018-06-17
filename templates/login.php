<?php
if($_REQUEST["bduss"] == "" && $_COOKIE["bduss"] == ""){
   echo '<div class="col-md-10 offset-md-1"><div class="card"><div class="card-body"><form action="//'.$seo_info["site_url"].'/" method="get"><input type="hidden" name="m" value="login"><div class="input-group"><textarea class="form-control" rows="9" cols="9999" placeholder="'. $translate["your_bduss"].'" name="bduss"></textarea><span class="input-group-btn"></div><br><div class="checkbox"><label><input type="checkbox" name="rm" value= true>'. $translate["remenber_me"].'</label>';
	if( $secret!=''){
		echo '<div class="g-recaptcha" data-sitekey="'.$data_sitekey.'"></div>';
	}
echo '</div><button class="btn btn-primary" type="submit">'. $translate["button_for_login"].'</button></span></div></form></div></div></div></div><div class="col-md-10 offset-md-1"><div class="card border-primary mb-3"><div class="card-header"><h5 class="card-title">'. $translate["tips"].'</h5></div><div class="card-body">'. $translate["how_to_get_bduss"].':<br>简云<a href="https://bduss.tbsign.cn/">https://bduss.tbsign.cn</a><br>imyfan贴吧云签<a href="https://tool.imyfan.com">https://tool.imyfan.com</a><br><br></div></div></div>';
 
}elseif (isset($_COOKIE["bduss"])) {
    echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["been_login"].'</p></div></div></div>';
}
else {
	if($secret!=''){
		$captchaback=json_decode(scurl('https://www.recaptcha.net/recaptcha/api/siteverify','post','secret='.$secret.'&response='.@$_GET["g-recaptcha-response"].'&remoteip=','','',3,'',''),true);
		if($captchaback["success"] == false){
			echo '<meta http-equiv="Refresh" content="5;url=//'.$seo_info["site_url"].'/?m=login"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["captcha_error"].'</p></div></div></div>';
			die ;
		}
	}
	//$check_login=json_decode(scurl('http://tieba.baidu.com/dc/common/tbs','get','','BDUSS='.$_REQUEST['bduss'],'',1,'',''),true)["is_login"];
	if(is_login(@$_COOKIE["bduss"],@$_REQUEST["bduss"])){
		if(@$_GET["rm"]==true){
			setcookie('bduss',@$_REQUEST["bduss"],time()+315705600,'/',$_SERVER['HTTP_HOST']);
			//setcookie('ptoken',@$_REQUEST['ptoken'],time()+315705600,'/',$seo_info["site_url"]);
			//setcookie('stoken',@$_REQUEST['stoken'],time()+315705600,'/',$seo_info["site_url"]);
			//setcookie('baiduid',json_decode(head(@$_REQUEST['bduss']),1)["un"],time()+315705600,'/',$seo_info["site_url"]);
			echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-success"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["been_login"].'</p></div></div></div>';
		}
		else{
			setcookie('bduss',@$_REQUEST["bduss"],time()+300,'/',$_SERVER['HTTP_HOST']);
			//setcookie('ptoken',@$_REQUEST['ptoken'],time()+300,'/',$seo_info["site_url"]);
			//setcookie('stoken',@$_REQUEST['stoken'],time()+300,'/',$seo_info["site_url"]);
			//setcookie('baiduid',json_decode(head(@$_rREQUEST['bduss']),1)["un"],time()+300,'/',$seo_info["site_url"]);
			echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-success"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["been_login_urm"].'</p></div></div></div>';
		}
	}
	else{
	    setcookie('bduss','',time()-9999,'/',$_SERVER['HTTP_HOST']);
		echo '<meta http-equiv="Refresh" content="5;url=//'.$seo_info["site_url"].'/?m=login"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["bduss_error"].'</p></div></div></div>';
	}
}

