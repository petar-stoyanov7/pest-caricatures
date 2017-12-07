<?php
	$css_array = array('main.css', 'gallery.css');
	$js_array = array('toolbar.js');
	require_once('header.php');
?>
<div class='site-content'>


	<div class='gallery-entry'>
		<a href="caricature.php?caricature=sra">
			<h4 class='gallery-title'>Карикатури</h4>
			<img class='gallery-image' src='./static/sra.png'>
		</a>
	</div>

	<div class='gallery-entry'>
		<a href="caricature.php?caricature=rakiata">
			<h4 class='gallery-title'>Междуселски Войни</h4>
			<img class='gallery-image' src='./static/rakiata.png'>
		</a>
	</div>

	<div class='gallery-entry'>
		<a href="caricature.php?caricature=paladka">
			<h4 class='gallery-title'>БГ Супергерои</h4>
			<img class='gallery-image' src='./static/paladka.png'>
		</a>
	</div>

	<div class='gallery-entry'>
		<a href="caricature.php?caricature=kornelias">
			<h4 class='gallery-title'>Светът на Булгаркрафт</h4>
			<img class='gallery-image' src='./static/kornelias.png'>
		</a>
	</div>
	<br>

</div>
<?php
	require_once('footer.php');
?>