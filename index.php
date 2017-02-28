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

if (isset($_GET['action'])) {
	if ($_GET['action'] == "logout") {
		$session->deleteSession();
		header('Location: index.php');
	}
}
$logged = false;
if ($session->exists('username')) {
	$logged = true;
}

/*if ($detect->isMobile() && !$detect->isTablet()) {*/
?> 

<?php
/*}
else{*/
?>

<!DOCTYPE>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="images/favicon.png">
		<title>Krazel</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
		<link rel="stylesheet" href="styles/style-index-desktop.css" media="all" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="js/scripts.js"></script>
		<script src="js/popup.js"></script>

		<link rel="stylesheet" href="styles/acordeon.css">
		<script src="js/acordeon.js"></script>
	</head>
	<div id = "everything">
		<div id = "header">	
			<div id="menu">
				<div id="div-left">
					<!-- <div id="nombre" align="right">
						<h1>Krazel</h1>
						<img src="images/Subtitle.png" id = "subtitle"/>
					</div> -->
					<div class="menuleft">
						<p><a href="index.php">HOME</a></p>
						<p><a href="new">NEW SQUARE </a></p>
						<p><a href="#">PROJECTS</a></p>
						<!-- <p><a href="#">CONTACT US</a></p> -->
					</div>
				</div>
				<div id="logo">
					<a href="index.php" style="border: none;"><img src="images/logo_alpha.png" id = "logo"/></a>
				</div>
				<div id="div-right" align="right">
					<!-- <div id="account">
						<input type="button"  value="Login">
					</div> -->
					<div class="menuright">
						<p><a href="#">LEARN MORE</a></p>
						<p><a href="#">FEEDBACK</a></p>
						<p><a href="#" id="login">LOGIN</a></p>
						<!-- <p><a href="#">ENIGMA</a></p> -->
					</div>
				</div>
			</div>
		</div>
		<div id="body">
			<div id="sorting">
				<div id="search"></div>
				<!-- <div class="filters" style="margin-right: 5px;"></div>
				<div class="filters"></div> -->
			</div>
			<div id="categories">
				<!-- <h2>CATEGORIES</h2> -->
				<?php 
					$categories->getCategories();
				?>
			</div>
			<div id="content">
				<div id="cont_square">
					
				</div>
				<div id="pag">
					<p id="pageinfo">Page # of #</p>
					<button id="previous" onclick="prvsPage();">Before</button>
					<button id="next" onclick="nextPage();">Next</button>
				</div>
			</div>
			<div id="ranking">
				<!-- <h2>RANKING</h2> -->
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
					<form method="post" id="loginform" action="src/login.php">
						<input type="text" id="username" name="User">
						<input type="password" id="passwd" name="Password">
						<br><input type="submit" value="Login">
					</form>
					<div class="error" hidden>Error!</div>
				</div>
			</div>
		</div>
		<!-- POP UP: end -->
	<link rel="stylesheet" type="text/css" href="styles/syle-popup.css">
</html>
<?php
/*}*/
?>