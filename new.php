<?php
$css_array = array('main.css', 'form.css');
$js_array = array('toolbar.js', 'form_check.js');
require_once("header.php");
echo '<div class="site-content">';
echo '<div class="container">';
$View = new View();


if (isset($_GET['cid'])) {
	$View->new_content_form($_GET['cid'], 1);
}
else if(isset($_GET['pid'])) {
	$View->new_content_form($_GET['pid'], 2);
} else {
	$View->new_content_form();
}


echo '</div>';
echo '</div>';
require_once("footer.php");
?>