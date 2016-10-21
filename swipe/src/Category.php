<?php

class Category extends dataBase{

	function __construct(){
		$this->connect();
	}

	function getCategories (){
		$sql = 'SELECT name, id_category FROM category;';
		$result = $this->getData($sql);
		echo '<ul>';
		foreach ($result as $row){
			$name = $row["name"];
			$id = $row["id_category"];
		echo '<li><a href="?category='.$id.'">'.$name.'</a></li>';
		}
		echo'</ul>';
	}
	function getCategory ($id){
		$sql = 'SELECT name FROM category WHERE id_category = '.$id.';';
		$result = $this->getData($sql);
		$row = mysqli_fetch_assoc($result);
		$answer = $row["name"];
		return $answer;
	}





















}
