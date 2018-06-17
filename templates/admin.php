<?php
if(is_login(@$_COOKIE["bduss"],@$_REQUEST["bduss"]) && is_admin(@$_COOKIE["bduss"],$admin_id)){
    $head_info=json_decode(head(@$_COOKIE["bduss"]),true);
    echo '<div class="col-md-10 offset-md-1"><div class="card border-success text-center"><div class="card-header">'.$translate["admin"].'</div><div class="card-body"><img src="' . $head_info["avatarUrl"] . '"><p class="card-text">' . $head_info["un"] . '</p></div></div></div>';
    /*check update*/
    $cu = json_decode(file_get_contents('https://kdnetwork.github.io/api/wcnd/version.json'),true);
    if($cu["check_ver"] > CHECK_VER){
        echo '<div class="col-md-10 offset-md-1"><div class="card text-white bg-warning"><div class="card-header">'.$translate["update"].'</div><div class="card-body">' . $cu["system_ver"] . '<br>' . $cu["check_data"] . '</div></div></div>';
    }else{
        echo '<div class="col-md-10 offset-md-1"><div class="card border-info"><div class="card-header">'.$translate["update"].'</div><div class="card-body">'.$translate["no_update"].'</div></div></div>';
    }
    
}else{
    echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["illegal_user"].'</p></div></div></div>';
}
