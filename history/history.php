<?php header("Content-type; text/html; charset=utf-8"); ?>
<!DOCTYPE>
<html>
	<head>
		<title>spot it</title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link href="../main/style.css" rel="stylesheet"> 
	</head>
	<body>
	<?php if(!isset($_COOKIE['project'])) { ?>
			<script>
			window.location.href = "../main/main.php";
			</script>
		<?php }
	$path="../projects/".$_COOKIE['project']."/";
	$imgPerCard = $_COOKIE['projectSize']; 
	switch($imgPerCard){
							case 5:$maxCount = 21;
							break;
							case 6:$maxCount = 31;
							break;
							case 8:$maxCount = 57;
							break;
				}
	
	if(isset($_POST['imgs'])){
		$fd = fopen($path."history\imgs.txt", 'w') or die("не удалось открыть файл");
		foreach($_POST['imgs'] as $inf){
			fwrite($fd, $inf.PHP_EOL);
		}
		fclose($fd);
	}
	
	if(isset($_POST['texts'])){
		$fd = fopen($path."history\texts.txt", 'w') or die("не удалось открыть файл");
		foreach($_POST['texts'] as $inf){
			fwrite($fd, $inf.PHP_EOL);
		}
		fclose($fd);
	}
	
	if(file_exists($path."history.txt")){ 
		$history = file($path."history.txt");
		$num = count($history);
		if($num < $maxCount){ ?>
			<script>
			window.location.href = "../main/main.php";
			</script>
		<?php }
	} else { ?>
			<script>
			window.location.href = "../main/main.php";
			</script>
	<?php }
	$isImgsExists=false;
	$isTextsExists=false;
	$bgCount = 12;
	if(file_exists($path."/history/imgs.txt")){
		$imgs = file($path."/history/imgs.txt");
		$isImgsExists = true;
		$bgCount = intval(preg_split("/[\s]+/", $imgs[$maxCount - 1])[1]/336) + intval(preg_split("/[\s]+/", $imgs[$maxCount - 1])[0]/336) * 3 + 1;
	}
	?>
	<script>
		var isImgsExists=<?php if($isImgsExists) echo "true"; else echo "false"; ?>;
		var path = "<?php echo $path; ?>";
		var imgPerCard = <?php echo $imgPerCard; ?>;
		var maxCount = <?php echo $maxCount; ?>;
	</script>
	<?php
	if(file_exists($path."/history/texts.txt")){
		$texts = file($path."/history/texts.txt");
		$isTextsExists = true;
	}
		?>
	<img src="../look/A4.png" style="position: absolute; z-index: -2; top:0; left:0; width:1123px; height:792px;">
	<img src="<?php echo $path.'background.png'; ?>" height='336px' width='336px' id='bg0' style="position:absolute; top:30; left:20;
	<?php if(1 > $bgCount) echo 'display:none;'; ?>">
	<img src="<?php echo $path.'background.png'; ?>" height='336px' width='336px' id='bg1' style="position:absolute; top:30; left:376;
	<?php if(2 > $bgCount) echo 'display:none;'; ?>">
	<img src="<?php echo $path.'background.png'; ?>" height='336px' width='336px' id='bg2' style="position:absolute; top:30; left:732;
	<?php if(3 > $bgCount) echo 'display:none;'; ?>">
	<img src="<?php echo $path.'background.png'; ?>" height='336px' width='336px' id='bg3' style="position:absolute; top:396; left:20;
	<?php if(4 > $bgCount) echo 'display:none;'; ?>">
	<img src="<?php echo $path.'background.png'; ?>" height='336px' width='336px' id='bg4' style="position:absolute; top:396; left:376;
	<?php if(5 > $bgCount) echo 'display:none;'; ?>">
	<img src="<?php echo $path.'background.png'; ?>" height='336px' width='336px' id='bg5' style="position:absolute; top:396; left:732;
	<?php if(6 > $bgCount) echo 'display:none;'; ?>">
	
	<img src="../look/A4.png" style="position: absolute; z-index: -2; top:792; left:0; width:1123px; height:792px;">
	<img src="<?php echo $path.'background.png'; ?>" height='336px' width='336px' id='bg6' style="position:absolute; top:822; left:20;
	<?php if(7 > $bgCount) echo 'display:none;'; ?>">
	<img src="<?php echo $path.'background.png'; ?>" height='336px' width='336px' id='bg7' style="position:absolute; top:822; left:376;
	<?php if(8 > $bgCount) echo 'display:none;'; ?>">
	<img src="<?php echo $path.'background.png'; ?>" height='336px' width='336px' id='bg8' style="position:absolute; top:822; left:732;
	<?php if(9 > $bgCount) echo 'display:none;'; ?>">
	<img src="<?php echo $path.'background.png'; ?>" height='336px' width='336px' id='bg9' style="position:absolute; top:1188; left:20;
	<?php if(10 > $bgCount) echo 'display:none;'; ?>">
	<img src="<?php echo $path.'background.png'; ?>" height='336px' width='336px' id='bg10' style="position:absolute; top:1188; left:376;
	<?php if(11 > $bgCount) echo 'display:none;'; ?>">
	<img src="<?php echo $path.'background.png'; ?>" height='336px' width='336px' id='bg11' style="position:absolute; top:1188; left:732;
	<?php if(12 > $bgCount) echo 'display:none;'; ?>">
	<script>
	var $names = [];
	</script>
	<?php 
	
	
	for($n=1; $n<$maxCount + 1; $n++) {
		
		?>
		<script>
		$names[<?php echo $n; ?>]="<?php $PCREpattern  =  '/\r\n|\r|\n/u';
									echo  preg_replace($PCREpattern, '', $history[$n - 1]); ?>";
		</script>
		
		<?php if ($isImgsExists) { 
		$curImgInf = preg_split("/[\s]+/", $imgs[$n-1]);
		$curbg = intval(preg_split("/[\s]+/", $imgs[$n-1])[1]/336) + intval(preg_split("/[\s]+/", $imgs[$n-1])[0]/336) * 3 + 1;
		?>
		<img src="<?php echo $path.$n.'.png'; ?>" width=<?php echo $curImgInf[2]; ?> height=<?php echo $curImgInf[2]; ?> style="position: absolute; left: <?php echo $curImgInf[1]; ?>; top: <?php echo $curImgInf[0]; ?>; cursor: pointer;" id="img<?php echo $n; ?>">
		<?php } else { ?>
		<img src="<?php echo $path.$n.'.png'; ?>" width=50px height=50px style="position: absolute; cursor: pointer;" id="img<?php echo $n; ?>">
		
		<?php } if ($isTextsExists) {
			$curTextInf = preg_split("/[\s]+/", $texts[$n-1]); ?>
		<p  id = <?php echo "text".$n; ?> style="position: absolute; margin: 3px; text-align:center; cursor: pointer; 
		<?php echo "font-size:".$curTextInf[2]."; "."top:".($curTextInf[0])."; "."left:".($curTextInf[1])."; "?>"><?php echo $history[$n-1]; ?></p>
		<?php } else { ?>
		<p  id = <?php echo "text".$n; ?> style="position: absolute; margin: 3px; text-align:center; cursor: pointer;"><?php echo $history[$n-1]; ?></p>
	<?php } } ?>
	<input type="number"  id="difSizing" min="40" max="70" placeholder="Choose size" step="5" style="position:absolute; top:<?php echo (intval(($bgCount - 1) / 3) + 1) * 366 + 10 + intval(($bgCount-1)/6) * 60; ?>; left:495; width:100px;">
	<input type="button" id="saveBut" value="Save" style="position:absolute; top:<?php echo (intval(($bgCount - 1)/3) + 1) * 366 + 40 + intval(($bgCount-1)/6) * 60; ?>; left:495; width:100px;">
	<input type="button" value="Open as 1 image" id="asImageBut" onclick="windiw.location.href='1image.php'" style="position:absolute; top:<?php echo (intval(($bgCount - 1)/3) + 1) * 366 + 70+ intval(($bgCount-1)/6) * 60; ?>; left: 485;">
	<div id="changeName" style="position:absolute; top:<?php echo (intval(($bgCount - 1)/3) + 1) * 366 + 90+ intval(($bgCount-1)/6) * 60; ?>; left: 423; width:244; text-align:center;">
		<h3> Change name </h3>
		<input type="number" id="changeNameNumber" min="1" max="<?php echo $countImg; ?>" name="imgNum" placeholder="Choose image" style="width:110;"></br>
		<div id="changingNamesDiv" style="display:none;">
			<img id="changedNameImage" src="" width="150px" height="150px" style="margin-top:10px;">
			<p id="changingName"><input type="text" id="newName" placeholder="Input new name"> </p>
			<input type="button" value="change" id="changeNameBut">
		</div>
		<form id="form" method="post" enctype="multipart/form-data" style="margin-top: 10; text-align: center;">
			<input type="button" value="Back" id="back" style="padding:4px; padding-top:0px; padding-bottom:0px;"> 
		</form>
	</div>
	<script type="text/javascript" src="../jquery-1.9.1.min.js"></script>
	<script src="history.js"></script>
	</body>
</html>