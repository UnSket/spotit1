<?php 
if(file_exists($_POST['path']."history.txt")) {
	$fd = fopen($_POST['path']."history.txt", 'a+') or die("не удалось открыть файл");
} else {
	$fd = fopen($_POST['path']."history.txt", 'w') or die("не удалось открыть файл");

}
fwrite($fd, $_POST["name"].PHP_EOL);
fclose($fd);
echo basename($_POST['number'],".png") + 1;
?>