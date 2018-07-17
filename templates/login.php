<?php
if (isset($_REQUEST["sign"])) {
    $a = @scurl('https://passport.baidu.com/channel/unicast?channel_id='.$_REQUEST["sign"].'&callback=&tpl=netdisk&apiver=v3&tt=' . time() .'0000&_=' . time() . '0003','get','','','pan.baidu.com',3,10);
    if ($a != '') {
        $a = json_decode(json_decode(str_replace(array("(",")"),'',$a),true)["channel_v"],true);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,'https://passport.baidu.com/v3/login/main/qrbdusslogin?v=' . time() . '0000&bduss='.$a["v"].'&u=https%253A%252F%252Fpan.baidu.com%252Fdisk%252Fhome&loginVersion=v4&qrcode=1&tpl=netdisk&apiver=v3&tt=' . time() .'0000&traceid=&callback=');
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36');
        curl_setopt($ch,CURLOPT_HEADER,true);
        curl_setopt($ch,CURLOPT_NOBODY,true);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $a = curl_exec($ch);
        curl_close($ch);
        if (preg_match('/BDUSS=(.+?); expires/iU',$a,$b)) {
            echo '<meta http-equiv="Refresh" content="5;url=./?m=login&bduss=' . $b[1] . '&rm=' . @$_REQUEST["rm"] . '"><div class="col-md-10 offset-md-1"><div class="card text-white bg-success"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["r_bduss"].'</p></div></div></div>';
        } else {
            echo '<meta http-equiv="Refresh" content="5;url=./?m=login"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["w_bduss"].'</p></div></div></div>';
        }
    } else {
        echo '<meta http-equiv="Refresh" content="5;url=./?m=login"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["w_bduss"].'</p></div></div></div>';
    }

} elseif ($_REQUEST["bduss"] == "" && $_COOKIE["bduss"] == "") {
    $a = json_decode(file_get_contents('https://passport.baidu.com/v2/api/getqrcode?lp=pc&apiver=v3&tpl=netdisk'),true);
    echo '<div class="col-md-10 offset-md-1"><div class="card text-center"><div class="card-header">'. $translate["login"].'</div><div class="card-body"><p class="card-text"><img class="img-fluid" alt="Responsive image" src="//'.$a["imgurl"].'"><form action="//'.$seo_info["site_url"].'/" method="get"><input type="hidden" name="m" value="login"><input type="hidden" name="sign" value="'.$a["sign"].'"><div class="checkbox"><label><input type="checkbox" name="rm" value= true>'. $translate["remenber_me"].'</label></div><button class="btn btn-primary" type="submit">'. $translate["qr_button_for_login"].'</button></form></p></div></div></div><div class="col-md-10 offset-md-1"><div class="card"><div class="card-body"><form action="//'.$seo_info["site_url"].'/" method="get"><input type="hidden" name="m" value="login"><div class="input-group"><textarea class="form-control" rows="9" cols="9999" placeholder="'. $translate["your_bduss"].'" name="bduss"></textarea><span class="input-group-btn"></div><br><div class="checkbox"><label><input type="checkbox" name="rm" value= true>'. $translate["remenber_me"].'</label>';
    if ($secret != '') {
        echo '<div class="g-recaptcha" data-sitekey="'.$data_sitekey.'"></div>';
    }
    echo '</div><button class="btn btn-primary" type="submit">'. $translate["button_for_login"].'</button></span></div></form></div></div></div></div><div class="col-md-10 offset-md-1"><div class="card border-primary mb-3"><div class="card-header"><h5 class="card-title">'. $translate["tips"].'</h5></div><div class="card-body">'. $translate["how_to_get_bduss"].':<br>简云<a href="https://bduss.tbsign.cn/">https://bduss.tbsign.cn</a><br>imyfan贴吧云签<a href="https://tool.imyfan.com">https://tool.imyfan.com</a><br><br></div></div></div>';

} elseif (isset($_COOKIE["bduss"])) {
    echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["been_login"].'</p></div></div></div>';
} else {
    if ($secret != '') {
        $captchaback = json_decode(scurl('https://www.recaptcha.net/recaptcha/api/siteverify','post','secret='.$secret.'&response='.@$_GET["g-recaptcha-response"].'&remoteip=','','',3,'',''),true);
        if ($captchaback["success"] == false) {
            echo '<meta http-equiv="Refresh" content="5;url=//'.$seo_info["site_url"].'/?m=login"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["captcha_error"].'</p></div></div></div>';
            die ;
        }
    }
    //$check_login=json_decode(scurl('http://tieba.baidu.com/dc/common/tbs','get','','BDUSS='.$_REQUEST['bduss'],'',1,'',''),true)["is_login"];
    if (is_login(@$_COOKIE["bduss"],@$_REQUEST["bduss"])) {
        if (@$_GET["rm"] == true) {
            setcookie('bduss',@$_REQUEST["bduss"],time()+315705600,'/',$_SERVER['HTTP_HOST']);
            //setcookie('ptoken',@$_REQUEST['ptoken'],time()+315705600,'/',$seo_info["site_url"]);
            //setcookie('stoken',@$_REQUEST['stoken'],time()+315705600,'/',$seo_info["site_url"]);
            //setcookie('baiduid',json_decode(head(@$_REQUEST['bduss']),1)["un"],time()+315705600,'/',$seo_info["site_url"]);
            echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-success"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["been_login"].'</p></div></div></div>';
        } else {
            setcookie('bduss',@$_REQUEST["bduss"],time()+300,'/',$_SERVER['HTTP_HOST']);
            //setcookie('ptoken',@$_REQUEST['ptoken'],time()+300,'/',$seo_info["site_url"]);
            //setcookie('stoken',@$_REQUEST['stoken'],time()+300,'/',$seo_info["site_url"]);
            //setcookie('baiduid',json_decode(head(@$_rREQUEST['bduss']),1)["un"],time()+300,'/',$seo_info["site_url"]);
            echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-success"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["been_login_urm"].'</p></div></div></div>';
        }
    } else {
        setcookie('bduss','',time()-9999,'/',$_SERVER['HTTP_HOST']);
        echo '<meta http-equiv="Refresh" content="5;url=//'.$seo_info["site_url"].'/?m=login"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["bduss_error"].'</p></div></div></div>';
    }
}
