<?php header("Content-type; text/html; charset=utf-8"); ?> 
<!DOCTYPE>
<html>
	
	<head>
		<title>spot it</title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Style-Type" content="text/css">
	</head>
	<body>
	<img src="../look/A4.png" style="position: absolute; z-index: -2; top:0; left:0; width:1123px; height:792px;">
	<img src="../look/A4.png" style="position: absolute; z-index: -2; top:792; left:0; width:1123px; height:792px;">

	<script type="text/javascript" src="../jquery-1.9.1.min.js"></script>
	<?php if(!isset($_COOKIE['project'])){
		?>
			<script>
			window.location.href = "../main/main.php";
			</script>
		<?php
			
		}
		else{ $path="../projects/".$_COOKIE['project']."/";
		if(file_exists($path."history.txt")){ 
		$history = file($path."history.txt");
		$num = count($history);
		if($num < 57){ ?>
			<script>
			window.location.href = "../main/main.php";
			</script>
		<?php }
		} else { ?>
				<script>
				window.location.href = "../main/main.php";
				</script>
		<?php }
		}
		if(file_exists($path."history/imgs.txt") && file_exists($path."history/texts.txt")) {
			$imgs = file($path."history/imgs.txt");
			$texts = file($path."history/texts.txt");
			$bgCount = intval(preg_split("/[\s]+/", $imgs[56])[1]/336) + intval(preg_split("/[\s]+/", $imgs[56])[0]/336) * 3 + 1;
		} else { ?>
		<script>
			window.location.href="history.php";
		</script>
		<?php }
		for($i=1; $i<=$bgCount; $i++) {
		?>
	<canvas height='336px' width='336px' id='example<?php echo $i; ?>' style="position:absolute; top:<?php  echo intval(($i-1)/3) * 366 + 30 + intval(($i-1)/6) * 60; ?>px; left:<?php echo (($i-1)%3)*356 + 20; ?>px;"></canvas>
	<?php } ?>
	<form action="history.php" method="POST" style="position:relative; top:<?php echo intval(($bgCount - 1)/3 + 1)*366 + 10 + intval(($i-1)/6) * 60; ?>px; left: 510px;">
		<input type="submit" value="Back">
	</form>
  </body>
  <script> 
  var img=[];
	<?php 
	$imgNum = 0;
	for($i=1; $i<=$bgCount; $i++){
	?>
	example<?php echo $i; ?> = document.getElementById("example<?php echo $i; ?>");
	ctx<?php echo $i; ?> = example<?php echo $i; ?>.getContext('2d');
	
	var bg<?php echo $i; ?> = new Image();
	bg<?php echo $i; ?>.src="<?php echo $path."background.png"; ?>";
	bg<?php echo $i; ?>.onload = function(){
		ctx<?php echo $i; ?>.save();
		ctx<?php echo $i; ?>.drawImage(bg<?php echo $i; ?>, 0, 0, 336, 336);
		<?php while(true) {
			$curImg[$imgNum] =  preg_split("/[\s]+/", $imgs[$imgNum]);
			$curText[$imgNum] =  preg_split("/[\s]+/", $texts[$imgNum]); 
			if (intval($curImg[$imgNum][1]/356) + intval($curImg[$imgNum][0]/366) * 3 + 1 > $i) {
				break;
			} else { ?>
				ctx<?php echo $i; ?>.font = "<?php echo ($curText[$imgNum][2]-1)."px Arial"; ?>";
				ctx<?php echo $i; ?>.fillText(<?php $PCREpattern  =  '/\r\n|\r|\n/u';
									echo "\"".preg_replace($PCREpattern, '', $history[$imgNum])."\",".($curText[$imgNum][1]%356 - 20).",".($curText[$imgNum][0]%366 + 16 - 30 - intval(($i-1)/6)*60); ?>);
				img[<?php echo $imgNum; ?>] = new Image();
				img[<?php echo $imgNum; ?>].src="<?php echo $path.($imgNum+1).".png"; ?>";
				img[<?php echo $imgNum; ?>].onload = function(){
					ctx<?php echo $i; ?>.save();
					ctx<?php echo $i; ?>.drawImage(img[<?php echo $imgNum; ?>], <?php echo $curImg[$imgNum][1]%356 - 20 ; ?>, <?php echo $curImg[$imgNum][0]%366 - 30 - intval(($i-1)/6)*60; ?>, <?php echo $curImg[$imgNum][2]; ?>, <?php echo $curImg[$imgNum][2]; ?>);
				}
				<?php $imgNum++; 
				if ($imgNum == 57) break;
			} 
		} ?>
	}  
	
	<?php } ?>
  </script>
	
</html>