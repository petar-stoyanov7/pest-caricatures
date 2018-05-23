<?php
	require_once("./obj/db.php");
	function dt($text, $desc="") {
		echo "########## ".$desc." ##########";
		echo "<pre>";
		print_r($text);
		echo "</pre>";
		echo "######### /".$desc." ##########<br>";
	}

	function cyr_lat($string) {
		$cyr = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
        ];
        $lat = [
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
            'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
            'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya'
        ];
        return str_replace($cyr, $lat, $string);
	}

	function clean_string($string) {
		$string = str_replace(' ', '_', $string);
		$string = cyr_lat($string);
		$string = preg_replace('/[^A-Za-z0-9\_\.]/', '', $string);
   		return strtolower($string);
	}	
?>