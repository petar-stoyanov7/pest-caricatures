<?php
	
	$css_array = array('main.css', 'caricature.css');
	$js_array = array('toolbar.js', 'navigate.js');
	require_once('header.php');

	$caricature_dao = new Caricature_DAO();
	
	# This must be removed later on - intended just to show some titles!
	## Why not titties?!
?>

<div class='site-content'>
<?php
	
	if (!isset($_GET['cid']) || $_GET['cid'] == "" || 
		(isset($_GET['random']) && $_GET['random'] == 1)
		) {
		$caricature_id = $caricature_dao->random_caricature();
		$Caricature = $caricature_dao->caricature_by_id($caricature_id);
		$title = "[ Случайна ] ".$Caricature['title'];
		$next = "random=1";
		$previous = "random=1";
	} else {
		$caricature_id = $_GET['cid'];
		$gallery_id = $caricature_dao->get_category($caricature_id);
		$Caricature = $caricature_dao->caricature_by_id($caricature_id);
		$title = $Caricature['title'];
		$next_id = $caricature_dao->next_caricature($caricature_id, $gallery_id);
		$previous_id = $caricature_dao->previous_caricature($caricature_id, $gallery_id);
		$next = "cid=".$next_id;
		$previous = "cid=".$previous_id;
	}
	echo "<h1 class='caricature-title'>".$title."</h1>";
	echo "<a href='".$Caricature['path']."' target='_blank'>";
	echo "<img class='caricature' src='".$Caricature['path']."'>";
	echo "</a>";
	echo "<span class='caricature-description'>".$Caricature['description']."</span><br>";
	echo "<a id='caricature-prev' href='caricature.php?".$previous."'> << </a>";
	echo "<a id='caricature-next' href='caricature.php?".$next."'> >> </a>";
	
	echo '<script type="text/javascript">document.title = <?= json_encode($title) ?>;</script>';
	
?>

</div>

<?php require_once('footer.php'); ?>
