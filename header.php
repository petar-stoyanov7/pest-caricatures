<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="Content-Language" content="bg">
	<link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
<?php
	foreach ($css_array as $css) {
		echo '<link rel="stylesheet" type="text/css" href="./css/'.$css.'">';
	}

	foreach ($js_array as $js) {
		echo '<script type="text/javascript" src="./js/'.$js.'"></script>';
	}

?>
	
	
	<title>Карикатури pest</title>
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
<div id='navigation-bar'>
		<div class='navbar'>
			<span class='navbar-entry'>
				<a href="./index.php">HOME</a>
			</span>
			<span class='navbar-entry'>
				<a href="gallery.php">GALLERY</a>
			</span>
			<span class='navbar-entry'>
				<a href="about.php">ABOUT</a>
			</span>
		</div>
	</div>