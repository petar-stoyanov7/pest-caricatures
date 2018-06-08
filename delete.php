<?php
$css_array = array('main.css');
$js_array = array('toolbar.js');
require_once('header.php');
$caricature_dao = new Caricature_DAO();
$post_dao = new Post_DAO();

echo '<div class="site-content">';
if (isset($_GET['cid'])) {	
	if (isset($_GET['y']) && $_GET['y'] == 1) {
		echo '<h4>DELETED</h4>';
		echo '<button id="back" onclick="history.go(-2)">Back</button>';
		$caricature_dao->delete_caricature($_GET['cid']);
	} else {
		$caricature = $caricature_dao->caricature_by_id($_GET['cid']);
		echo '<h4>Are you sure you want to delete the following caricature:<br>';
		echo '<br>Title: '.$caricature['title'];
		echo '<br>Description:'.$caricature['description'];
		echo '<br><button id="back" onclick="window.location.href = \'delete.php?cid='.$_GET['cid'].'&y=1\'">Yes</button> ';
		echo '<button id="back" onclick="window.history.back()">No</button>';
		echo '<br><br><img class="caricature" src='.$caricature['path'].'>';
	}
	
} else if (isset($_GET['pid'])) {
	if (isset($_GET['y']) && $_GET['y'] == 1) {
		echo '<h4>DELETED</h4>';
		echo '<button id="back" onclick="history.go(-2)">Back</button>';
		$post_dao->delete_post($_GET['pid']);
	} else {
		$post = $post_dao->post_by_id($_GET['pid']);
		echo '<h4>Are you sure you want to delete the following post:<br>';
		echo '<br>Title: '.$post['title'];
		echo '<br>Text:'.$post['text'];
		echo '<br><button id="back" onclick="window.location.href = \'delete.php?pid='.$_GET['pid'].'&y=1\'">Yes</button> ';
		echo '<button id="back" onclick="window.history.back()">No</button>';
	}
}
echo '</div>';



include('footer.php');
?>