<?php
	$css_array = array('main.css', 'timeline.css');
	$js_array = array('toolbar.js', 'index.js');
	require_once('header.php');

?>

<div class="site-content">	
<?php
if (!isset($_GET['p']) || $_GET['p'] < 1) {
	$page = 1;
} else {
	$page = $_GET['p'];
}
$view = new View();
$t_dao = new Timeline_DAO();
//timeline
$elements_per_page = 15;
$num_pages = $view->number_of_pages($elements_per_page);
if ($page > $num_pages ) {
	$page = 1;
}

$view->display_timeline();

//next/previous pages
$view->index_previous($page);
$view->index_next($page);
$view->index_pages($num_pages);
//in future maybe display pages:
//echo '<span class="pages">[ 1,2,3,4,5 ]</span>';

if ($page == 1) {
	echo '<script type="text/javascript" src="./js/index.js"></script>';
	echo '<script type="text/javascript">disablePrevious()</script>';
}



///EOF
require_once('footer.php'); 

?>