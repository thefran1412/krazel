<?php
class User extends dataBase{

	function __construct(){
		$this->connect();
	}

	function createUser ($username, $password, $email){
		$sql = 'INSERT INTO users(username, passwd, email, verified) VALUES ("'.$username.'", "'.sha1($password).'", "'.$email.'", 0);';
		$this->sendData($sql);
	}

	function existUser ($username){
		$sql = 'SELECT username FROM users WHERE LCASE(username) = LCASE("'.$username.'");';
		$result =  $this->getData($sql);
		
		if($result->num_rows <= 0){
			return 0;
		}
		else{
			return 1;
		}
	}
	
	function getUser ($id){
		$sql = 'SELECT * FROM users WHERE id_user = '.$id.';';
		$row = $this->getData($sql);
		
		return $userdata;
	}

	function editUser ($id, $username, $password, $email, $verified){
		$sql ='UPDATE table_name SET username = "'.$username.'", password = "'.sha1($password).'", email = "'.$email.'", verified = '.$verified.' WHERE id_user = '.$id.';';
		$this->sendData($sql);
	}
	
	function getIdUser ($username){
		$sql = 'SELECT id_user FROM users WHERE username = "'.$username.'";';
		$result = $this->getData($sql);
		$row = mysqli_fetch_assoc($result);
		$id = $row["id_user"];
		
		return $id;
	}
}