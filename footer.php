<footer>
	<div class='footer'>
		<font size="2">
		Сайтът е измислен, създаден и относително осран от pest. Всички права и свободи запазени! За <a href='./about.php' style="text-decoration: none; color: black">контакти</a> - ползвайте разклонител.<br>					
		</font>
		<font size="2">
			pest media 0.0.1
		</font>
	</div>
</footer>
<?php
	foreach ($js_array as $js) {
		echo '<script type="text/javascript" src="./js/'.$js.'"></script>';
	}
?>
</body>
</html>