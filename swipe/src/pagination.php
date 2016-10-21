<?php
require('dataBase.php');
require('Category.php');

$connection = new dataBase();
$connection->connect();



if (isset($_POST['page'])) {
	//$info = pagination($_POST['page'], $_POST['cat'], $connection);
	printSquares($_POST['page'], $_POST['cat'], $connection);
}
else{
	//$info = pagination(1, null, $connection);
	printSquares(1, null, $connection);
}


function printSquares($page, $cat_id, $connection){
		$categories = new Category();
		if($cat_id != null){
			echo '<h2>'.$categories->getCategory($cat_id).'</h2>';
		}
		echo'<div id="wrap">';
		$result = pagination($page, $cat_id, $connection);
		$count=1;
		foreach ($result as $row) {
			if($page == 1){
				switch ($count) {
				    case 1:
				        $style="fst-post";
				        break;
				    case 2:
				    case 3:
				    	$style = "snd-post";
				        break;
				    case 4:
				    case 5:
				    case 6:
				    case 7:
				        $style = "page-post";
				        break;
				    default:
				    	$style = "normal-post";
				}
			}
			else{
				$style = "normal-post";
			}
			$ids = $row["ids"];
			$title = $row["title"];
			$user = $row["user"];
			$url = $row["url"];
			$img = $row["img"];
			$suma = $row["suma"];
			?>
			<div class="<?php echo $style;?>">
				<a href="<?php echo $url;?>"><img src="<?php echo $img; ?>"></a>
				<?php
				echo '<h5>'.$title.' | K: '.$suma.$user.'</h5>';
				?>
			</div>
			<?php 
			$count++;
		}
		echo '</div>';
}

function pagination($page, $cat_id = null, $connection){
	$total = countSquares($cat_id, $connection);
	$last = 1+intval(ceil(($total-7)/12));
	
	if($page < 1){
		$page = 1;
	}
	elseif ($page > $last) {
		$page = $last;
	}
	

	if ($page == 1) {
		if($cat_id == null){
			$sql = 'SELECT s.id_square as "ids", s.title as "title", s.url as "url", s.image as "img", SUM(p.quantity) as "suma", u.username as "user" FROM squares s, payments p, users u WHERE s.id_square = p.id_square AND s.id_user = u.id_user GROUP BY s.id_square ORDER BY suma desc LIMIT 7;';
		}
		else{
			$sql = 'SELECT s.id_square as "ids", s.title as "title", s.url as "url", s.image as "img", SUM(p.quantity) as "suma", u.username as "user" FROM squares s, payments p, users u, square_category c WHERE s.id_square = p.id_square AND s.id_user = u.id_user AND c.id_square = s.id_square AND c.id_category = '.$cat_id.' GROUP BY s.id_square ORDER BY suma desc LIMIT 7;';
		}
	}
	else {
		$offset = ($page-1)*12+7; 
		if($cat_id == null){
			$sql = 'SELECT s.id_square as "ids", s.title as "title", s.url as "url", s.image as "img", SUM(p.quantity) as "suma", u.username as "user" FROM squares s, payments p, users u WHERE s.id_square = p.id_square AND s.id_user = u.id_user GROUP BY s.id_square ORDER BY suma desc LIMIT 12 OFFSET '.$offset.';';
		}
		else{
			$sql = 'SELECT s.id_square as "ids", s.title as "title", s.url as "url", s.image as "img", SUM(p.quantity) as "suma", u.username as "user" FROM squares s, payments p, users u, square_category c WHERE s.id_square = p.id_square AND s.id_user = u.id_user AND c.id_square = s.id_square AND c.id_category = '.$cat_id.' GROUP BY s.id_square ORDER BY suma desc LIMIT 12 OFFSET '.$offset.';';
		}
	}
	$result = $connection->getData($sql);
	return $result;
	/*
	$row = mysqli_fetch_assoc($result);
	$data = array();
	foreach ($result as $row) {
		array_push($data, $row);
	}
	$encoded = json_encode($data);

	return $encoded;*/
}
function countSquares($cat_id = null, $connection){
	if($cat_id == null){
		$sql = 'SELECT count(id_square) as "count" FROM squares;';
	}
	else{
		$sql = 'SELECT count(id_square) as "count" FROM square_category WHERE id_category = '.$cat_id.';';
	}
	$result = $connection->getData($sql);
	$row = mysqli_fetch_assoc($result);

	return intval($row['count']); 
}