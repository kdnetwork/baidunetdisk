<?php
/*check login status*/
function is_login($cookie_bduss,$request_bduss){
    //备份几个接口，哪天贴吧挂了可以用
    //http://map.baidu.com/?qt=ssn
    //https://baike.baidu.com/api/usercenter/login
    //https://www.nuomi.com/pclogin/main/userinfo
    //http://lvyou.baidu.com/user/ -> Location: /user/(uid) -> https://lvyou.baidu.com/user/ajax/getcommentnum?format=ajax&uid=(uid)
	if($cookie_bduss=="" && $request_bduss==""){
		return false;
	}
	elseif($cookie_bduss!=""){
		$bduss=$cookie_bduss;
		$check_login=json_decode(scurl('http://tieba.baidu.com/dc/common/tbs','get','','BDUSS='.$bduss,'','','',''),1)["is_login"];
		if($check_login==true){
			return true;
		}
		else{
			return false;
		}
	}
	elseif($request_bduss!=""){
		$bduss=$request_bduss;
		$check_login=json_decode(scurl('http://tieba.baidu.com/dc/common/tbs','get','','BDUSS='.$bduss,'','','',''),1)["is_login"];
		if($check_login==true){
			return true;
		}
		else{
			return false;
		}
	}
}
/*chesk admin*/
function is_admin($bduss,$admin_list){
	$check_admin=json_decode(head($bduss),true)["un"];
	if(preg_match('/'.$admin_list.'/',$check_admin)){
		return true;
	}
	else{
		return false;
	}
}
/*get your Baidu avatar by your BDUSS*/
function head($bduss){
	return scurl('https://top.baidu.com/user/pass','get','','BDUSS='.$bduss,'www.baidu.com',1,'','');
}
/*get quota*/
function quota($bduss){
	$a=json_decode(scurl('https://pan.baidu.com/api/quota?checkexpire=1&checkfree=1&channel=chunlei&web=1&app_id=250528&bdstoken=&logid=&clienttype=0','','','BDUSS='.$bduss,'pan.baidu.com',1,'',false),true);
	return '<div class="progress"><div class="progress-bar" role="progressbar" style="width: '.ceil(($a["used"]/$a["total"])*100).'%" aria-valuemin="0" aria-valuemax="100">'.ceil($a["used"]/1073741824).' GB / '.ceil($a["total"]/1073741824).' GB</div></div>';
}
/*QR code*/
function qrcode($url,$type){
	switch($type){
		case 'png':
			header("Content-type: image/png; charset=utf-8");
			return file_get_contents('https://chart.googleapis.com/chart?cht=qr&chs=100x100&choe=UTF-8&chl='.urlencode($url));
		break;
		default:
			header("Content-type: text/txt; charset=utf-8");
			$img=file_get_contents('https://chart.googleapis.com/chart?cht=qr&chs=100x100&choe=UTF-8&chl='.urlencode($url));
			return 'data:image/png;base64,'.base64_encode($img);
		break;
	}
}
/*cloud dl*/
function cloud_dl_status($x,$s){
	if($x>=0 && $x<=8){
		return $s[$x];
	}
	else{
		return $s[9];
	}
}
function cloud_dl_source($a){
	if(substr($a,-8)=='.torrent' && substr($a,0,1)=='/'){
		return './?m=getlink&l=pcs&path='.urlencode($a);
	}
	else{
		return $a;
	}
}
/*for list*/
function show_list_name($path,$m='list'){
	if($path!='/'){
		$listname=strtok($path,"/");
		$a=array();
		while($listname!==false){
			$a[]=$listname;
			$listname=strtok("/");
		}
		$aaa='<li class="breadcrumb-item"><a href="./?m=' . $m . '&page=1&path=%2F">'.$GLOBALS["translate"]["root"].'</a></li>';
		for($x=0;
		$x<count($a)-1;
		$x++){
			$aaa.='<li class="breadcrumb-item"><a href="./?m=' . $m . '&page=1&path=';
			for($y=0;
			$y<=$x;
			$y++){
				$aaa.='%2F'.urlencode($a[$y]);
			}
			$aaa.='">'.$a[$x].'</a></li>';
		}
		$aaa.='<li class="breadcrumb-item active" aria-current="page">'.$a[count($a)-1].'</li>';
		return $aaa;
	}else{
	    return '<li class="breadcrumb-item active" aria-current="page">'.$GLOBALS["translate"]["root"].'</li>';
	}
}
/*auto get surl from sharelink*/
function get_surl($url,$surl=''){
    if($surl != ''){
        return $surl;
    }else{
        return trim(preg_replace('/(http|https):\/\/pan.baidu.com\/(s\/|wap\/(link|init)\?surl=)/','',$url));
    }
}
/*multi del*/
function multi_del($files){
    foreach($files as $key){
        if(!unlink($key)){
            //echo "删除失败\n";
        }//else{
            //echo "删除成功\n";
        //}
    }
}
/*for transfer*/
function transfer($uk,$shareid,$path,$bduss){//注意：$path 是一个数组
    return scurl("https://pan.baidu.com/share/transfer?from={$uk}&shareid={$shareid}&bdstoken=&web=5&app_id=250528&logid=&channel=chunlei&clienttype=5",'post',array("path" => "/我的资源/","filelist" => json_encode($path), "async" => 1,"r"=>0.1,"type"=>1),'BDUSS='.$bduss,'pan.baidu.com',1,10);
}
