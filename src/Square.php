<?php

class Square extends dataBase{

	function __construct(){
		$this->connect();
	}

	function createSquare ($id_user, $title, $URL, $description, $image, $price){
		$sql = 'INSERT INTO squares(id_user, title, URL, description, image) VALUES ('.$id_user.', "'.$title.'",  "'.$URL.'", "'.$description.'", "'.$image.'");';
		$this->sendData($sql);

		$sql = 'INSERT INTO payments(id_user, id_square, quantity) VALUES ('.$id_user.', '.$id_square.',  '.$price.');';
		$this->sendData($sql);
	}

	function getSquares (){
		$sql = 'SELECT s.id_square as "ids", s.title as "title", s.url as "url", s.image as "img", SUM(p.quantity) as "suma", u.username as "user" FROM squares s, payments p, users u WHERE s.id_square = p.id_square AND s.id_user = u.id_user GROUP BY s.id_square ORDER BY suma desc;';
		//$result = $this->getData($table,['fields' => [''],'conditions' => '']);
		$result = $this->getData($sql);

		return $result;
	}
	function getSquaresCategory ($id){
		$sql = 'SELECT c.id_square as "ids", s.title as "title", s.url as "url", s.image as "img", SUM(p.quantity) as "suma", u.username as "user" FROM squares s, payments p, users u, square_category c WHERE s.id_square = p.id_square AND s.id_user = u.id_user AND  c.id_square = s.id_square AND c.id_category = '.$id.' GROUP BY c.id_square ORDER BY suma desc;';
		//$result = $this->getData($table,['fields' => [''],'conditions' => '']);
		$result = $this->getData($sql);

		return $result;
	}
	function getSquare ($id_square){
		$sql = 'SELECT s.id_square as "ids", s.title as "title", s.url as "url", s.description as "description", s.image as "img", SUM(p.quantity) as "suma", u.username as "user", c.id_category as "category" FROM squares s, payments p, users u, square_category c WHERE s.id_square = p.id_square AND s.id_user = u.id_user AND s.id_square = '.$id_square.' AND c.id_square = s.id_square GROUP BY s.id_square ORDER BY suma desc;';
		$result = $this->getData($sql);
		$row = mysqli_fetch_assoc($result);

		return $row;
	}
	
	function getIdSquare($id_user, $title){
		$title;
		 $sql = 'SELECT id_square FROM squares WHERE id_user = '.$id_user.' AND title = "'.$title.'" ORDER BY id_square desc limit 1;';
		 
		$result = $this->getData($sql);

		$row =  mysqli_fetch_assoc($result);
		$answer = intval($row["id_square"]);

		return $answer;
	}

	function getPriceSquare($id_square){
		$title;
		 $sql = 'SELECT SUM(quantity) as "suma" FROM payments WHERE id_square = '.$id_square.';';
		 
		$result = $this->getData($sql);

		$row =  mysqli_fetch_assoc($result);
		$answer = intval($row["suma"]);

		return $answer;
	}
	
	function deleteSquare($id_square){
		$sql = 'DELETE FROM squares WHERE id_square = '.$id_square.';';
		$this->sendData($sql);
		$sql = 'DELETE FROM payments WHERE id_square = '.$id_square.';';
		$this->sendData($sql);
	}

	function isOwner($username, $id_square){
		 $sql = 'SELECT u.username as "user" FROM users u, squares s WHERE id_square = '.$id_square.' AND u.id_user = s.id_user;';

		$result = $this->getData($sql);
		$row =  mysqli_fetch_assoc($result);

		$answer = $row["user"];

		if($username == $answer){
			return 1;
		}
		else{
			return 0;
		}
	}

	function uploadImage(){	
		if( $_FILES["fileToUpload"]['size'] != 0){
			$target_dir = "uploads/";
			$temp = explode(".", $_FILES["fileToUpload"]["name"]);
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        $target_file = $target_dir . round(microtime(true)) . '.' . end($temp);
				$uploadOk = 1; 
		    }
		    else {
		        return "File is not an image.";
		        $uploadOk = 0;
		    }
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 20000000) {
			    return "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
			&& $imageFileType != "GIF") {
			    return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    return "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			}
			else {
			   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					return "AAAA".$target_file;
			    }
			    else {
			        return "Sorry, there was an error uploading your file.";
			    }
			}
		}
		else {
			return 'AAAAempty';	
		}
		
	}

	function uploadSquare(){
		$user =  new User();

		$squares = new Square();
		
		$message = $this->uploadImage();
		
		if(substr($message, 0, 4) == "AAAA"){
			if($message == "AAAAempty"){
				echo "Selecciona una imagen vàlida";
			}
			else{
				$target_file = substr($message, 4);
				$title = $_POST['title'];
				$URL = $_POST['url'];
				$description = $_POST['description'];
				$price = $_POST['price'];
				$id_category = $_POST['category'];
					
				$id_user = $user->getIdUser($_SESSION['username']);
				
				$sql = 'INSERT INTO squares(id_user, title, URL, description, image) VALUES ('.$id_user.', "'.$title.'",  "'.$URL.'", "'.$description.'", "'.$target_file.'");';
				$this->sendData($sql);
				
				$id_square = $squares->getIdSquare($id_user, $title);
				
				$sql = 'INSERT INTO payments(id_user, id_square, quantity) VALUES ('.$id_user.', '.$id_square.',  '.$price.');';
				$this->sendData($sql);

				$sql = 'INSERT INTO square_category(id_square, id_category) VALUES ('.$id_square.',  '.$id_category.');';
				$this->sendData($sql);
				
				header("Location: index.php");
				exit;
			}
		}
		else {
			echo $message;
		}

		
	}

	function updateSquare($id_square){
		$user =  new User();

		$squares = new Square();
		
		$message = $this->uploadImage();

		if(substr($message, 0, 4) == "AAAA"){
			
			$title_up = $_POST['title'];
			$URL_up = $_POST['url'];
			$description_up = $_POST['description'];
			$price_up = $_POST['price'];
			$category_up = $_POST['category'];

			$row = $squares->getSquare($id_square);
			$title = $row['title'];
			$URL = $row['url'];
			$description = $row['description'];
			$price = $row['suma'];
			$category = $row['category'];

			$change = 0;

			$id_user = $user->getIdUser($_SESSION['username']);

			$sql = 'UPDATE squares SET ';

			if($title != $title_up){
				$change++;
				$sql .= 'title = "'.$title_up.'"';
			}
			if($URL != $URL_up){
				$change++;
				$sql .= ', URL= "'.$URL_up.'"';
			}
			if($description != $description_up){
				$change++;
				$sql .= ', description= "'.$description_up.'"';
			}
			if(substr($message, 4) != "empty"){
				$imagee = substr($message, 4);
				$sql .= ', image= "'.$imagee.'"';
				$change++;
			}
			if ($change == 1){
				$sql .= ' WHERE id_square = '.$id_square.';';
				$pos = strpos($sql, ',');
				if(!$pos){}
				else{
					$sql = substr($sql, 0, $pos-1).substr($sql, $pos+1);
				}
				$this->sendData($sql);
			}
			else if($change > 1){
				$sql .= 'WHERE id_square = '.$id_square.';';
				$this->sendData($sql);
			}
			if($price < $price_up){
				$total = $price_up-$price;
				$sql = 'INSERT INTO payments(id_user, id_square, quantity) VALUES ('.$id_user.', '.$id_square.', '.$total.');';
				$this->sendData($sql);
			}
			if($category != $category_up){
				$sql = 'UPDATE square_category SET id_category = '.$category_up.' WHERE id_square = '.$id_square.';';
				$this->sendData($sql);
			}
			header("Location: index.php");
			exit;
		}
		else{
			echo $message;
		}
	}
	function getRanking(){
		$sql = 'SELECT s.title, s.image, u.username, SUM(p.quantity) as "suma"
			FROM squares s, payments p, users u
			WHERE s.id_square = p.id_square AND s.id_user = u.id_user
			GROUP BY S.title, s.image, u.username
			ORDER BY suma desc LIMIT 20';
		$result = $this->getData($sql);
		$count = 1;
		echo '<ul>';
		foreach ($result as $row) {
			$title = $row['title'];
			$price = $row['suma'];
			$url = $row['image'];
			$username = $row['username'];
			if ($count <= 9) {
				 $counts = '&nbsp'.$count;
			}
			else{
				$counts = $count;
			}
			if ($count == 1) {
				echo '<li><div class="fst-rank"><img src="'.$url.'"><p>'.$counts.'</p></div><div class="name-rank"><p class="username">'.$username.'</p><p class="price">'.$price.' €</p></div></li>';
			}
			elseif ($count == 2) {
				echo '<li><div class="snd-rank"><img src="'.$url.'"><p>'.$counts.'</p></div><div class="name-rank"><p class="username">'.$username.'</p><p class="price">'.$price.' €</p></div></li>';
			}
			elseif ($count == 3) {
				echo '<li><div class="trd-rank"><img src="'.$url.'"><p>'.$counts.'</p></div><div class="name-rank"><p class="username">'.$username.'</p><p class="price">'.$price.' €</p></div></li>';
			}
			else{
				echo '<li><div class="rank"><img src="'.$url.'"><p>'.$counts.'</p></div><div class="name-rank"><p class="username">'.$username.'</p><p class="price">'.$price.' €</p></div></li>';
			}
			$count++;
		}
		echo '</ul>';
	}
}