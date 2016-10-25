<!DOCTYPE>
<html>
	<head>
		<title>Krazel: new</title>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="http://malsup.github.com/jquery.form.js"></script> 
		<script src="script.js"></script>

		<script src="js/jquery.Jcrop.min.js"></script>
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />


		<link rel="icon" href="../images/favicon.png">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
		<link rel="stylesheet" href="../styles/style-index-desktop.css" media="all" />

	</head>
	<div id = "everything">
		<div id = "header">	
			<div id="menu">
				<div id="div-left">
					<div id="nombre" align="right">
						<h1>Krazel</h1>
						<img src="../images/Subtitle.png" id = "subtitle"/>
					</div>
					<div class="menuleft">
						<p><a href="../">HOME</a></p>
						<p><a href="index.php">NEW SQUARE </a></p>
						<p><a href="#">EVENTS</a></p>
						<p><a href="#">CONTACT US</a></p>
					</div>
				</div>
				<div id="logo">
					<p><a href="?" style="border: none;"><img src="../images/logo_alpha.png" id = "logo"/></a></p>
				</div>
				<div id="div-right" align="right">
					<div id="account";>
						Login
					</div>
					<div class="menuright">
						<p><a href="index.php">ABOUT US</a></p>
						<p><a href="#">UPDATES</a></p>
						<p><a href="#">WHAT'S THIS</a></p>
						<p><a href="#">ENIGMA</a></p>
					</div>
				</div>
			</div>
		</div>
		<div id="body">
			<div class="main">
				<h1>New Square</h1>
				
				<form id="myForm" action="upload.php" method="post" enctype="multipart/form-data" novalidate>
					<h2>Title:</h2>
					<input type="text" name="title">
					<h2>Url:</h2>
					<input type="url" name="url">
					<h2>Select Image:</h2>
					<div id="hide">
						<div class="fileUpload btn btn-primary">
							<span>Select</span>
							<input type="file" name="fileToUpload" id="fileToUpload" accept="image/*"  class="upload"/>
						</div>
						<input type="number" id="x" name="x" hidden="true">
						<input type="number" id="y" name="y" hidden="true">
						<input type="number" id="w" name="w" hidden="true">
						<input type="number" id="h" name="h" hidden="true">
						<img id="image" style="width: 100%;">
						<input type="submit" value="Create Square" class="btn btn-success" disabled="true" style="width: 100%; margin-top: 10px;">
					</div>
					<div id="complete" hidden="true">
						<h3>Complete!</h3>
					</div>
				</form>
			</div>
		</div>
	</div>
</html>