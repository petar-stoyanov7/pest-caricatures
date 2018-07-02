<?php
$css_array = array('main.css');
$js_array = array('toolbar.js', 'mng13.js');
$title = "[ adm pnl ]";
ob_start();
require_once('header.php');
$Caricature_DAO = new Caricature_DAO();
$Post_DAO = new Post_DAO();
$User_DAO = new User_DAO();

echo '<div class="site-content">';	
if ($User_DAO->check_if_admin()) {
	$View_Admin = new View_Admin();

	if (isset($_GET['categories'])) {
		$View_Admin->new_category_form();
	} 
	else if (isset($_GET['users'])) {
		$View_Admin->new_user_form();
	} else {
		$View_Admin->show_options_menu();
	}	
} else {
	View::login_form();
}

echo '</div>';

ob_end_flush();
include('footer.php'); 
?>