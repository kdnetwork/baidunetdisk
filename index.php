<?php
require('./config.php');
include('./lib/cinstall.php');
switch ($_GET["m"]) {
    case 'avatar';
        require('./lib/head.php');
        header("Content-type: image/webp charset=utf-8");
        echo file_get_contents(json_decode(head($_COOKIE['bduss']),1)["avatarUrl"]);
        break;
    default:
        include('./templates/'.$language.'_ui.php');
        break;
}
