<?php
switch (@$_REQUEST["l"]) {
    case 'pcs':
        if (is_login(@$_COOKIE["bduss"],'')) {
            $bduss = @$_COOKIE["bduss"];
            $path = urldecode(@$_REQUEST['path']);
            if (substr($path,0,1) == '/') {
                $path = substr($path,1);
            }
            $re = json_decode(scurl('https://d.pcs.baidu.com/rest/2.0/pcs/file?method=locatedownload&app_id=250528&ver=2.0&dtype=0&esl=1&ehps=0&check_blue=1&clienttype=1&path=%2F'.$path.'&logid='.$logid,'get','','BDUSS='.$bduss,'','netdisk;7.8.1;Red;android-android;4.3','',''),true);
            if ($re["error_code"] != 0) {
                echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["illegal_user"].'</p></div></div></div>';
            } else {
                echo '<div class="col-md-10 offset-md-1"><form action="./?m=getlink" method="post"><input type="hidden" name="l" value="pcs"/><div class="input-group mb-3"><input type="text" class="form-control" placeholder="'.$translate["path"].'" name="path" id="input" value="'. @$_REQUEST["path"].'"><div class="input-group-append"><button class="btn btn-primary" type="submit">'.$translate["go"].'</button></div></div></form><div class="card text-white bg-danger mb-3"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["tips_pcs"].'</p></div></div></div><div class="col-md-10 offset-md-1"><div class="list-group">';
                $x = 1;
                foreach ($re["urls"] as $key) {
                    echo '<a href="'.$key["url"].'" class="list-group-item list-group-item-action flex-column align-items-start ';
                    if ($x%2 == 0) {
                        echo 'active';
                    }
                    echo '" target="_blank"><div class="d-flex w-100 justify-content-between"><p class="mb-1">'.$key["url"].'</p></div></a>';
                    $x++;
                }
                echo '</div></div>';
            }
        } else {
            echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["nologin"].'</p></div></div></div>';
        }
        break;
    case 'es':
        if (is_login(@$_COOKIE["bduss"],'')) {
            $bduss = @$_COOKIE["bduss"];
            $path = @$_REQUEST['path'];
            $path = urldecode(@$_REQUEST['path']);
            if (substr($path,0,1) == '/') {
                $path = substr($path,1);
            }
            $re = json_decode(scurl('https://d.pcs.baidu.com/rest/2.0/pcs/share?method=create&type=public&path=%2F'.$path.'&app_id='.$appid,'get','','BDUSS='.$bduss,'','','',''),true);
            if ($re["error_code"] != 0) {
                echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["illegal_user"].'</p></div></div></div>';
            } else {
                echo '<div class="col-md-10 offset-md-1"><form action="./?m=getlink" method="post"><input type="hidden" name="l" value="es"/><div class="input-group mb-3"><input type="text" class="form-control" placeholder="'.$translate["path"].'" name="path" id="input" value="'. @$_REQUEST["path"].'"><div class="input-group-append"><button class="btn btn-primary" type="submit">'.$translate["go"].'</button></div></div></form></div><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger mb-3"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["tips_es"].'</p></div></div></div></div><div class="col-md-10 offset-md-1"><a href="'.$re["list"][0].'"><div class="card"><div class="card-body">'.$re["list"][0].'</div></div></a></div>';
            }
        } else {
            echo '<meta http-equiv="Refresh" content="5;url=./"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["nologin"].'</p></div></div></div>';
        }
        break;
    default:
        echo '<div class="col-md-10 offset-md-1"><div class="card text-white bg-warning"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["tips_web"].'</p></div></div></div>';
        $step = @$_REQUEST["step"];
        switch ($step) {
            case 4:
            case 2:
                if (@$_REQUEST["spwd"] == "") {
                    if (@$_REQUEST["dir"] != "") {
                        $url = 'https://pan.baidu.com/wap/shareview?surl=' . @$_REQUEST["k"] . '&page=1&third=0&fsid='.  @$_REQUEST["fsid"] . '&num=20&dir=' .  urlencode(@$_REQUEST["dir"]);
                    } elseif (preg_match('/(https|http):\\/\\/pan.baidu.com\\//',substr(@$_REQUEST["url"],0,25))) {
                        $url = @$_REQUEST["url"];
                    } else {
                        $url = 'https://pan.baidu.com/'. @$_REQUEST["url"];
                    }
                    echo '<div class="col-md-10 offset-md-1"><div class="card text-center"><div class="card-body"><p class="card-text">'.$translate["what_input"].':<a href="'.$url.'" target="_blank">'.$url.'</a></p>';
                    if ($step == 4) {
                        $c = base64_decode(@$_REQUEST["cookie"]);
                    } else {
                        $c = '';
                    }
                    $content = trim(scurl($url,'get','',$c,'','Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba',20,true,true,15));
                    if ($content == '') {
                        echo '<br>' . $translate["error_link_baidu"] . '</div></div>';
                    } else {
                        preg_match_all('/window.yunData = (.+?);/iu',$content,$kd);
                        $json = json_decode($kd[1][0],true);
                        if ($json["root_file_num"] > 1 || $json["file_list"][0]["isdir"] == "1") {
                            if ($step == 2) {
                                //preg_match('/BDCLND=(.+);/U',$content,$cookie);
                                $cookie = '';
                            } else {
                                $cookie = @$_REQUEST["cookie"];
                            }
                            echo '<meta http-equiv="Refresh" content="1;url=./?m=list&case=web&step=' . $step . '&cookie=' . $cookie . '&url=' . $url . '">' . $translate["is_dir_location"];
                            echo '</div></div></div>';
                        } else {
                            $zh = json_decode(trim(scurl("http://pan.baidu.com/share/download?bdstoken=null&web=5&app_id=250528&logid={$logid}&channel=chunlei&clienttype=5&uk={$json["uk"]}&shareid={$json["shareid"]}&fid_list=%5B{$json["file_list"][0]["fs_id"]}%5D&sign={$json["downloadsign"]}&timestamp={$json["timestamp"]}",'get','',$c,'','Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba',10,0)),true);
                            if (!isset($zh["dlink"])) {
                                echo '<img src="'.$zh["img"].'" width="300" height="90" /><form action="./" method="get"><input type="hidden" name="m" value="getlink"/><input type="hidden" name="l" value="web"/><input type="hidden" name="step" value="'.($step+1).'"/><input type="hidden" name="uk" value="'.$json["uk"].'"/><input type="hidden" name="shareid" value="'.$json["shareid"].'"/><input type="hidden" name="fid_list" value="%5B'.$json["file_list"][0]["fs_id"].'%5D"/><input type="hidden" name="downloadsign" value="'.$json["downloadsign"].'"/><input type="hidden" name="timestamp" value="'.$json["timestamp"].'"/><input type="hidden" name="vcode" value="'.$zh["vcode"].'"/><div class="input-group mb-3"><input type="text" class="form-control" placeholder="'.$translate["vcode"].'" name="input" id="input""><div class="input-group-append"><button class="btn btn-primary" type="submit">'.$translate["go"].'</button></div></div>';
                                if (@$_REQUEST["step"] == 4) {
                                    echo '<input type="hidden"  name="k" value="'. @$_REQUEST["k"].'"><input type="hidden" name="cookie" value="'.@$_REQUEST["cookie"].'"/>';
                                }
                                echo '</form></div></div></div>';
                            } else {
                                echo '<div class="col-md-10 offset-md-1"><a href="'.$zh["dlink"].'" target="_blank"><div class="card"><div class="card-body">'.$zh["dlink"].'</div></div></a></div>';
                            }
                        }
                    }

                } else {
                    //die("皮这一下你很开心吗(ㆀ˘･з･˘)");
                    if (preg_match('/(https|http):\\/\\/pan.baidu.com\\//',substr(@$_REQUEST["url"],0,25))) {
                        $url = @$_REQUEST["url"];
                    } else {
                        $url = 'https://pan.baidu.com/'. @$_REQUEST["url"];
                    }
                    echo '<div class="col-md-10 offset-md-1"><div class="card text-center"><div class="card-body"><p class="card-text">'.$translate["what_input"].':<a href="'.$url.'" target="_blank">'.$url.'</a></p>';
                    $content = trim(scurl($url,'get','','','','Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba',20,1,true,15,true));
                    if ($content != "") {
                        preg_match_all("/Location:(.+?)\n/u",$content,$actbc);
                        $actbc = get_surl($actbc[1][0]);
                        /*get captcha*/
                        $coo = json_decode(trim(scurl('https://pan.baidu.com/api/getcaptcha?prod=shareverify&bdstoken=null&web=5&app_id=250528&logid='.$logid.'&channel=chunlei&clienttype=5','get','','','http://pan.baidu.com/wap/init?surl='.trim($actbc[2]),'Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba','',0)),true);
                        if ($coo == '' || json_decode($coo,true)["errno"] != 0) {
                            echo $translate["novcode"];
                        } else {
                            //die("皮这一下你很开心吗(ㆀ˘･з･˘)");
                            echo '<br><img src="'.$coo["vcode_img"].'" width="300" height="90" />';
                            echo '<form action="./" method="get"><input type="hidden" name="m" value="getlink"/><input type="hidden" name="l" value="web"/><input type="hidden" name="vcode" value="'.$coo["vcode_str"].'"/><input type="hidden" name="step" value="'.($step+1).'"/><div class="input-group mb-3"><input type="text" class="form-control" placeholder="'.$translate["vcode"].'" name="input" id="input"><input type="hidden"  name="spwd" value="'. @$_REQUEST["spwd"].'"><input type="hidden"  name="k" value="'. @chop($actbc).'"><div class="input-group-append"><button class="btn btn-primary" type="submit">'.$translate["go"].'</button></div></div></form>';
                        }} else {
                        echo $translate["novcode"];
                    }
                    echo '</div></div></div>';
                }
                break;
            case 5:
            case 3:
                $input = @$_REQUEST["input"];
                $vcode = @$_REQUEST["vcode"];
                if (!isset($_REQUEST["spwd"])) {
                    $uk = @$_REQUEST["uk"];
                    $shareid = @$_REQUEST["shareid"];
                    $fid_list = @$_REQUEST["fid_list"];
                    $downloadsign = @$_REQUEST["downloadsign"];
                    $timestamp = @$_REQUEST["timestamp"];
                    $url = "http://pan.baidu.com/share/download?bdstoken=null&web=5&app_id=250528&logid={$logid}&channel=chunlei&clienttype=5&uk={$uk}&shareid={$shareid}&fid_list={$fid_list}&sign={$downloadsign}&timestamp={$timestamp}&input={$input}&vcode={$vcode}";
                    if ($step == 5) {
                        $link = json_decode(trim(scurl($url,'get','',base64_decode(@$_REQUEST["cookie"]),'https://pan.baidu.com/wap/init?surl=1'.@$_REQUEST["k"],'Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba','',0)),true);
                    } else {
                        $link = json_decode(trim(scurl($url,'get','','','','Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba','',0)),true);
                    }
                    if ($link["errno"] == 0) {
                        echo '<div class="col-md-10 offset-md-1"><a href="'.$link["dlink"].'" target="_blank"><div class="card"><div class="card-body">'.$link["dlink"].'</div></div></a></div>';
                    } else {
                        echo '<div class="col-md-10 offset-md-1"><div class="card text-center"><div class="card-body">'.$translate["nolink"].'</div></div></div>';
                    }
                } else {
                    //die("皮这一下你很开心吗(ㆀ˘･з･˘)");
                    $kdjsssb = array("pwd" => @$_REQUEST["spwd"],"vcode" => $input,"vcode_str" => $vcode);
                    $nurl = 'https://pan.baidu.com/share/verify?surl='.$_REQUEST["k"].'&t='.time().'000&channel=chunlei&web=1&app_id=250528&bdstoken=null&logid='.$logid.'&clienttype=0';
                    @$coo = trim(scurl($nurl,'post',$kdjsssb,'','https://pan.baidu.com/wap/init?surl='.@$_REQUEST["k"],'Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba',15,1,true,10));
                    if ($coo != "") {
                        if (preg_match('/BDCLND=(.+);/U',$coo,$cookie)) {
                            echo '<meta http-equiv="Refresh" content="2;url=./?m=getlink&l=web&step=4&url=https://pan.baidu.com/s/1'.@$_REQUEST["k"].'&k='.$_REQUEST["k"].'&cookie='.urlencode(base64_encode('BDCLND='.$cookie[1].';')).'"><div class="col-md-10 offset-md-1"><div class="card text-white bg-success"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["real_pw"].'</p></div></div></div>';
                        } else {
                            echo '<meta http-equiv="Refresh" content="2;url=./?m=getlink&l=web&step=1"><div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["wrong_pw"].'</p></div></div></div>';
                        }
                    } else {
                        echo '<div class="col-md-10 offset-md-1"><div class="card text-white bg-danger"><div class="card-header">'.$translate["tips"].'</div><div class="card-body"><p class="card-text">'.$translate["error_link_baidu"].'</p></div></div></div>';
                    }
                }
                break;
            default:
                echo '<div class="col-md-10 offset-md-1"><form action="./?m=getlink" method="post"><input type="hidden" name="step" value="2"/><div class="input-group mb-3"><input type="url" class="form-control" placeholder="https://pan.baidu.com/..." name="url" id="input"><input type="text" class="form-control" placeholder="'.$translate["url_pw"].'" name="spwd" id="input"><div class="input-group-append"><button class="btn btn-primary" type="submit">'.$translate["go"].'</button></div></div></form></div>';
                break;
        }
        break;
}
