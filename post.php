<?php
$css_array = array('main.css', 'post.css');
$js_array = array('toolbar.js');
include('header.php');
$Post_DAO = new Post_DAO();
$View = new View();

if (!isset($_GET['pid'])) {
	header('Location: index.php');
} else {
	$pid = $_GET['pid'];
	$post = $Post_DAO->post_by_id($pid);
	if (!isset($post['id'])) {
		header('Location: index.php');
	}
	$title = ($post['title']);
	$View->set_title($title);

	echo '<div class="site-content">';
	$View->show_edit_content($pid, 2);
	$View->show_post($post);
	

	echo '</div>';
}

include('footer.php');
?>