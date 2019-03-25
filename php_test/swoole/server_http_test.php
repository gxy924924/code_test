<?php
$http = new Swoole\Http\Server("http://192.168.19.129", 9511);
$http->on('request', function ($request, $response) {
	// $num = empty($num)?1:$num++;
	$say = "<h1>Hello Swoole. #".rand(1000, 9999)."</h1>";
	// $say .="<br>you are no$num";
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1><br>you are no$num");
});
$http->start();

?>