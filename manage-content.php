<?php
$css_array = array('main.css');
$js_array = array('toolbar.js');
ob_start();
require_once('header.php');
$Caricature_DAO = new Caricature_DAO();
$Post_DAO = new Post_DAO();

if (isset($_GET['make-cover'])) {
	$Caricature_DAO->make_cover($_GET['make-cover']);
	header("Location: gallery.php");
}

if (isset($_POST['update']) && $_POST['update'] == 1) {
	$action = "Updated ";
	if ($_POST['type'] == 'caricature') {
		$type = "a caricature";
		$id = $_POST['id'];
		if (!empty($_FILES['file-upload']['name'])) {
			$Caricature_DAO->update_caricature($_POST, $id, $_FILES);
		} else {
			$Caricature_DAO->update_caricature($_POST, $id);
		}
	}
	if ($_POST['type'] == 'post') {
		$type = "a post";
		$id = $_POST['id'];
		$Post_DAO->update_post($_POST, $id);
	}
}

else if ($_POST['type'] == "caricature" && !isset($_POST['update'])) {
	$action = "Created new ";
	$type = "caricature";
	if (!empty($_FILES['file-upload']['name']) && !empty($_POST['title'])) {
		$Caricature_DAO->add_new_caricature($_POST, $_FILES);
	} else {
		die("Invalid entry!");
	}
} else if ($_POST['type'] == "post" && !isset($_POST['update'])) {
	$type = "post";
	if (isset($_POST)) {
		$Post_DAO->add_new_post($_POST);
	}
} else {
	die("invalid entry");
}
echo '<div class="site-content">';
echo $action.$type.'<br>';
///header("refresh:1; url=new.php");
echo '</div>';
ob_end_flush();
include('footer.php'); 

?>