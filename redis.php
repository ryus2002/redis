<?php
$redis = new redis();
$result = $redis->connect('127.0.0.1', 6379);
$mywatchkey = $redis->get("mywatchkey");
$rob_total = 100;   //搶購數量
if($mywatchkey<$rob_total){
    $redis->watch("mywatchkey");
    $redis->multi();

    sleep(1); //只是方便測試效果,正式時要移除此行
    //插入搶購的資料
    $redis->hSet("mywatchlist","user_id_".mt_rand(1, 9999),time());
    $redis->set("mywatchkey",$mywatchkey+1);
    $rob_result = $redis->exec();
    if($rob_result){
        $mywatchlist = $redis->hGetAll("mywatchlist");
        echo "成功購買！<br/>";
        echo "剩餘數量：".($rob_total-$mywatchkey-1)."<br/>";
        echo "用戶列表：<pre>";
        var_dump($mywatchlist);
    }else{
        echo "手氣不好，再搶購！";exit;
    }
}
?>