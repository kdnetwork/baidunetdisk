<?php
$bduss=$_COOKIE["bduss"];
$zh=curl_init('https://www.baidu.com');
curl_setopt($zh,CURLOPT_USERAGENT ,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
curl_setopt($zh,CURLOPT_RETURNTRANSFER ,1);
curl_setopt($zh,CURLOPT_COOKIE ,'BDUSS='.$bduss);
$namehhh=curl_exec($zh);
curl_close($zh);
preg_match("/<span class=user-name>(.+?)<\/span>/u",$namehhh,$kdpicname);
$username=$kdpicname[1];
if ($_COOKIE["baiduid"]==$username && preg_match("/{$admin_id}/",$_COOKIE["baiduid"])){
echo '<div class="col-md-8 col-md-offset-2" role="main"><div class="panel panel-default"><div class="panel-body"><form action="./?m=admin" method="post"><div class="input-group"><label>token</label><input type="text" id="token" class="form-control" name="token" value="'.$token.'"><br><label>appid</label><input type="text" id="appid" class="form-control" name="appid" value="'.$appid.'"><br><label>网站链接</label><input type="text" id="url" class="form-control" name="url" value="'.$url.'"></div><br><label>管理员百度id</label><input type="text" id="admin_id" class="form-control" name="admin_id" value="'.$admin_id.'"><br><label>seo</label><input type="text" id="seo" class="form-control" name="seo" value="'.$seo.'"><br><label>中国境内模式</label><input type="text" id="chinamode" class="form-control" name="chinamode" value="'.$chinamode.'"><br><label>reCaptcha secret</label><input type="text" id="secret" class="form-control" name="secret" value="'.$secret.'"><br><label>reCaptcha data_sitekey</label><input type="text" id="data_sitekey" class="form-control" name="data_sitekey" value="'.$data_sitekey.'"><br><label>封锁国家（地区）</label><input type="text" id="banlocation" class="form-control" name="banlocation" value="'.$banlocation.'"><br><label>多域名</label><input type="text" id="myotherurl" class="form-control" name="myotherurl" value="'.$myotherurl.'"></div><br></div><button class="btn btn-default" type="submit">保存</button></span></div></form></div></div></div>';	
//$update_check=json_decode(file_get_contents('https://raw.githubusercontent.com/kdwnil/baidunetdisk/git-page/README.md'),1);
//	if (str_replace('.','',$update_check["version"])<=str_replace('.','',$version)){
//		echo '无更新';
//	}else {
//		echo "检测到更新\n版本:{$update_check["version "]}\n更新说明:{$update_check["info "]}";
//	}
//	echo 'hh';
}else {
	header('Location: ./?m=error&errno=illegal user');
}