<?php	
	$css_array = array('main.css', 'gallery.css');
	$js_array = array('toolbar.js');
	require_once('header.php');
	$View = new View();

	
	if(!isset($_GET['gid'])){
		$View->show_gallery();
	} else {
		$gid = $_GET['gid'];
		$View->show_gallery($_GET['gid']);
	}


	require_once('footer.php');
?>