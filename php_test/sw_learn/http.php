<?php 
//创建server 对象，监听ip和端口
$http = new swoole_http_server("0.0.0.0", 8808);

$http ->set([
	// 开启配置
	'enable_static_handler' => true,
	// 当此文件下有对应的文件，则直接读取对应目录下的文件（不安全）
	'document_root' => "/mnt/hgfs/centos_share/web",
]);

$http -> on('request', function($request,$response){
	// 获取request
	$header = $request->header;
	$server = $request->server;
	$get = $request->get;
	$post = $request->post;
	$cookie = $request->cookie;
	
	// var_dump(date('Y-m-d H:i:s'));
	// var_dump($get);
	

	$return_info = '<h1>HTTPServer</h1>';
	$return_info .= 'header<pre>';
	$return_info .= json_encode($header);
	$return_info .= '</pre>';

	$return_info .= 'server<pre>';
	$return_info .= json_encode($server);
	$return_info .= '</pre>';

	$return_info .= 'get<pre>';
	$return_info .= json_encode($get);
	$return_info .= '</pre>';

	$return_info .= 'post<pre>';
	$return_info .= json_encode($post);
	$return_info .= '</pre>';

	$return_info .= 'cookie<pre>';
	$return_info .= json_encode($cookie);
	$return_info .= '</pre>';
	// 设定request
	$response->cookie('my_sw_coo','xxxsss',time()+1000);

	// 返回信息
	$response->end($return_info);
});

$http->start();







// object(Swoole\Http\Request)#6 (10) {
//   ["fd"]=>
//   int(1)
//   ["streamId"]=>
//   int(0)
//   ["header"]=>
//   array(7) {
//     ["host"]=>
//     string(19) "192.168.19.129:8808"
//     ["connection"]=>
//     string(10) "keep-alive"
//     ["upgrade-insecure-requests"]=>
//     string(1) "1"
//     ["user-agent"]=>
//     string(108) "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36"
//     ["accept"]=>
//     string(85) "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8"
//     ["accept-encoding"]=>
//     string(13) "gzip, deflate"
//     ["accept-language"]=>
//     string(14) "zh-CN,zh;q=0.9"
//   }
//   ["server"]=>
//   array(11) {
//     ["query_string"]=>
//     string(5) "aa=aa"
//     ["request_method"]=>
//     string(3) "GET"
//     ["request_uri"]=>
//     string(1) "/"
//     ["path_info"]=>
//     string(1) "/"
//     ["request_time"]=>
//     int(1553138057)
//     ["request_time_float"]=>
//     float(1553138058.5572)
//     ["server_port"]=>
//     int(8808)
//     ["remote_port"]=>
//     int(62386)
//     ["remote_addr"]=>
//     string(12) "192.168.19.2"
//     ["master_time"]=>
//     int(1553138057)
//     ["server_protocol"]=>
//     string(8) "HTTP/1.1"
//   }
//   ["request"]=>
//   NULL
//   ["cookie"]=>
//   array(2) {
//     ["Hm_lvt_5fedb3bdce89499492c079ab4a8a0323"]=>
//     string(10) "1551076889"
//     ["Hm_lvt_7b1919221e89d2aa5711e4deb935debd"]=>
//     string(10) "1551092770"
//   }
//   ["get"]=>
//   array(1) {
//     ["aa"]=>
//     string(2) "aa"
//   }
//   ["files"]=>
//   NULL
//   ["post"]=>
//   NULL
//   ["tmpfiles"]=>
//   NULL
// }

 ?>


