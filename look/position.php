<?php
	function kind1 ($path, $img1="1", $img2="2", $img3="3", $img4="4", $img5="5", $img6="6", $img7="7", $img8="8", $nCard=1, $x=20, $y=30){
		$img[1]=$path.$img1.".png";				
		$img[2]=$path.$img2.".png";
		$img[3]=$path.$img3.".png";
		$img[4]=$path.$img4.".png";
		$img[5]=$path.$img5.".png";
		$img[6]=$path.$img6.".png";
		$img[7]=$path.$img7.".png";
		$img[8]=$path.$img8.".png";
		global $imgPerCard;
		
	if(file_exists($path."inf".$nCard.".txt")) 
		$fd = fopen($path."inf".$nCard.".txt", 'r') or die("не удалось открыть файл");
	else {
		$fd = fopen("../".$imgPerCard."/"."inf".($nCard%6 + 1).".txt", 'r') or die("не удалось открыть файл");
	}
	for($i=1;$i<$imgPerCard+1;$i++)
	{
		$str1 = htmlentities(fgets($fd));
		$str = preg_split("/[\s]+/", $str1);
	?>
	<img id="<?php echo $nCard;?>img<?php echo $i; ?>" src="<?php echo $img[$i]; ?>" title="<?php echo basename($img[$i]); ?>" width=<?php echo $str[3];?>px
	height=<?php echo $str[3];?>px style="position:absolute; 
	top:<?php echo $y+$str[0];?>; left: <?php echo $x+$str[1]; ?>; -webkit-transform:<?php echo $str[2]; ?>;" onclick="onImageclick(this)" ondblclick="onImageDbClick(this)" />
	<?php }
	fclose($fd); ?>
	
	<img id="bg<?php echo $nCard;?>" src='<?php echo $path."background.png"; ?>' width="336px" height="336px" onclick="changeZ(this)" style="position:absolute; z-index: 1; disabled; left:<?php echo $x; ?>; top:<?php echo $y; ?>;" />

	<?php }
	function kind2 ($path, $img1="1", $img2="2", $img3="3", $img4="4", $img5="5", $img6="6", $img7="7", $img8="8", $nCard=2, $x=376, $y=30){
		$img[1]=$path.$img1.".png";				
		$img[2]=$path.$img2.".png";
		$img[3]=$path.$img3.".png";
		$img[4]=$path.$img4.".png";
		$img[5]=$path.$img5.".png";
		$img[6]=$path.$img6.".png";
		$img[7]=$path.$img7.".png";
		$img[8]=$path.$img8.".png";
		global $imgPerCard;
	if(file_exists($path."inf".$nCard.".txt")) 
		$fd = fopen($path."inf".$nCard.".txt", 'r') or die("не удалось открыть файл");
	else
		$fd = fopen("../".$imgPerCard."/"."inf".($nCard%6 + 1).".txt", 'r') or die("не удалось открыть файл");
	for($i=1;$i<$imgPerCard+1;$i++)
	{
		$str1 = htmlentities(fgets($fd));
		$str = preg_split("/[\s]+/", $str1);
	?>
	<img id="<?php echo $nCard;?>img<?php echo $i; ?>" src="<?php echo $img[$i]; ?>" title="<?php echo basename($img[$i]); ?>" width=<?php echo $str[3];?>px
	height=<?php echo $str[3];?>px style="position:absolute; 
	top:<?php echo $y+$str[0];?>; left: <?php echo $x+$str[1]; ?>; -webkit-transform:<?php echo $str[2]; ?>;" onclick="onImageclick(this)" ondblclick="onImageDbClick(this)" />
	<?php }
	fclose($fd); 
	?>
	
	<img id="bg<?php echo $nCard;?>" src='<?php echo $path."background.png"; ?>' width="336px" height="336px" onclick="changeZ(this)" style="position:absolute; z-index: 1; disabled; left:<?php echo $x;?>; top:<?php echo $y;?>;"/>
	<?php }
	function kind3 ($path,$img1="1", $img2="2", $img3="3", $img4="4", $img5="5", $img6="6", $img7="7", $img8="8", $nCard=3, $x=732, $y=30){
		$img[1]=$path.$img1.".png";				
		$img[2]=$path.$img2.".png";
		$img[3]=$path.$img3.".png";
		$img[4]=$path.$img4.".png";
		$img[5]=$path.$img5.".png";
		$img[6]=$path.$img6.".png";
		$img[7]=$path.$img7.".png";
		$img[8]=$path.$img8.".png";
		global $imgPerCard;
	if(file_exists($path."inf".$nCard.".txt")) 
		$fd = fopen($path."inf".$nCard.".txt", 'r') or die("не удалось открыть файл");
	else
		$fd = fopen("../".$imgPerCard."/"."inf".($nCard%6 + 1).".txt", 'r') or die("не удалось открыть файл");
	for($i=1;$i<$imgPerCard+1;$i++) {
		$str1 = htmlentities(fgets($fd));
		$str = preg_split("/[\s]+/", $str1);
	?>
	<img id="<?php echo $nCard;?>img<?php echo $i; ?>" src="<?php echo $img[$i]; ?>" title="<?php echo basename($img[$i]); ?>" width=<?php echo $str[3];?>px
	height=<?php echo $str[3];?>px style="position:absolute; 
	top:<?php echo $y+$str[0];?>; left: <?php echo $x+$str[1]; ?>; -webkit-transform:<?php echo $str[2]; ?>;" onclick="onImageclick(this)" ondblclick="onImageDbClick(this)" />
	<?php } 
	fclose($fd); 
	?>
	
	<img id="bg<?php echo $nCard;?>" src='<?php echo $path."background.png"; ?>' width="336px" height="336px" onclick="changeZ(this)" style="position:absolute; z-index: 1; disabled; left:<?php echo $x; ?>; top:<?php echo $y; ?>;"/>
	<?php } 
	function kind4 ($path,$img1="1", $img2="2", $img3="3", $img4="4", $img5="5", $img6="6", $img7="7", $img8="8", $nCard=4, $x=20, $y=396){
		$img[1]=$path.$img1.".png";				
		$img[2]=$path.$img2.".png";
		$img[3]=$path.$img3.".png";
		$img[4]=$path.$img4.".png";
		$img[5]=$path.$img5.".png";
		$img[6]=$path.$img6.".png";
		$img[7]=$path.$img7.".png";
		$img[8]=$path.$img8.".png";
		global $imgPerCard;
	if(file_exists($path."inf".$nCard.".txt"))
		$fd = fopen($path."inf".$nCard.".txt", 'r') or die("не удалось открыть файл");
	else
		$fd = fopen("../".$imgPerCard."/"."inf".($nCard%6 + 1).".txt", 'r') or die("не удалось открыть файл");
	for($i=1;$i<$imgPerCard+1;$i++)
	{
		$str1 = htmlentities(fgets($fd));
		$str = preg_split("/[\s]+/", $str1);
	?>
	<img id="<?php echo $nCard;?>img<?php echo $i; ?>" src="<?php echo $img[$i]; ?>" title="<?php echo basename($img[$i]); ?>" width=<?php echo $str[3];?>px
	height=<?php echo $str[3];?>px style="position:absolute; 
	top:<?php echo $y+$str[0];?>; left: <?php echo $x+$str[1]; ?>; -webkit-transform:<?php echo $str[2]; ?>;" onclick="onImageclick(this)" ondblclick="onImageDbClick(this)" />
	<?php }
		fclose($fd); ?>
	<img id="bg<?php echo $nCard;?>" src='<?php echo $path."background.png"; ?>' width="336px" height="336px" onclick="changeZ(this)" style="position:absolute; z-index: 1; disabled; left:<?php echo $x; ?>; top:<?php echo $y; ?>;" />
	<?php } 
	function kind5 ($path,$img1="1", $img2="2", $img3="3", $img4="4", $img5="5", $img6="6", $img7="7", $img8="8", $nCard=5, $x=376, $y=396){
		$img[1]=$path.$img1.".png";		
		$img[2]=$path.$img2.".png";
		$img[3]=$path.$img3.".png";
		$img[4]=$path.$img4.".png";
		$img[5]=$path.$img5.".png";
		$img[6]=$path.$img6.".png";
		$img[7]=$path.$img7.".png";
		$img[8]=$path.$img8.".png";
		global $imgPerCard;
	if(file_exists($path."inf".$nCard.".txt"))
		$fd = fopen($path."inf".$nCard.".txt", 'r') or die("не удалось открыть файл");
	else
		$fd = fopen("../".$imgPerCard."/"."inf".($nCard%6 + 1).".txt", 'r') or die("не удалось открыть файл");
	for($i=1;$i<$imgPerCard+1;$i++) {
		$str1 = htmlentities(fgets($fd));
		$str = preg_split("/[\s]+/", $str1);
	?>
	<img id="<?php echo $nCard;?>img<?php echo $i; ?>" src="<?php echo $img[$i]; ?>" title="<?php echo basename($img[$i]); ?>" width=<?php echo $str[3];?>px
	height=<?php echo $str[3];?>px style="position:absolute; 
	top:<?php echo $y+$str[0];?>; left: <?php echo $x+$str[1]; ?>; -webkit-transform:<?php echo $str[2]; ?>;" onclick="onImageclick(this)" ondblclick="onImageDbClick(this)" />
	<?php }
	fclose($fd); ?>
	<img id="bg<?php echo $nCard;?>" src='<?php echo $path."background.png"; ?>' width="336px" height="336px" onclick="changeZ(this)" style="position:absolute; z-index: 1; disabled; left:<?php echo $x; ?>; top:<?php echo $y; ?>;" />
	<?php } 
	function kind6 ($path,$img1="1", $img2="2", $img3="3", $img4="4", $img5="5", $img6="6", $img7="7", $img8="8", $nCard=6, $x=732, $y=396){
		$img[1]=$path.$img1.".png";				
		$img[2]=$path.$img2.".png";
		$img[3]=$path.$img3.".png";
		$img[4]=$path.$img4.".png";
		$img[5]=$path.$img5.".png";
		$img[6]=$path.$img6.".png";
		$img[7]=$path.$img7.".png";
		$img[8]=$path.$img8.".png";
		global $imgPerCard;
	if(file_exists($path."inf".$nCard.".txt"))
		$fd = fopen($path."inf".$nCard.".txt", 'r') or die("не удалось открыть файл");
	else
		$fd = fopen("../".$imgPerCard."/"."inf".($nCard%6 + 1).".txt", 'r') or die("не удалось открыть файл");
		for($i=1;$i<$imgPerCard+1;$i++) {
		$str1 = htmlentities(fgets($fd));
		$str = preg_split("/[\s]+/", $str1);
	?>
	<img id="<?php echo $nCard;?>img<?php echo $i; ?>" src="<?php echo $img[$i]; ?>" title="<?php echo basename($img[$i]); ?>" width=<?php echo $str[3];?>px
	height=<?php echo $str[3];?>px style="position:absolute; 
	top:<?php echo $y+$str[0];?>; left: <?php echo $x+$str[1]; ?>; -webkit-transform:<?php echo $str[2]; ?>;" onclick="onImageclick(this)" ondblclick="onImageDbClick(this)" />
	<?php }
	fclose($fd); ?>
	<img id="bg<?php echo $nCard;?>" src='<?php echo $path."background.png"; ?>' width="336px" height="336px" onclick="changeZ(this)" style="position:absolute; z-index: 1; disabled; left:<?php echo $x; ?>; top:<?php echo $y; ?>;" />
	<?php }	?>