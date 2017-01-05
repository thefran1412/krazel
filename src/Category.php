<?php

class Category extends dataBase{

	function __construct(){
		$this->connect();
	}

	function getCategories (){
		$sql = 'SELECT name, id_category FROM category WHERE id_father = 0;';
		$result = $this->getData($sql);
		echo '<ul>';
		foreach ($result as $row){
			$name = $row["name"];
			$id = $row["id_category"];
			echo '<li><img src="images/arrow.png" class="arrow"><a href="?category='.$id.'">'.$name.'</a>';
			$sql = 'SELECT name, id_category FROM category WHERE id_father = '.$id;
			$results = $this->getData($sql);
			echo '<div class="sub"><ul>';
			foreach ($results as $rows) {
				echo '<li><a href="?category='.$rows['id_category'].'">'.$rows['name'].'</a></li>';
			}
			echo '</ul></div></li>';
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
