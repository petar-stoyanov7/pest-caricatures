<?php
$css_array = array('main.css');
$js_array = array('toolbar.js');
ob_start();
require_once('header.php');
$User_DAO = new User_DAO();
$Caricature_DAO = new Caricature_DAO();
echo '<div class="site-content">';

if (empty($_GET) && empty($_POST)) {
	header("Location: index.php");
} else {
	if (!empty($_POST['type'])) {
		###Management:
		if ($_POST['type'] == 'user') {
			##user management
			if (!empty($_POST['update'])) {
				#update user
				$User = new User($_POST['new-user'], $_POST['new-password'], $_POST['email'], 
					$_POST['full-name'], $_POST['group'], $_POST['sex'], $_POST['notes']);
				$User_DAO->update_user($User);
			} else if (!empty($_POST['delete'])) {
				#delete user
				$User = new User($_POST['new-user'], "");
				$User_DAO->delete_user($User);
			} else if (empty($_POST['update']) && empty($_POST['delete'])) {
				#new user
				$User = new User($_POST['new-user'], $_POST['new-password'], $_POST['email'], 
					$_POST['full-name'], $_POST['group'], $_POST['sex'], $_POST['notes']);
				$User_DAO->add_user($User);
			} 
		} else if ($_POST['type'] == 'category') {
			##category management
			if (!empty($_POST['update'])) {
				#update category
				$Caricature_DAO->update_category($_POST['id'], $_POST['category-name'], $_POST['category-description']);
			} else if (!empty($_POST['delete'])) {
				#delete category
				$Caricature_DAO->delete_category($_POST['id']);
			} else if (empty($_POST['delete']) && empty($_POST['update'])) {
				#new category
				$Caricature_DAO->new_category($_POST['category-name'], $_POST['category-description']);
			}
		}

		header('Refresh: 1; url=mng13.php');

	} else if (!empty($_POST['username']) && !empty($_POST['password'])) {
		###login
			$User = new User($_POST['username'], $_POST['password']);
			if ($User_DAO->login($User)) {
				echo "Redirecting";
				header("Refresh: 1; url=index.php");
			} else {
				echo "Invalid login";
			}
	}	
}
echo '</div>';

ob_end_flush();
include('footer.php');
?>