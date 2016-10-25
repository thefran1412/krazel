<?php

if(isset($_FILES['fileToUpload'])){
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$errors = 100;

	// Check if image file is a actual image or fake image
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        //echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        //echo "File is not an image.";
	        $errors = 0;
	        $uploadOk = 0;
	    }
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
	    //echo "Sorry, your file is too large.";
	    $errors = 1;
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG") {
	    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $errors = 2;
	    $uploadOk = 0;
	}
	elseif ($uploadOk != 0 && $imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "JPG" || $imageFileType == "JPEG") {
		$url = cropJPG(info($_POST, $_FILES));
		echo $url;
	}
	elseif ($uploadOk != 0 && $imageFileType == "png" || $imageFileType == "PNG") {
		$url = cropPNG(info($_POST, $_FILES));
		echo $url;
	}
	else{
		$errors = 3;
	}

	if($errors != 100){
		echo $errors;
	}
}
else{
	echo '3';
}

/*
ERROR LIST:
0: FILE IS NOT AN IMAGE
1: FILE SIZE
2: FILE FORMAT NOT ALLOWED
3: OTHER ERRORS
*/

function cropJPG ($info){
	$targ_w = $targ_h = 350;
	$jpeg_quality = 100;

	$img_r = imagecreatefromjpeg($info['src']);
	$dst_r = ImageCreateTrueColor($targ_w, $targ_h);
	imagecopyresampled($dst_r, $img_r, 0, 0, $info['coords']['x'], $info['coords']['y'], $targ_w, $targ_h, $info['coords']['w'], $info['coords']['h']);

	header('Content-type: image/jpeg');
	imagejpeg($dst_r, $info['url'], $jpeg_quality);

	return $info['url'];
}
function cropPNG ($info){
	$targ_w = $targ_h = 350;
	$im = imagecreatefrompng($info['src']);
	$size = min($targ_w, $targ_h);
	$im2 = imagecrop($im, ['x' => $info['coords']['x'], 'y' => $info['coords']['y'], 'width' => $info['coords']['w'], 'height' => $info['coords']['h']]);
	$thumb = imagecreatetruecolor(350, 350);
	imagecopyresized ($thumb, $im2, 0, 0, 0, 0, 350, 350, $info['coords']['w'], $info['coords']['h']);
	
	if ($thumb !== FALSE) {
	    imagepng($thumb, $info['url']);
	}
	return $info['url'];
}
function info ($post, $file){
	$coords = array(
		'coords' =>
		array(
			'x' => $post['x'],
			'y' => $post['y'],
			'w' => $post['w'],
			'h' => $post['h']
		),
		'url' => 'uploads/'.time()."_".basename($file["fileToUpload"]["name"]),
		'src' => $file["fileToUpload"]['tmp_name']
	);
	return $coords;
}
?>