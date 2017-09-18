<?php 
$history = file($_POST['path']."history.txt");
$history[$_POST['num'] - 1] = $_POST['newName'].PHP_EOL;
$fd = fopen($_POST['path']."history.txt", 'w') or die("не удалось открыть файл");
foreach($history as $inf){
	fwrite($fd, $inf);
}
fclose($fd);
?>