<?php
/**
 * KD·BDND
 **/
/*define*/
define('SYSTEM_ROOT',dirname(__FILE__));
define('PLUGINS_ROOT',dirname(__FILE__).'/plugins');
define('LIB_ROOT',dirname(__FILE__).'/lib');
define('SYSTEM_VER','v6.0');
define('CHECK_VER',18061701);
/*load kernel files*/
require(SYSTEM_ROOT.'/db/config.php');
require(LIB_ROOT.'/scurl.php');
require(LIB_ROOT.'/others.php');
/*auto load plugins*/
$pluginslist = glob(PLUGINS_ROOT . "/*.php");
foreach ($pluginslist as $key) {
    require($key);
}
/*load translate info*/
$translate = json_decode(file_get_contents(SYSTEM_ROOT . '/db/translate/'.$language.'.json'),true);
/*load plugins info*/
$show_page_info = json_decode(file_get_contents(SYSTEM_ROOT . '/db/page_info.json'),true);
/*load seo info*/
$seo_info = json_decode(file_get_contents(SYSTEM_ROOT . '/db/seo_info.json'),true);
