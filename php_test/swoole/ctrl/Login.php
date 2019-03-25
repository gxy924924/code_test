<?php
// 测试server_http_route
namespace ctrl;

class Login{
	public function login($request){
		$post = isset($request->post) ? $request -> post : array();

		return "login success";
	}
}


?>