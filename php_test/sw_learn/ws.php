<?php 

class Ws{
	CONST HOST = "0.0.0.0";
	CONST PORT = "9999";

	public $ws = null;
	public function __construct(){
		$this->ws = new swoole_websocket_server(self::HOST,self::PORT);
		$this->ws->on('open',[$this,'onOpen']);
		$this->ws->on('message',[$this,'onMessage']);
		$this->ws->on('close',[$this,'onClose']);
		// 我发现在ws中混进去http不太好，最好两个分开
		// $this->ws->on('request',[$this,'onRequest'] );
		$this->ws->start();
	}

	// 启动
	public function onOpen($server,$request){
		echo "client {$request->fd} start\n";
	}

	// 收到信息
	public function onMessage(swoole_websocket_server $server,$frame){
		echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
		// 假设收到非常耗时的功能请求，可以使用task
		
		// 向客户端推送数据
		$server->push($frame->fd, "this is server");
	}

	// 关闭
	public function onClose($ser,$fd){
		echo "client {$fd} close\n";
	}

	
	/**
	 * 不建议混入
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @return [type]           [description]
	 */
	public function onRequest($request,$response){
		// 获取request
		$return_info = file_get_contents('./html/ws_client.html');
		// 返回信息
		$response->end($return_info);
	}
}

$con = new Ws();
// $server ->set([
// 	// 开启配置
// 	'enable_static_handler' => true,
// 	// 当此文件下有对应的文件，则直接读取对应目录下的文件（不安全）
// 	'document_root' => "/mnt/hgfs/centos_share/web",
// ]);








 ?>


