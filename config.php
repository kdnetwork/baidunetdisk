<?php
$token='';//用于简云登录的token，必填
$appid='266719';
$url='';//域名，登录回调用的，如实填写就好了
$siteurl='https://'.$url;//您的网站的域名，用于短链接，必填
$admin_id='';//管理员id，暂时没什么用
$version='v5.3';
$seo='百度网盘直链工具';//seo信息，自行修改，分隔用半角逗号","
$language='zh_cn';//语言，这是个大坑，目前不支持其他语言
$chinamode=1;//如果您的服务器在国内且不能访问Google，请不要填0，默认1
$secret='';//for reCAPTCHA 只有填写本参数且chinamode等于0才会开启reCAPTCHA
$data_sitekey='';//for reCAPTCHA 如需开启reCAPTCHA请填写，否则用户将不能正常登录
$banlocation='';//禁止访问的地区，填写国家或地区的名称，如禁止A国和B国则填写'A国|B国'，屏蔽单个国家或地区则不需要填'|'，默认空白，如需更新数据库请登录后到https://www.ipip.net/free_download/下载并解压内容到ip文件夹