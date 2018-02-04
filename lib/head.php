<?php
function  head ($bduss){
	return scurl('http://top.baidu.com/user/pass','get','','BDUSS='.$bduss,'www.baidu.com',1,'','');
}