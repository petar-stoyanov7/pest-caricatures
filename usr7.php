<?php
$css_array = array('main.css', 'form.css', 'usr.css');
$js_array = array(/* 'toolbar.js', */ 'usr7.js');
$title = "User management.";
require('header.php');
$View = new View();
$User_DAO = new User_DAO();
echo '<div class="usr-container">';
$View->new_user_form();


echo '</div>';
if (!empty($_POST)) {
	if ($_POST['operation'] == "new") {
		$User = new User($_POST['new-user'], $_POST['new-password'], 
			$_POST['email'], $_POST['full-name'], $_POST['group'], $_POST['sex'], $_POST['notes']);
		$User_DAO->add_user($User);
	} else if ($_POST['operation'] == "login" || empty($_POST['operation'])) {
		$User = new User($_POST['username'], $_POST['password']);
		$User_DAO->login($User);
	}
}
require('footer.php');
// if (!$User_DAO->check_if_admin()) {	
// 	echo '<script type="text/javascript">disableNewUser()</script>';
// }
?>