<div class="col-md-12" role="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <center>
                <h1><?echo $_GET["errno"]?></h1>
            </center>
        </div>
    </div>
    <?
    if($_GET["errno"]=='451'){
        echo '<div class="panel panel-default"><div class="panel-body"><center><b>根据您所在的地区的相关政策，本网站不可用</b></center></div></div>';
    }
    ?>