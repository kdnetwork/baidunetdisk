<?php
if (is_login(@$_COOKIE["bduss"],'') && @$_REQUEST["case"] != "web") {
    $order = @$_REQUEST['order'];
    $by = @$_REQUEST['by'];
    if (@$_REQUEST['path'] == '') {
        $path = '%2F';
    } else {
        $path = urlencode($_REQUEST['path']);
    }
    if (@$_REQUEST['page'] == '' || !preg_match('/[1-9][0-9]*/',@$_REQUEST["page"])) {
        $page = 1;
    } else {
        $page = $_REQUEST['page'];
    }
    $re = json_decode(scurl('http://pcs.baidu.com/rest/2.0/pcs/file?path=/'.$path.'&method=list&app_id='.$appid.'&by='.$by.'&order='.$order.'&limit='.($page-1).'0-'.$page.'1','get','','BDUSS='.$_COOKIE['bduss'],'pcs.baidu.com',1,'',''),true);
    if ($re["error_code"] == 31045) {
        echo '<meta http-equiv="Refresh" content="5;url=./?m=list&path=%2F&page=1"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["noresult"].'</p></div></div></div>';
    } else {
        echo '<div class="col-md-10 offset-md-1"><nav aria-label="breadcrumb"><ol class="breadcrumb">'.show_list_name(urldecode($path)).'</ol></nav></div><div class="col-md-10 offset-md-1"><div class="list-group">';
        for ($x = 0;
            $x < count($re["list"])-1;
            $x++) {
            if ($re["list"][$x]["isdir"] == true) {
                echo '<a href="./?m=list&path='.urlencode($re["list"][$x]["path"]).'&page=1" class="list-group-item list-group-item-primary">'.$re["list"][$x]["server_filename"].'</a>';
            } else {
                echo '<a href="./?m=getlink&l=pcs&path='.urlencode($re["list"][$x]["path"]).'" class="list-group-item list-group-item-light">'.$re["list"][$x]["server_filename"].'</a>';
            }
        }
        echo '</div></div><nav aria-label="page"><ul class="pagination justify-content-center">';
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="./?m=list&by='.$by.'&order='.$order.'&path='.$path.'&page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><span aria-hidden="true">&laquo;</span></a>';
        }
        if (count($re["list"]) == 11) {
            echo '<li class="page-item"><a class="page-link" href="./?m=list&by='.$by.'&order='.$order.'&path='.$path.'&page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
        } else {
            echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><span aria-hidden="true">&raquo;</span></a>';
        }
        echo '</ul></nav>';
    }
} elseif (@$_REQUEST["case"] == "web" || @$_REQUEST["url"] != '') {
    if (@$_REQUEST["cookie"] != '') {
        $cookie = $_REQUEST["cookie"];
    } else {
        $cookie = '';
    }
    $url = @$_REQUEST["url"];
    $step = @$_REQUEST["step"];
    $k1 = get_surl($url);
    //接下来部分是给首页文件用的
    if (!isset($_REQUEST["dir"]) && !isset($_REQUEST["uk"]) && !isset($_REQUEST["shareid"])) {
        if (@$_REQUEST["page"] == '' || @$_REQUEST["page"] < 1) {
            $page = 1;
        } else {
            $page = $_REQUEST["page"];
        }
        $content = trim(scurl($url . '?page=' . $page,'get','',$cookie,'','Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba',10,1,true,15));
        if ($content == '') {
            echo '<div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["error_link_baidu"].'</p></div></div></div>';
        } else {
            preg_match_all('/window.yunData = (.+?);/iu',$content,$kd);
            echo '<div class="col-md-10 offset-md-1"><nav aria-label="breadcrumb"><ol class="breadcrumb">'.$translate["root"].'</ol></nav></div><div class="col-md-10 offset-md-1"><div class="list-group">';
            $json = json_decode($kd[1][0],true);
            for ($x = 0;$x < count($json["file_list"]);
                $x++) {
                if ($json["file_list"][$x]["isdir"] == true) {
                    echo '<a href="./?m=list&case=web&l=web&step=' . $step . '&url=https://pan.baidu.com/s/'.$k1.'&k='.$k1.'&page=1&cookie='.@$_REQUEST["cookie"].'&dir=' . urlencode($json["file_list"][$x]["path"]) . '&uk=' . $json["uk"] . '&shareid=' . $json["shareid"] . '" class="list-group-item list-group-item-primary">'.$json["file_list"][$x]["server_filename"].'</a>';
                } else {
                    echo '<a href="./?m=getlink&l=web&step=' . $step . '&url=https://pan.baidu.com/s/'.$k1.'&k='.$k1.'&cookie='.@$_REQUEST["cookie"].'&dir=' . urlencode($json["rootSharePath"]) . '&fsid=' . $json["file_list"][$x]["fs_id"] . '" class="list-group-item list-group-item-light">'.$json["file_list"][$x]["server_filename"].'</a>';
                }
            }
            echo '</div></div>';
            $most_page = ceil($json["root_file_num"]/20);
            echo '</div></div><nav aria-label="page"><ul class="pagination justify-content-center">';
            if ($page != 1) {
                echo '<li class="page-item"><a class="page-link" href="./?m=list&case=web&url=' . $url . '&k='.$k1.'&cookie=' . @$_REQUEST["cookie"] . '&page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
            } else {
                echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><span aria-hidden="true">&laquo;</span></a>';
            }
            echo '<li class="page-item disabled"><a class="page-link" href="#">' . $page . '/' . $most_page . '</a></li>';
            if ($page >= $most_page) {
                echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><span aria-hidden="true">&raquo;</span></a>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="./?m=list&case=web&url=' .$url . '&k='.$k1.'&cookie=' . @$_REQUEST["cookie"] . '&page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
            }
            echo '</ul></nav>';
        }
    } else {
        //下面处理非首页文件夹下的文件/文件夹
        if (@$_REQUEST["page"] == '' || @$_REQUEST["page"] < 1) {
            $page = 1;
        } else {
            $page = $_REQUEST["page"];
        }
        $web_list = json_decode(trim(scurl('https://pan.baidu.com/share/list?bdstoken=null&web=5&app_id=250528&logid=' . $logid . '&channel=chunlei&clienttype=5&order=time&desc=1&showempty=0&page=' . $page . '&num=21&dir=' . urlencode(@$_REQUEST["dir"]) . '&uk=' . @$_REQUEST["uk"] . '&shareid=' . @$_REQUEST["shareid"],'get','',$cookie,@$_REQUEST["url"],'Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba','')),true);
        echo '<div class="col-md-10 offset-md-1"><div class="list-group">';
        for ($x = 0;$x < count($web_list["list"]);
            $x++) {
            if ($web_list["list"][$x]["isdir"] == true) {
                echo '<a href="./?m=list&case=web&l=web&step=' . $step . '&url=https://pan.baidu.com/s/'.$_REQUEST["k"].'&k='.$_REQUEST["k"].'&page=1&cookie='.@$_REQUEST["cookie"].'&dir=' . $web_list["list"][$x]["path"] . '&uk=' . @$_REQUEST["uk"] . '&shareid=' . @$_REQUEST["shareid"]
                . '" class="list-group-item list-group-item-primary">'.$web_list["list"][$x]["server_filename"].'</a>';
            } else {
                echo '<a href="./?m=getlink&l=web&step=' . $step . '&url=https://pan.baidu.com/s/'.$_REQUEST["k"].'&k='.$_REQUEST["k"].'&cookie='.@$_REQUEST["cookie"].'&dir=' . @$_REQUEST["dir"] . '&fsid=' . $web_list["list"][$x]["fs_id"] . '" class="list-group-item list-group-item-light">'.$web_list["list"][$x]["server_filename"].'</a>';
            }
        }
        echo '</div></div><nav aria-label="page"><ul class="pagination justify-content-center">';
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="./?m=list&case=web&l=web&step=' . $step . '&url=https://pan.baidu.com/s/'.$_REQUEST["k"].'&k='.$_REQUEST["k"].'&cookie='.@$_REQUEST["cookie"].'&dir=' . @$_REQUEST["dir"] . '&uk=' . @$_REQUEST["uk"] . '&shareid=' . @$_REQUEST["shareid"] . '&page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><span aria-hidden="true">&laquo;</span></a>';
        }
        if (count($web_list["list"]) == 21) {
            echo '<li class="page-item"><a class="page-link" href="./?m=list&case=web&l=web&step=' . $step . '&url=https://pan.baidu.com/s/'.$_REQUEST["k"].'&k='.$_REQUEST["k"].'&cookie='.@$_REQUEST["cookie"].'&dir=' . @$_REQUEST["dir"] . '&uk=' . @$_REQUEST["uk"] . '&shareid=' . @$_REQUEST["shareid"] . '&page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
        } else {
            echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><span aria-hidden="true">&raquo;</span></a>';
        }
        echo '</ul></nav>';
    }
} else {
    echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["nologin"].'</p></div></div></div>';
}
