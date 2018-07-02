<?php
function __autoload($classname) {
	require_once("./obj/".$classname.".php");
}
$View_Admin = new View_Admin();

if (isset($_GET['users'])) {
	if ($_GET['users'] == 'new') {
		$View_Admin->new_user_form();
	} else {		
		$View_Admin->list_users();
	}
} else if (isset($_GET['categories'])) {
	if ($_GET['categories'] == 'new') {
		$View_Admin->new_category_form();
	} else {
		$View_Admin->list_categories();
	}
} else {
	echo "KUR";
}


?>