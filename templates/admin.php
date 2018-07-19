<?php
if (is_login(@$_COOKIE["bduss"],@$_REQUEST["bduss"]) && is_admin(@$_COOKIE["bduss"],$admin_id) && $admin_id != '') {
    switch (@$_REQUEST["task"]) {
        case 'update':
            mkdir(SYSTEM_ROOT . '/tmp');
            file_put_contents(SYSTEM_ROOT."/tmp/ud.zip",file_get_contents('https://github.com/kdnetwork/baidunetdisk/archive/master.zip'));
            $zip = new ZipArchive;
            if ($zip->open(SYSTEM_ROOT."/tmp/ud.zip") === TRUE) {
                $zip->extractTo(SYSTEM_ROOT."/tmp/t");
                $zip->close();
            } else {
                echo "error\n";
            }
            multi_del(array(SYSTEM_ROOT."/tmp/t/baidunetdisk-master/db/seo_info.json",SYSTEM_ROOT."/tmp/t/baidunetdisk-master/db/config.php",SYSTEM_ROOT."/tmp/t/baidunetdisk-master/.htaccess"));
            //copy
            cpall(SYSTEM_ROOT."/tmp/t/baidunetdisk-master",SYSTEM_ROOT);
            delall(SYSTEM_ROOT."/tmp");
            echo '<meta http-equiv="Refresh" content="5;url=./?m=admin"><div class="col-md-10 offset-md-1"><div class="card border-success"><div class="card-header">'.$translate["update"].'</div><div class="card-body">'.$translate["ok_update"].'</div></div></div>';
            break;
        default:
            $head_info = json_decode(head(@$_COOKIE["bduss"]),true);
            echo '<div class="col-md-10 offset-md-1"><div class="card border-success text-center"><div class="card-header">'.$translate["admin"].'</div><div class="card-body"><img src="data:image/png;base64,' . base64_encode(file_get_contents($head_info["avatarUrl"])) . '"><p class="card-text">' . $head_info["un"] . '</p></div></div></div>';
            /*check update*/
            $cu = json_decode(file_get_contents('https://kdnetwork.github.io/api/wcnd/version.json'),true);
            if ($cu["check_ver"] > CHECK_VER) {
                echo '<div class="col-md-10 offset-md-1"><div class="card border-warning"><div class="card-header">'.$translate["update"].'</div><div class="card-body">' . $cu["system_ver"] . '<br>' . $cu["check_data"] . '<br><a href="./?m=admin&task=update" class="btn btn-primary">'.$translate["update"].'</a></div></div></div>';
            } else {
                echo '<div class="col-md-10 offset-md-1"><div class="card border-info"><div class="card-header">'.$translate["update"].'</div><div class="card-body">'.$translate["no_update"].'</div></div></div>';
            }
    }


} else {
    echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["illegal_user"].'</p></div></div></div>';
}
