<!DOCTYPE>
<html>
	<head>
		<title>Krazel: new</title>

		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="http://malsup.github.com/jquery.form.js"></script> 
		<script src="js/script.js"></script>
		<script src="js/popup.js"></script>

		<script src="js/jquery.Jcrop.min.js"></script>
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />

        <link rel="Stylesheet" type="text/css" href="croppie/croppie.css" />

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
		<!-- POP UP: start -->
		<div class="poppy" id="popup-1" hidden="true">
			<div id="options">
				<h2>Select an image:</h2><br>
				<div id="file">
					<a class="btn file-btn">
                        <span>Upload</span>
                        <input type="file" id="upload" value="Choose a file" accept="image/*" />
                    </a>
					<div id="errors" hidden>
						
					</div>
				</div>
				<div id="select">
					<br><br><br><br><hr>
					<p>Select Image:</p><br><br><br><br><br>
				</div>
			</div>
			<div id="crop" hidden>
				<h2>Crop the image:</h2><br>
				<div id="preview" >
					<div class="grid">
                        <div>
                            <div class="actions">
                                <form id="upform" method="post" action="upload2.php" enctype="multipart/form-data">
                                	<input type="hidden" id="url" name="url">
                                	<input type="submit" class="upload-result" style="width: 100%;" name="Upload">
                                </form>
                            </div>
                        </div>
                        <div id="view">
                            <div class="upload-demo-wrap">
                                <div id="upload-demo"></div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<!-- POP UP: end -->
		<div id="body">
			<div class="main">
				<h1>New Square</h1>
					<h2>Title:</h2>
					<input type="text" name="title">
					<h2>Url:</h2>
					<input type="url" name="url">
					<h2>Select Image:</h2>
					<button type="button" id="poppy">Select</button>
					<form id="Form" action="" method="post" enctype="multipart/form-data" novalidate>
							<input type="submit" value="Create Square" class="btn btn-success" disabled="true" style="width: 100%; margin-top: 10px;">
				</form>
			</div>
		</div>
	</div>
</html>
<script src="croppie/croppie.js"></script>
<script src="demo.js"></script>
