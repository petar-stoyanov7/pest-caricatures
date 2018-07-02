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
$Timeline_DAO = new Timeline_DAO();
//timeline
$elements_per_page = 10;

if (isset($_GET['posts'])) {
	$view->display_timeline($page, $elements_per_page, true);
	$num_pages = $view->number_of_pages($elements_per_page, 2);
	$post = "&posts";
} else {
	$view->display_timeline($page, $elements_per_page);
	$post = "";
	$num_pages = $view->number_of_pages($elements_per_page);
	if ( $page > $num_pages ) {
		$page = $num_pages;
	}
}

//next\previous pages
$view->newline(3);
$view->index_previous($page, $post);
$view->index_next($page, $post);
$view->newline(2);
$view->index_pages($num_pages, $post);
$view->newline(2);

if ($page == 1) {
	echo '<script type="text/javascript" src="./js/index.js"></script>';
	echo '<script type="text/javascript">disablePrevious()</script>';
}
if ($page == $num_pages) {
	echo '<script type="text/javascript" src="./js/index.js"></script>';
	echo '<script type="text/javascript">disableNext()</script>';
}

///EOF
require_once('footer.php'); 

?>