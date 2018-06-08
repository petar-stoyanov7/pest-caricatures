<?php
	function __autoload($classname) {
		require_once("./obj/".$classname.".php");
	}
	require_once("functions.php");
	$View = new View();
	$View->first_visit();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="Content-Language" content="bg">
	<link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
<?php
	if (!isset($title)) {
		$title = "pest карикатури";
	}
	foreach ($css_array as $css) {
		echo '<link rel="stylesheet" type="text/css" href="./css/'.$css.'">';
	}
	echo '<link rel="stylesheet" type="text/css" href="./css/popup.css">';
	/// moved in the footer. Some scripts relied on content being already generated.
	// foreach ($js_array as $js) {
	// 	echo '<script type="text/javascript" src="./js/'.$js.'"></script>';
	// }
	echo '<title>'.$title.'</title>';
?>
	
	
	
</head>
<body>
<header>	
	<div class="site-logo">
		<img class="site-logo" src="./img/logo.png">
	</div>
	<div class='top-navigation'>
	</div>
</header>
<div id='anchor'></div>
<?php $View->show_toolbar(); ?>		
