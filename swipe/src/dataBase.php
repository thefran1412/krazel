<?php
class dataBase {
	protected $servername = "localhost";
	protected $username = "root";
	protected $password = "";
	protected $dbname = "krazel";
	public $conn;
	
	public function connect (){
		// Create connection
		$this->conn =  new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		// Check connection
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		} 
		$this->conn->set_charset("utf8");
	}
	
	public function sendData ($sql){
		$result = $this->conn->query($sql);
	}
	
	public function getData ($sql){
		$result = $this->conn->query($sql);
		return $result;
	}
}