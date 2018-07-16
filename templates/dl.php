<?php
if(is_login(@$_COOKIE["bduss"],'')){
    if(@$_REQUEST["dl_url"] != ''){
        $dl = json_decode(scurl('http://pan.baidu.com/rest/2.0/services/cloud_dl?channel=chunlei&web=1&app_id=250528&bdstoken=null&logid=' . $logid . '&clienttype=0','post',array("method" => "add_task","appid" => 250528,"source_url" => @$_REQUEST["dl_url"],"save_path" => "/我的资源"),'BDUSS='.$_COOKIE['bduss'],'pan.baidu.com',1,'',''),true);
        if($dl["task_id"] != ''){
            echo '<meta http-equiv="Refresh" content="5;url=./?m=dl"><div class="col-md-10 offset-md-1"><div class="card text-white bg-success"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["task_success"].'</p></div></div></div>';
        }else{
            echo '<meta http-equiv="Refresh" content="5;url=./?m=dl"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["task_wrong"].'</p></div></div></div>';
        }
    }else{
        
        echo '<div class="col-md-10 offset-md-1"><div class="card border-success mb-3"><div class="card-header">'. $translate["tips"].'</div><div class="card-body"><p class="card-text">'. $translate["tips_dl"].'</p></div></div><form action="./?m=dl" method="post"><div class="input-group mb-3"><input type="text" class="form-control" placeholder="'. $translate["url"].'" name="dl_url" id="input"><div class="input-group-append"><button class="btn btn-primary" type="submit">'. $translate["go"].'</button></div></div></form></div>';
        $b = json_decode(scurl('https://pan.baidu.com/rest/2.0/services/cloud_dl?need_task_info=1&status=255&start=0&limit=200&method=list_task&app_id=250528&channel=chunlei&web=1&bdstoken=null&logid=' . $logid . '&clienttype=0','get','','BDUSS='.$_COOKIE['bduss'],'pan.baidu.com',1,'',''),true);
        foreach($b["task_info"] as $key){
            if(substr($key["save_path"],-1) == '/'){
					echo '<div class="col-md-10 offset-md-1"><div class="card border-primary mb-3"><a href="./?m=list&path='.urlencode($key["save_path"].$key["task_name"]).'&page=1"><div class="card-header">'.$key["task_name"].'</div></a><div class="card-body"><li>'. $translate["status"].' : ' . cloud_dl_status($key["status"],$translate["cloud_dl"]) . '</li><li>'. $translate["source_url"].' : <a href="' . cloud_dl_source($key["source_url"]) . '" target="_blank">' . $key["source_url"] . '</a></li><p class="card-text"></p></div></div></div>';
				}
				else{
					echo '<div class="col-md-10 offset-md-1"><div class="card border-secondary mb-3"><a href="./?m=getlink&l=pcs&path='.urlencode($key["save_path"]).'"target="_blank"><div class="card-header">'.$key["task_name"].'</div></a><div class="card-body"><li>'. $translate["status"].' : ' . cloud_dl_status($key["status"],$translate["cloud_dl"]) . '</li><li>'. $translate["source_url"].' : <a href="' . cloud_dl_source($key["source_url"]) . '" target="_blank">' . $key["source_url"] . '</a></li><p class="card-text"></p></div></div></div>';
				}
        
    }
}}
else{
	echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["nologin"].'</p></div></div></div>';
}
