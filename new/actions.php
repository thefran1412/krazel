<?php

if ($_POST['action'] == 'selectcat' || $_POST['action'] == 'selectsubcat') {
	require_once('../src/dataBase.php');
	$conn = new dataBase();
	$conn->connect();
	if ($_POST['action'] == 'selectcat') {
		$sql = 'SELECT * FROM category WHERE id_father = 0 ORDER BY name ASC;';
	}
	else{
		$sql = 'SELECT * FROM category WHERE id_father = '.$_POST['father'].' ORDER BY name ASC;';
	}
	$result = $conn->getData($sql);
	
	$response = array();

	foreach ($result as $row) {
		$response[] = array('id' => $row['id_category'], 'name' => $row['name'], 'image' => 'notset.jpg');
	}
	echo json_encode($response);
}
else{
	echo 'false';
}

/*
require_once('../src/dataBase.php');
	$conn = new dataBase();
	$conn->connect();
	$sql = 'SELECT * FROM category WHERE id_father = 0 AND id_category > 5;';
	$sqlend = "";
	$result = $conn->getData($sql);
	foreach ($result as $row) {
		$id = $row['id_category'];
		$sqlend .= '(null,"EXAMPLE2","Not set",'.$id.'), ';
	}
	echo $sql = 'INSERT INTO category (id_category, name, description, id_father) VALUES '.$sqlend;*/
?>