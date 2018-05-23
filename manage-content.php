<?php
$css_array = array('main.css');
$js_array = array('toolbar.js');
require_once('header.php');
$caricature_dao = new Caricature_DAO();
$post_dao = new Post_DAO();
if ($_POST['type'] == "caricature") {
	if (isset($_FILES['file-upload']) && isset($_POST)) {
		$caricature_dao->add_new_caricature($_POST, $_FILES);
	}
} else if ($_POST['type'] == "post") {
	if (isset($_POST)) {
		$post_dao->add_new_post($_POST);
	}
} else {
	die("invalid entry");
}
?>
<div class='site-content'>
	<button id="back" onclick="window.history.back()">Back</button>
</div>
<?php include('footer.php'); ?>