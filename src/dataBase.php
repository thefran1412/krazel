<?php
class dataBase {
	protected $servername = "localhost";
	protected $username = "root";
	protected $password = "";
	protected $dbname = "krazel";
	public $conn;
	/*protected $servername = "50.87.147.176";
	protected $username = "isselect_dkrazel";
	protected $password = "0PLNvieAtZlJ";
	protected $dbname = "isselect_krazel";*/
	
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