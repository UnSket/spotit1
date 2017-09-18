<!DOCTYPE>
<html>
	
	<head>
		<title>spot it</title>
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link media="screen" rel="stylesheet" href="lookStyle.css">
	</head>
	<body>
	<script type="text/javascript" src="../jquery-1.9.1.min.js"></script>
	<?php if(!isset($_COOKIE['project']) or !isset($_POST['step'])){
		?>
			<script>
			window.location.href = "../main/main.php";
			</script>
		<?php
			
		}
		else{ $path="../projects/".$_COOKIE['project']."/";
		}
		if($_POST['step']!=11) $num=7;
		else $num=57;
		for($i=1;$i<$num;$i++) {
		?>
	<canvas height='336px' width='336px' id='example<?php echo $i; ?>' style="position:absolute; top:<?php  echo intval(($i-1)/3) * 336; ?>px; left:<?php echo (($i-1)%3)*336; ?>px;"></canvas>
	<?php } ?>
	<form action="look.php" method="POST" style="position:relative; top:<?php echo (($num-1)/6)*684; ?>px; left: 470px;">
		<input type="hidden" name="step" value="<?php echo $_POST['step']; ?>">
		<input type="submit" value="Back">
	</form>
  </body>
  <script>  
	<?php for($i=1; $i<$num;$i++){
	$path="../projects/".$_COOKIE['project']."/";
	if($num!=57){
			if(file_exists($path."inf".($i + ($_POST['step'] - 1) * 6).".txt"))
				$fd = fopen($path."inf".($i + ($_POST['step'] - 1) * 6).".txt", 'r') or die("не удалось открыть файл");
			else
				$fd = fopen("../projects/"."inf".($i + ($_POST['step'] - 1) * 6).".txt", 'r');
	} else {
		if(file_exists($path."inf".$i.".txt"))
			$fd = fopen($path."inf".$i.".txt", 'r') or die("не удалось открыть файл");
		else
			$fd = fopen("../projects/"."inf".$i.".txt", 'r');
	}?>
	example<?php echo $i; ?> = document.getElementById("example<?php echo $i; ?>");
	ctx<?php echo $i; ?> = example<?php echo $i; ?>.getContext('2d');
	var img<?php echo $i; ?> = new Image();
	<?php
	$n=1; ?>
	img<?php echo $i; ?>.src="bg.png";
	img<?php echo $i; ?>.onload = function(){
		ctx<?php echo $i; ?>.save();
		ctx<?php echo $i; ?>.drawImage(img<?php echo $i; ?>, 0, 0, 336, 336);
		<?php newImage($n, $fd, $path, $i); ?>
	}  
	
	<?php }
	function newImage($n, $fd, $path, $i){
			$n++;
			$str1 = htmlentities(fgets($fd));
			$str = preg_split("/[\s]+/", $str1);
			preg_match("/[0-9]+/", $str[2], $q);
			$angle = $q[0];
			$angle = $angle * 3.14 / 180;
		?>
	
	img<?php echo $i; ?>.src = '<?php echo $path.basename($str[4]); ?>';  
	img<?php echo $i; ?>.onload = function() {
		ctx<?php echo $i; ?>.save();
		ctx<?php echo $i; ?>.translate(<?php echo $str[1]; ?>, <?php echo $str[0]; ?>); 
		ctx<?php echo $i; ?>.translate(<?php echo $str[3]; ?>/2, <?php echo $str[3]; ?>/2); 
		ctx<?php echo $i; ?>.rotate(<?php echo $angle; ?>);
		ctx<?php echo $i; ?>.drawImage(img<?php echo $i; ?>, <?php echo -$str[3]/2; ?>, <?php echo -$str[3]/2; ?>, <?php echo $str[3]; ?>, <?php echo $str[3]; ?>);
		ctx<?php echo $i; ?>.restore();
		<?php if($n==9){ ?>
			img<?php echo $i; ?>.src="<?php echo $path."background.png"; ?>";
			img<?php echo $i; ?>.onload = function(){
				ctx<?php echo $i; ?>.save();
				ctx<?php echo $i; ?>.drawImage(img<?php echo $i; ?>, 0, 0, 336, 336);
			 } 
		<?php } else {
			newImage($n, $fd, $path, $i);
		}?>
	}
	<?php } ?>
  </script>
	
</html>