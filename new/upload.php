<?php
//var_dump($_POST);
if (isset($_POST['url']) && $_POST['url'] !== "") {
	if(isEmpty($_POST['url'])){
			$url = $_POST['url'];
			$target_file = "uploads/".time().'.png';
			$image = base64_to_jpeg( $url, $target_file);
			saveImage($target_file);
			//echo '<img src="'.$image.'">';
			echo $target_file;
	}
	else{
		echo 'empty';
	}
}
else if(isset($_POST['url'])){
	echo 'nothing selected';
}
else{
	echo 'anything';
}
function saveImage($url){
	require_once('../src/dataBase.php');
	$conn = new dataBase();
	$conn->connect();
	$sql = 'INSERT INTO images (id_user, url) VALUES (1, "'.$url.'");';
	$conn->sendData($sql);

}
function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, "wb"); 

    $data = explode(',', $base64_string);

    fwrite($ifp, base64_decode($data[1])); 
    fclose($ifp); 

    return $output_file; 
}
function isEmpty($url){
	$empty = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAWIAAAFiCAYAAADMXNJ6AAALgklEQVR4Xu3UQQ0AAAwCseHf9GTcpzNAUhZ2jgABAgRSgaXpwgkQIEDgDLEnIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEDLEfIECAQCxgiOMCxBMgQMAQ+wECBAjEAoY4LkA8AQIEHpEHAWOVSKDuAAAAAElFTkSuQmCC';

	if(strcmp($empty, $url)){
		return true;
	}
	else{
		return false;
	}
}