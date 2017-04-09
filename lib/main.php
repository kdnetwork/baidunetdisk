<?php
require './config.php';
header("Content-type: text/html; charset=utf-8");
$update_check=json_decode(file_get_contents('https://raw.githubusercontent.com/kdwnil/baidunetdisk/git-page/README.md'),1);
    if($update_check["version"] > $version){
        echo "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button> 检测到更新\n版本:{$update_check["version"]}\n更新说明:{$update_check["info"]} </div>";
    }
function namepic(){
    $bduss= $_COOKIE["bduss"];
    $zh = curl_init('https://www.baidu.com');
    curl_setopt($zh,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
    curl_setopt($zh,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($zh,CURLOPT_COOKIE,'BDUSS='.$bduss);
    $namehhh = curl_exec($zh);
    curl_close($zh);
    preg_match("/<span class=user-name>(.+?)<\/span>/u",$namehhh,$kdpicname);
    return 'https://www.baifubao.com/portrait_img/sys/portrait/item/'.$kdpicname[1].'?isuname=1';
}
$posturl='./?m=suv';
if(strlen($_COOKIE['bduss']) > 0){
    $tbscurl=curl_init('http://tieba.baidu.com/dc/common/tbs');
    curl_setopt($tbscurl,CURLOPT_COOKIE,'BDUSS='.$_COOKIE['bduss']);
    curl_setopt($tbscurl,CURLOPT_RETURNTRANSFER,1);
    $tbsjson = curl_exec($tbscurl);
    curl_close($tbscurl);
    $check_login=json_decode($tbsjson,1)["is_login"];
    if($check_login == 1){echo '<div class="col-md-12" role="main"><div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">说明</h3></div><div class="panel-body"><span id="avatar" style="float:right;"><img src="'.namepic().'" class="img-rounded" height=\'80px\' width=\'80px\' "></span><br><i>*填写绝对路径</i><br>*绝对路径:如在首页名为"x"的文件夹内名称为"k.png"的文件请填写"x/k.png"<!--<br /><a href="./old?fr=new">旧版入口</a>--></div></div><center><form action="'.$posturl.'" method="post"><div class="input-group"><span class="input-group-addon" id="basic-addon3">/</span><input type="text" placeholder="文件路径..." class="form-control" name="path" aria-describedby="sizing-addon1"><span class="input-group-btn"><button class="btn btn-default" type="submit">点击获取直链</button></span></div></div></form></center>';
                            }else{echo '<title>跳转中</title><meta http-equiv="Refresh" content="1;url=./logout.php">bduss无效...';}
                        }    
                        elseif(strlen($_GET['bduss']) > 0){
                            $tbscurl=curl_init('http://tieba.baidu.com/dc/common/tbs');
                            curl_setopt($tbscurl,CURLOPT_COOKIE,'BDUSS='.$_GET['bduss']);
                            curl_setopt($tbscurl,CURLOPT_RETURNTRANSFER,1);
                            $tbsjson = curl_exec($tbscurl);
                            curl_close($tbscurl);
                            $check_login=json_decode($tbsjson,1)["is_login"];
                            if($check_login == 1){
                                    setcookie('bduss',$_GET['bduss'],time()+315705600,'/',$_SERVER['HTTP_HOST']);
                                    setcookie('ptoken',$_GET['ptoken'],time()+315705600,'/',$_SERVER['HTTP_HOST']);
                                    setcookie('stoken',$_GET['stoken'],time()+315705600,'/',$_SERVER['HTTP_HOST']);
                                echo '<title>跳转中</title><meta http-equiv="Refresh" content="0;url=./">跳转中...';}
                            else{echo '<title>跳转中</title><meta http-equiv="Refresh" content="1;url=./">bduss无效...';}
                        }else{
                                echo '<div class="alert alert-warning alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 您还没有登录,要体验更多功能请先<strong><a href="./?m=bduss&fr='.urlencode('http://'.$_SERVER['HTTP_HOST']).'" class="alert-link">登录</a></strong> </div>';
                                include ('./lib/bus.php');
                        }