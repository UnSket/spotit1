<?php header("Content-type; text/html; charset=utf-8"); 
header ("Cache-Control: no-cache, must-revalidate");?>
<!DOCTYPE>
<html>
	
	<head>
		<title>spot it</title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link href="../main/style.css" rel="stylesheet"> 
	</head>
	<body>
	<script type="text/javascript" src="../jquery-1.9.1.min.js"></script>
	<?php if(!isset($_COOKIE['project'])) { ?>
			<script>
			window.location.href = "../main/main.php";
			</script>
		<?php }
	$path="../projects/".$_COOKIE['project']."/";
	if(isset($_FILES['backside'])){
			move_uploaded_file($_FILES['backside']['tmp_name'], $path.'backside.png'); 
		}
		if(isset($_POST['inf'])) {
			$fd = fopen($path."backsideInf.txt", 'w') or die("не удалось открыть файл");
			fwrite($fd, $_POST['inf'].PHP_EOL);
			fclose($fd);
		} 
	if (file_exists($path."backside.png")) {
		if(file_exists($path."backsideInf.txt")) {
			$fd = fopen($path."backsideInf.txt", 'r') or die("не удалось открыть файл");
			$str = htmlentities(fgets($fd));
			$str = preg_split("/[\s]+/", $str);
			?>
			<img src="<?php echo $path.'backside.png'; ?>" width=<?php echo $str[2]."px"; ?> height=<?php echo $str[2]."px"; ?> style="position: absolute; left:<?php echo (intval($str[1])+15)."px"; ?>;
			top: <?php echo (intval($str[0])+15)."px"; ?>;" id="backside">
		<?php } else { ?>
			<img src="<?php echo $path.'backside.png'; ?>" width=336px height=336px style="position: absolute; left: 15px; top: 15px;" id="backside">
		<?php } ?>
	<img src="<?php echo $path.'background.png'; ?>" width=336px height=336px style="position: absolute; left: 15px; top: 15px; cursor:pointer;" id="bg">
	<?php } ?>
	<form method="post" enctype="multipart/form-data" style="position: absolute; top: 350px; width:336px;">
	<p style="text-align:center;">Upload backside image</p>
		<div class="file-upload"><label>
			<input type="file" accept="image/*" id="file3" name="backside">
			<span>CHOOSE FILE</span>
		</label></div>
		<p id="filename3" style="text-align:center;"></p>
		<div id="preview3" style="display:none">
			<img src="" id="imgg3" width="150px" height="150px"></br>
		</div>
		<input type="submit" value="Save" id="save" style="text-align: center; position: relative; left: 90px;">
		<input type="hidden" value="" id="inf" name="inf">
		<input type="button" value="Back" style="text-align: center; position: relative; left: 180px;" id="back"> </br>
		<input type="button" value="Open as 1 image" style="text-align: center; position: relative; left: 110px; margin-top:15px;" id="asImageBut">
	</form>
	<div class="messege">
		<h2>Messege</h2>
		<p id="messegeText"></p>
		<input type="button" id="commitMesesge" value="OK" style="vertical-align:bottom;">
	</div>
	<script src="backside.js"></script>
	</body>
</html>