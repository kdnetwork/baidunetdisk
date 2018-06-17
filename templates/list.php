<?php
if(is_login(@$_COOKIE["bduss"],'')){
	$order=@$_REQUEST['order'];
	$by=@$_REQUEST['by'];
	if(@$_REQUEST['path']==''){
		$path='%2F';
	}
	else{
		$path=urlencode($_REQUEST['path']);
	}
	if(@$_REQUEST['page']=='' || !preg_match('/[1-9][0-9]*/',@$_REQUEST["page"])){
		$page=1;
	}
	else{
		$page=$_REQUEST['page'];
	}
	$re=json_decode(scurl('http://pcs.baidu.com/rest/2.0/pcs/file?path=/'.$path.'&method=list&app_id='.$appid.'&by='.$by.'&order='.$order.'&limit='.($page-1).'0-'.$page.'1','get','','BDUSS='.$_COOKIE['bduss'],'pcs.baidu.com',1,'',''),true);
	if($re["error_code"]==31045){
		echo '<meta http-equiv="Refresh" content="5;url=./?m=list&path=%2F&page=1"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["noresult"].'</p></div></div></div>';
	}
	else{
		echo '<div class="col-md-10 offset-md-1"><nav aria-label="breadcrumb"><ol class="breadcrumb">'.show_list_name(urldecode($path)).'</ol></nav></div><div class="col-md-10 offset-md-1"><div class="list-group">';
		for($x=0;
		$x<count($re["list"])-1;
		$x++){
			if($re["list"][$x]["isdir"]==true){
				echo '<a href="./?m=list&path='.urlencode($re["list"][$x]["path"]).'&page=1" class="list-group-item list-group-item-primary">'.$re["list"][$x]["server_filename"].'</a>';
			}
			else{
				echo '<a href="./?m=getlink&l=pcs&path='.urlencode($re["list"][$x]["path"]).'" class="list-group-item list-group-item-light">'.$re["list"][$x]["server_filename"].'</a>';
			}
		}
		echo '</div></div><nav aria-label="page"><ul class="pagination justify-content-center">';
		if($page!=1){
			echo '<li class="page-item"><a class="page-link" href="./?m=list&by='.$by.'&order='.$order.'&path='.$path.'&page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
		}
		else{
			echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><span aria-hidden="true">&laquo;</span></a>';
		}
		if(count($re["list"]) == 11){
			echo '<li class="page-item"><a class="page-link" href="./?m=list&by='.$by.'&order='.$order.'&path='.$path.'&page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
		}
		else{
			echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><span aria-hidden="true">&raquo;</span></a>';
		}
		echo '</ul></nav>';
	}
}
else{
	echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["nologin"].'</p></div></div></div>';
}