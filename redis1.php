<?php 
   //Connecting to Redis server on localhost 
   $redis = new Redis(); 
   $redis->connect('127.0.0.1', 6379); 
   echo "Connection to server sucessfully"; 
   //check whether server is running or not 
   echo "Server is running: ".$redis->ping(); 
   
   echo "<BR><BR>";
   #str
   $redis->set("tutorial-name", "Redis tutorial"); 
   // Get the stored data and print it 
   echo "Stored string in redis:: " .$redis->get("tutorial-name");    

   echo "<BR><BR>";
   //store data in redis list 
   $redis->lpush("tutorial-list", "Redis"); 
   $redis->lpush("tutorial-list", "Mongodb"); 
   $redis->lpush("tutorial-list", "Mysql");  
   
   // Get the stored data and print it 
   $arList = $redis->lrange("tutorial-list", 0 ,5); 
   echo "Stored string in redis:: "; 
   print_r($arList);    

	echo "<BR><BR>";
   // Get the stored keys and print it 
   $arList = $redis->keys("*"); 
   echo "Stored keys in redis:: " ;
   print_r($arList);    

	// Tom is a simple associative array
	$tom = array(
		'name' => 'Thomas Hunter',
		'age' => 27,
		'height' => 165,
	);
	// The predis library makes setting hashes easy
	$redis->hmset('tom', $tom);
	// Now lets load that hash
	$tom = $redis->hgetall('tom');
	// As you can see, the object is exactly the same
	var_dump($tom); 
	echo "<BR><BR>";

	// We can get a single field from our hash if we want
	$tomsage = $redis->hget('tom', 'age');
	echo "Tom is $tomsage years old.\n";
	// We can increment a single field from the hash as well
	$redis->hincrby('tom', 'age', '10');
	$tom = $redis->hgetall('tom');
	var_dump($tom);  
	echo "<BR><BR>";
	
	// Here's another simple associative array
	$jessica = array(
		'name' => 'Jessica Rabbit',
		'age' => 30,
		'height' => 140
	);
	// Lets convert it into a JSON string
	$jessica_json = json_encode($jessica);
	// I'm just going to set it like any other string
	$redis->set('jessica', $jessica_json);
	// Now, lets load it, and JSON decode it (as an array not an stdClass, thanks to the second argument)
	$new_jessica = json_decode($redis->get('jessica'), TRUE);
	var_dump($new_jessica);  
	echo "<BR><BR>";   
   
?>