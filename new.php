<?php
ob_start();
$css_array = array('main.css', 'form.css');
$js_array = array('toolbar.js', 'form_check.js');
require_once("header.php");
echo '<div class="site-content">';
echo '<div class="container">';
$View_Admin = new View_Admin();


if (isset($_GET['cid'])) {
	$View_Admin->new_content_form($_GET['cid'], 1);
}
else if(isset($_GET['pid'])) {
	$View_Admin->new_content_form($_GET['pid'], 2);
} else {
	$View_Admin->new_content_form();
}


echo '</div>';
echo '</div>';
ob_end_flush();
require_once("footer.php");
?>