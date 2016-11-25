<?php 
spl_autoload_register(function ($className){
	require 'src/'.$className.'.php';
});

$detect = new Mobile_Detect;

$connection = new dataBase();
$connection->connect();

$session = new Session();
$session->startSession();

$squares = new Square();

$categories = new Category();

if ($detect->isMobile() && !$detect->isTablet()) {
?> 
	<!DOCTYPE html>
	<html>
	<head>
		<link rel="icon" href="images/favicon.png">
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	    <title>Krazel - Mobile</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
		<link rel="stylesheet" href="styles/style-index.css">
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		<script>
			$(document).ready(function(){
				$( document ).on( "swipeleft swiperight", "#krazel-everything", function(e) {
					if ( $.mobile.activePage.jqmData("panel") !== "open"){
						if (e.type === "swipeleft"){
							$("#right-panel").panel("open");
						} else if (e.type === "swiperight"){
							$("#left-panel").panel("open");
						}
					}
				});
			});
	    </script>
	</head>
	<body>
	<div data-role="page" id="krazel-everything">
	    <div id="krazel-content-page" data-role="content">
	    	<div id = "krazel-page">
				<div id="krazel-icons">
					<a href="#left-panel" ><img style="width: 25px;" src="images/categories50.png"></a>
					<a href="#right-panel" style="float:right;"><img style="width: 25px;"" src="images/ranking50.png"></a>
				</div>
				<div id ="krazel-header">
					<div id="krazel-nombre">
						<h1>Krazel</h1>
						<img src="images/Subtitle.png" id = "subtitle"/>
					</div>
					<div id="krazel-logo">
						<img src="images/logo_alpha.png"/>
					</div>
				</div>
				<div id="krazel-body">
					<div id="krazel-content">
						CONTENT
					</div>
				</div>
			</div>
	    </div><!-- /content -->

	    <div data-role="panel" id="left-panel" data-display="push" data-position="left">

	    	<p>CATEGORIES</p>
			<a href="#" data-rel="close" data-role="button" data-mini="true" data-inline="true" data-icon="delete" data-iconpos="right">Close</a>

	    </div><!-- /panel -->

	    <div data-role="panel" id="right-panel" data-display="push" data-position="right">

	    	<p>RANKING</p>
			<a href="#" data-rel="close">Close</a>

	    </div><!-- /panel -->

	</div><!-- /page -->
	</body>
	</html>
				<!-- <a <div style="float: left; margin-left: 20px;" align="right">
							<div id="account";>
								account
							</div>
						</div></a>









						<div id="krazel-select">
						<select>
						  <option value="volvo">HOME</option>
						  <option value="saab">NEW SQUARE</option>
						  <option value="mercedes">EVENTS</option>
						  <option value="audi">CONTACT US</option>
						  <option value="volvo">ABOUT US</option>
						  <option value="saab">UPDATES</option>
						  <option value="mercedes">WHAT'S THIS</option>
						  <option value="audi">ENIGMA</option>
						</select>
					</div> -->



<?php
}
else{
?>

<!DOCTYPE>
<html>
	<head>
		<link rel="icon" href="images/favicon.png">
		<title>Krazel</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
		<link rel="stylesheet" href="styles/style-index-desktop.css" media="all" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="js/scripts.js"></script>
		<script src="js/popup.js"></script>
	</head>
	<div id = "everything">
		<div id = "header">	
			<div id="menu">
				<div id="div-left">
					<div id="nombre" align="right">
						<h1>Krazel</h1>
						<img src="images/Subtitle.png" id = "subtitle"/>
					</div>
					<div class="menuleft">
						<p><a href="index.php">HOME</a></p>
						<p><a href="new">NEW SQUARE </a></p>
						<p><a href="#">EVENTS</a></p>
						<p><a href="#">CONTACT US</a></p>
					</div>
				</div>
				<div id="logo">
					<p><a href="?" style="border: none;"><img src="images/logo_alpha.png" id = "logo"/></a></p>
				</div>
				<div id="div-right" align="right">
					<div id="account";>
						<input type="button" id="login" value="Login">
					</div>
					<div class="menuright">
						<p><a href="#">ABOUT US</a></p>
						<p><a href="#">UPDATES</a></p>
						<p><a href="#">WHAT'S THIS</a></p>
						<p><a href="#">ENIGMA</a></p>
					</div>
				</div>
			</div>
		</div>
		<div id="body">
			<div id="categories">
				<h2>CATEGORIES</h2>
				<?php 
					$categories->getCategories();
				?>
			</div>
			<div id="content">
				<div id="pag">
					<p id="pageinfo">Page # of #</p>
					<button id="previous" onclick="prvsPage();">Before</button>
					<button id="next" onclick="nextPage();">Next</button>
				</div>
				<div id="cont_square">
					
				</div>
			</div>
			<div id="ranking">
				<h2>RANKING</h2>
				<?php
					$squares->getRanking();
				?>
			</div>
		</div>
	</div>
	<!-- POP UP: start -->
		<div class="poppy" id="popup-1" hidden="true">
			<div id="poppyleft">
				
			</div>
			<div id="poppyright">
				<div id="form">
					<h3>Log in</h3>
					<input type="text" name="User">
					<input type="password" name="Password">
					<input type="button" name="Enter" value="Enter">
				</div>
			</div>
		</div>
		<!-- POP UP: end -->
	<link rel="stylesheet" type="text/css" href="styles/syle-popup.css">
</html>
<?php
}
?>