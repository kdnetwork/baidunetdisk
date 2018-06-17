<?php
if(is_login(@$_COOKIE["bduss"],'')){
	echo '<div class="col-md-10 offset-md-1"><form action="./" method="get"><form action="./?m=search" method="post"><div class="input-group mb-3"><input type="text" class="form-control" placeholder="'. @$_REQUEST["q"].'" name="q" id="input" value="'. @$_REQUEST["q"].'"><div class="input-group-append"><button class="btn btn-primary" type="submit">'.$translate["go"].'</button></div></div></form></div>';
	if(@$_REQUEST["q"]!=""){
		$back=json_decode(scurl('https://pcs.baidu.com/rest/2.0/pcs/file?method=search&app_id='.$appid.'&path=%2F&wd='.urlencode($_REQUEST["q"]).'&re=1','','','BDUSS='.$_COOKIE['bduss'],'pcs.baidu.com',1,'',''),true);
		if(count($back["list"]) > 0){
			echo '<div class="col-md-10 offset-md-1"><div class="card bg-info mb-3 text-white text-center"><div class="card-body"><p class="card-text">'.count($back["list"]).'</p></div></div></div><div class="col-md-10 offset-md-1"><div class="list-group">';
			foreach($back["list"] as $key){
				if($key["isdir"]==true){
					echo '<a href="./?m=list&path='.urlencode($key["path"]).'&page=1" class="list-group-item list-group-item-primary">'.$key["server_filename"].'</a>';
				}
				else{
					echo '<a href="./?m=getlink&l=pcs&path='.urlencode($key["path"]).'" class="list-group-item list-group-item-light">'.$key["server_filename"].'</a>';
				}
			}
			echo '</div></div>';
		}else{
		echo '<div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["noresult"].'</p></div></div></div>';
		}
	}
	
}
else{
	echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["nologin"].'</p></div></div></div>';
}