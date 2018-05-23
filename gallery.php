<?php	
	$css_array = array('main.css', 'gallery.css');
	$js_array = array('toolbar.js');
	require_once("./obj/db.php");
	$db = new db();
	if(isset($_GET['gid'])) {
		$name = $db->get_data("SELECT name FROM `Categories` WHERE id=".$_GET['gid'])[0]['name'];
		$title = "Галерия ".$name;
	} else {	
		$title = "pest Галерия";
	}
	require_once('header.php');
	$caricature_dao = new Caricature_DAO();

	
	if(!isset($_GET['gid'])){
		$items = $db->get_data("SELECT * FROM `Categories`");
		echo '<div class="site-content">';
		foreach ($items as $item) {
			if ($item['thumb_id'] == 0 ) {
				$caricature_dao->auto_thumb($item['id']);
			}
			$thumb = $db->get_data("SELECT path FROM `Caricatures` WHERE id=".$item['thumb_id'])[0]['path'];
			echo "<div class='gallery-entry'>";
			echo "<a href='gallery.php?gid=".$item['id']."'>";
			echo "<h4 class='gallery-title'>".$item['name']."</h4>";
			echo "<img class='gallery-image' src='".$thumb."'>";
			echo "</a>";
			echo "</div>";		
		}
		echo '</div>';
	} else {
		$gid = $_GET['gid'];
		///TODO: Replace with proper function!
		$items = $db->get_data("SELECT * FROM `Caricatures` WHERE `cid`=".$gid);
		echo '<div class="site-content">';
		echo '<h3>Галерия '.$name.'</h3>';
		for ($i = 0; $i < sizeof($items); $i++) {
			$thumb = $items[$i]['path'];
			echo "<div class='gallery-entry'>";
			echo "<a href='caricature.php?cid=".$items[$i]['id']."'>";
			echo "<h4 class='gallery-title'>".$items[$i]['title']."</h4>";
			echo "<img class='gallery-image' src='".$thumb."'>";
			echo "</a>";
			echo $items[$i]['description'];
			echo "</div>";		
		}
		echo '</div>';
	}

?>
<!-- <div class='site-content'>


	<div class='gallery-entry'>
		<a href="caricature.php?caricature=sra">
			<h4 class='gallery-title'>Карикатури</h4>
			<img class='gallery-image' src='./static/sra.png'>
		</a>
	</div>

	<div class='gallery-entry'>
		<a href="caricature.php?caricature=rakiata">
			<h4 class='gallery-title'>Междуселски Войни</h4>
			<img class='gallery-image' src='./static/rakiata.png'>
		</a>
	</div>

	<div class='gallery-entry'>
		<a href="caricature.php?caricature=paladka">
			<h4 class='gallery-title'>БГ Супергерои</h4>
			<img class='gallery-image' src='./static/paladka.png'>
		</a>
	</div>

	<div class='gallery-entry'>
		<a href="caricature.php?caricature=kornelias">
			<h4 class='gallery-title'>Светът на Булгаркрафт</h4>
			<img class='gallery-image' src='./static/kornelias.png'>
		</a>
	</div>
	<br>

</div> -->
<?php
	require_once('footer.php');
?>