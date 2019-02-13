<?php
//1. 先将商品库存 存入队列
$redis = new Redis();
for($i=1;$i<=100;$i++){
    $redis->lpush('good','good_id'.$i);
}
print_r($redis->lrange('good',0,-1));exit;
 
//2. 队列程序执行
 
header("content-type:text/html;charset=utf-8");
$redis = new Redis();
//插入抢购数据
$userid = "user_id_".mt_rand(1, 9999).'_'.microtime(true);
if($res = $redis->lpop('good')){
    //$left = $redis->llen('good'); //剩余".($left)."
    $redis->lpush('good_res',$res);
    //file_put_contents('F:\b.txt',$userid."抢购成功！".$res."\n",FILE_APPEND); 写入文件可能会遇到并发锁 导致无法及时写入 而被直接跳过导致记录结果有误 建议测试使用mysql 或者 redis 存入日志记录
}else{
    //file_put_contents('F:\b.txt', $userid."手气不好，再抢购！\n",FILE_APPEND);
}
exit;
//3. 打印执行结果
$redis = new Redis();
print_r($redis->lrange('good_res',0,-1));exit;
?>
