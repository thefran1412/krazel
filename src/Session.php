<?php
class Session {
	
	public function startSession(){
		session_start();
	}
	
	public function createSession ($name, $value){
		$_SESSION[$name] = $value;
	}
	
	public function deleteSession (){
		session_destroy();
	}
	
	public function exists ($name){
		if(isset($_SESSION[$name])){
			return 1;
		}
		else{
			return 0;
		}
	}

	public function getValue ($name){
		$value = $_SESSION[$name];
		return $value;
	}
}