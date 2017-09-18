<?php header("Content-type; text/html; charset=utf-8"); 
header ("Cache-Control: no-cache, must-revalidate"); ?> 
<!DOCTYPE>
<html>
	
	<head>
		<title>spot it</title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Style-Type" content="text/css">
	</head>
	<body>
	<script type="text/javascript" src="../jquery-1.9.1.min.js"></script>
	<?php if(!isset($_COOKIE['project'])){
		?>
			<script>
			window.location.href = "../main/main.php";
			</script>
		<?php
		}
		else{ $path="../projects/".$_COOKIE['project']."/";
		} ?>
		
	<img src="../look/A4.png" style="position: absolute; z-index: -2; top:0; left:0; width:1123px; height:792px;">
	<canvas height='336px' width='336px' id='example1' style="position:absolute; top:30px; left: 20px;"></canvas>
	<canvas height='336px' width='336px' id='example2' style="position:absolute; top:30px; left: 376;"></canvas>
	<canvas height='336px' width='336px' id='example3' style="position:absolute; top:30px; left: 732px;"></canvas>
	<canvas height='336px' width='336px' id='example4' style="position:absolute; top:396px; left: 20px;"></canvas>
	<canvas height='336px' width='336px' id='example5' style="position:absolute; top:396px; left: 376px;"></canvas>
	<canvas height='336px' width='336px' id='example6' style="position:absolute; top:396px; left: 732px;"></canvas>


	<form action="backside.php" method="POST" style="position:relative; top:750px; left: 510px;">
		<input type="submit" value="Back">
	</form>
  </body>
  <script>  
	<?php 
	$path="../projects/".$_COOKIE['project']."/";
	if(file_exists($path."backsideInf.txt")) {
		$fd = fopen($path."backsideInf.txt", 'r') or die("не удалось открыть файл");
		$str = htmlentities(fgets($fd));
		$str = preg_split("/[\s]+/", $str);
	} else {
		$str = array(0, 0, 336);
	}
	?>
	var example=[];
	var ctx=[];
	
	img = new Image();
	img.src='<?php echo $path."backside.png";?>';
	img.onload = function(){
		for($n=1;$n<7; $n++){
		example[$n] = document.getElementById("example"+$n);
		ctx[$n] = example[$n].getContext('2d');
		ctx[$n].save();
		ctx[$n].drawImage(img, <?php echo $str[1]; ?>, <?php echo $str[0]; ?>, <?php echo $str[2]; ?>, <?php echo $str[2]; ?>);
		}
		img.src="<?php echo $path; ?>background.png";
		img.onload = function(){
			for($e=1;$e<7; $e++){
				ctx[$e].save();
				ctx[$e].drawImage(img, 0, 0, 336, 336);
			}
		}
	}
	
  </script>
	
</html>