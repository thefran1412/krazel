<?php
	if ($_POST['User'] !== '' && $_POST['Password'] !== '') {
		spl_autoload_register(function ($className){
			require $className.'.php';
		});
		$connection = new dataBase();
		$connection->connect();
		$sessions = new Session();
		$sessions->startSession();
		$users = new User();

		$result = $users->login($_POST['User'], $_POST['Password']);
		if($result === false){
			echo 'failed';
		}
		else{
			echo $result;
			$sessions->createSession('username', $_POST['User']);
		}
	}
	else{
		echo "empty";
	}
?>