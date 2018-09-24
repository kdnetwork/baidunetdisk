<?php
/**
 * KD·BDND
 * 咕咕咕咕咕
 **/
require(dirname(__FILE__) . '/init.php');
if(!isset($_REQUEST["m"])){
    $api_msg_echo = ["errno" => -1,"msg" => $api_msg["empty"]];
}



header("Content-type: text/json; charset=utf-8");
echo json_encode($api_msg_echo,JSON_UNESCAPED_UNICODE);