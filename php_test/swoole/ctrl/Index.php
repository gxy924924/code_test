<?php
// 测试server_http_route
namespace ctrl;

class Index{
	public function login($request){
		$post = isset($request->post) ? $request -> post : array();

		return "login success";
	}
}


?>