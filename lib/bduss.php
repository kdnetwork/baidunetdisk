<?php
echo '<div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 您将前往'.$siteurl.'</strong> </div><br><div class="col-md-8 col-md-offset-2" role="main"><div class="panel panel-default"><div class="panel-body"><form action="'.$siteurl.'" method="get"><input type="hidden"  name="m" value="main"><div class="input-group"><textarea class="form-control" rows="10" cols="99999" placeholder="您的bduss..." name="bduss"></textarea><span class="input-group-btn"></div><br><div class="checkbox"><label><input type="checkbox"  name="rm" value="1">记住我</label>';
if($chinamode==0 && $secret!==''){
	echo '<div class="g-recaptcha" data-sitekey="'.$data_sitekey.'"></div>';
}
echo '</div><button class="btn btn-default" type="submit">点击登录</button></span></div></form></div></div></div><br><br><div class="col-md-8 col-md-offset-2" role="main"><div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">说明</h3></div><div class="panel-body">bduss获取方式:<br>简云<a href="https://bduss.tbsign.cn/">https://bduss.tbsign.cn</a><br>imyfan贴吧云签<a href="https://tool.imyfan.com">https://tool.imyfan.com</a><br><br></div></div>';