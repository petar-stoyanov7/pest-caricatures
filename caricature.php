<?php
	$css_array = array('main.css', 'caricature.css');
	$js_array = array('toolbar.js');
	require_once('header.php');

	$caricature = $_GET['caricature'];
	# This must be removed later on - intended just to show some titles!
	switch ($caricature) {
		case 'sra':
			$title = "Сра процедури";
			$description = "Мястото за релакс, отпускане на душата и други неща.";
			$prev = 'paladka';
			$next = 'rakiata';
			break;
		case 'rakiata':
			$title = "Ракията се пробужда";
			$description = "Пиян Соло и Чичака в поредното им приключение в земите на Шоплъка!";
			$prev = 'sra';
			$next = 'kornelias';			
			break;
		case 'kornelias':
			$title = "Корнелиас Нинрънър";
			$description = "Кралицата-банши на пенсионираните!";
			$prev = 'rakiata';
			$next = 'paladka';
			break;
		case 'paladka':
			$title = "ПалаДка";
			$description = "Вече къмпингуването е разрешено. В орпеделените за целта места. И при плащането на определените от \"държавата\" хора";
			$prev = 'kornelias';
			$next = 'sra';
			break;		
		default:
			break;
	}
?>

<div class='site-content'>
<?php
	echo "<h1 class='caricature-title'>".$title."</h1>";
	echo "<a href='./static/".$caricature.".png' target='_blank'>";
	echo "<img class='caricature' src='./static/".$caricature.".png'>";
	echo "</a>";
	echo "<span class='caricature-description'>".$description."</span><br>";
	echo "<a id='caricature-prev' href='caricature.php?caricature=".$prev."'> << </a>";
	echo "<a id='caricature-next' href='caricature.php?caricature=".$next."'> >> </a>";
	echo '<script type="text/javascript" src="./js/navigate.js"></script>'
?>
</div>

<?php require_once('footer.php'); ?>
