<?php
	
	$css_array = array('main.css', 'caricature.css');
	$js_array = array('toolbar.js', 'navigate.js');
	require_once('header.php');

	$caricature_dao = new Caricature_DAO();
	$View = new View();
	
	# This must be removed later on - intended just to show some titles!
	## Why not titties?!
?>

<div class='site-content'>
<?php
	$View = new View();
	
	if (!isset($_GET['cid']) || $_GET['cid'] == "" || 
		(isset($_GET['random']) && $_GET['random'] == 1)
		) {
		$caricature_id = $caricature_dao->random_caricature();
		$Caricature = $caricature_dao->caricature_by_id($caricature_id);
		$title = "[ Случайна ] ".$Caricature['title'];
		$View->set_title("Случайна карикатура");
		$next = "random=1";
		$previous = "random=1";
	} else {
		$caricature_id = $_GET['cid'];
		$gallery_id = $caricature_dao->get_category_by_id($caricature_id);
		$Caricature = $caricature_dao->caricature_by_id($caricature_id);		
		if (!isset($Caricature['id'])) {
			header("Location: caricature.php?random=1");
		}		
		$title = $Caricature['title'];
		$View->set_title($title);
		$next_id = $caricature_dao->next_caricature($caricature_id, $gallery_id);
		$previous_id = $caricature_dao->previous_caricature($caricature_id, $gallery_id);
		$next = "cid=".$next_id;
		$previous = "cid=".$previous_id;
	}
	$View->show_edit_content($Caricature['id'], 1);	
	$View->show_caricature($Caricature, $next, $previous, $title);
	
?>

</div>

<?php require_once('footer.php'); ?>
