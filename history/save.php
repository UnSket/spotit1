<?php 
	if(!is_dir($_POST['path']."/history")) {
		mkdir($_POST['path']."/history");
	}
	$fd = fopen($_POST['path']."/history/imgs.txt", 'w') or die("не удалось открыть файл");
	foreach ($_POST['imgs'] as $img) {
		fwrite($fd, $img.PHP_EOL);
	}
	fclose($fd);
	$fd = fopen($_POST['path']."/history/texts.txt", 'w') or die("не удалось открыть файл");
	foreach ($_POST['texts'] as $text) {
		fwrite($fd, $text.PHP_EOL);
	}
	fclose($fd);
?>