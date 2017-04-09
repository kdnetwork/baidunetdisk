<?php
echo '<title>退出</title>';
echo '<meta name="viewport" content="width=device-width,maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">';
if(strlen($_COOKIE['bduss']) >0){
    $lo=curl_init('https://wappass.baidu.com/passport/?logout');
    curl_setopt($lo,CURLOPT_COOKIE,'BDUSS='.$_COOKIE['bduss']);
    curl_setopt($lo,CURLOPT_RETURNTRANSFER,1);
    $kkk = curl_exec($lo);
    curl_close($lo);
setcookie('bduss','',time()-9999,'/',$_SERVER['HTTP_HOST']);
if($_GET["fr"] == old){
echo '<meta http-equiv="Refresh" content="0;url=./old">正在退出...';
}else{echo '<meta http-equiv="Refresh" content="0;url=./">正在退出...';
}
}else{echo '<meta http-equiv="Refresh" content="0;url=./">请先登录!';}