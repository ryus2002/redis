<?php 
//ini_set('display_errors', '1');
header("Content-type:text/html;charset=utf-8");
session_start();

$_SESSION['test_session']= @array('name' =>'fanqie' , 'ccc'=>'hello redis ');

$redis = new redis();
$redis->connect('127.0.0.1', 6379);
echo 'sessionid>>>>>>> PHPREDIS_SESSION:' . session_id();
echo '<br/>';
echo '<br/>';
//redis用session_id作为key并且是以string的形式存储
echo '通过php用redis获取>>>>>>>'.$redis->get('PHPREDIS_SESSION:' . session_id());
echo '<br/>';
echo '<br/>';
echo '通过php用session获取>>>>>>><br/>';
echo '<pre>';
var_dump($_SESSION['test_session']);
echo '</pre>';
?>