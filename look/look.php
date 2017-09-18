<!DOCTYPE>
<html>
	<head>
		<title>spot it</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Style-Type" content="text/css">
		<meta http-equiv="Cache-Control" content="no-cache">
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
		$path="../projects/".$_COOKIE['project']."/";
		$imgPerCard=$_COOKIE['projectSize'];
		switch($imgPerCard){
							case 5:$maxCount = 21;
							break;
							case 6:$maxCount = 31;
							break;
							case 8:$maxCount = 57;
							break;
				}
		$stepsCount=intval($maxCount/6) + 1;
		$messege="";
		$class='green';
		if(isset($_FILES['img'])){
			if(!empty($_POST['imgNum'])){
				if(preg_match("/image\/*/",$_FILES['img']['type'])){
					move_uploaded_file($_FILES['img']['tmp_name'], $path.$_POST['imgNum'].'.png');
					$messege="Image ".$_POST['imgNum']." sucsesfuly chenged to ".$_FILES['img']['name'].".";
					$class='green';
				}
				else{
					$messege='File isn\'t image! </br> Try again.';
					$class='red';
				}
			}
			else{ 
				$messege='File wasn\'t load';
				$class="green";
			}
		}
		$isSaved=false;
		if(isset($_POST['curStep'])) {
			for($i = 1; $i < intval($_POST['curStep']/($stepsCount + 1))*($maxCount-6) + 7; $i++){
				if(isset($_POST['imgs'.$i])){
					if($_POST['curStep'] != $stepsCount + 1) {
						$fd = fopen($path."inf".(($_POST['curStep']-1)*6 + $i).".txt", 'w') or die("не удалось открыть файл");
					} else {
						$fd = fopen($path."inf".$i.".txt", 'w') or die("не удалось открыть файл");
					}
					foreach($_POST['imgs'.$i] as $inf){
						fwrite($fd, $inf.PHP_EOL);
					}
					fclose($fd);
					$isSaved=true;
				}
			}
		}
		if($isSaved){
			$messege.="</br>Changes saved";		
		}
		?>
		
	<script>
		function onImageclick(image){
			var randomRotate=Math.floor(Math.random() * (360));
			image.style.webkitTransform="rotate("+randomRotate+"deg)";
		}
		function onImageDbClick(image){
			var rat=prompt("Enter ratate");
			image.style.webkitTransform="rotate("+rat+"deg)";
		}
		/*function dragStart(image){
			offsetX=window.event.clientX-image.offsetLeft;
			offsetY=window.event.clientY-image.offsetTop;
		}
		function dragImage(image){
			mouse_x = window.event.clientX;
			mouse_y = window.event.clientY;
			if(mouse_x!=0){
				image.style.top=(mouse_y-offsetY)+"px";
				image.style.left=(mouse_x-offsetX)+"px";
			}
		}*/
		function hide(button){
			div=document.getElementById("tools");
			if(div.style.display=="none"){
				div.style.display="block";
				button.value="hide";
			}
			else{
				div.style.display="none";
				button.value="show";
			}
		}
		function changeZ(image){
			if(image.style.zIndex=="1"){
				image.style.zIndex="0";
			}
			else{
				image.style.zIndex="1";
			}
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
	$(".file-upload input[type=file]").change(function(){
         var filename = $(this).val().replace(/.*\\/, "zxcv");
         $("#filename").val(filename);
    });
	
	$("#commitMesesge").click(function(){
	    $('div.messege').toggleClass('red', false);
		$('div.messege').toggleClass('green', false);
		$('div.maincontent').toggleClass('plus', false);
		isMessege=false;
   });
   
   $("#send").click(function(){
	   for( n = 1; n < <?php echo intval($_POST['step']/($stepsCount + 1))*($maxCount-6) + 7; ?>;n++){
		   bg=$("#bg"+(n+<?php if($_POST['step']<$stepsCount+1){
				echo (($_POST['step']-1)*6);
			} else {
				echo 0;
			} ?>))[0];
		   for(i=1;i< <?php echo $imgPerCard+1 ?>;i++){
				imgInf=$("#"+n+"imgInf"+i)[0];
				img=$("#"+(n+<?php if($_POST['step']<$stepsCount+1){
				echo (($_POST['step']-1)*6);
			} else {
				echo 0;
			}?>)+"img"+i)[0];
				console.log(imgInf);			   
				imgInf.value = (img.style.top.substring(0, img.style.top.length - 2) - bg.style.top.substring(0, bg.style.top.length - 2)) + 
				" " + (img.style.left.substring(0,img.style.left.length-2)- bg.style.left.substring(0,bg.style.left.length-2)) + " " +
				img.style.transform + " " + img.width +  " " + img.src;
				console.log(imgInf);

		   }			
	   }
   });
	
});
	</script>
		<?php 	
	include "position.php";
	
	switch($imgPerCard){
		case 5: 
		break;
		case 6: include "algorithm2.php";
		break;
		case 8: include "algorithm1.php";
		break;
	}

	?>
	<div style="position:relative; top:<?php if($_POST['step']!= $stepsCount+1) echo 740; else echo 740*$stepsCount+150; ?>px;  left:368px; text-align:center; width:340px; z-index:2; background-color:white;" >
	<input type="button" value="hide" style="padding:4px" onclick="hide(this)">
		<div id="tools" style="position:relative; border:solid; border-color:gray; width:340px; height:190px; box-shadow:0 0 10px blue;">
			<form method="POST" style="text-align:center; visibility:inherit; position:absolute; top:0; left:0; width:40px; height:190px; color:white;">
				<input type="hidden" name="step" value="<?php if($_POST['step']>1) {echo $_POST['step']-1;} else {echo 1; } ?>">
				<input type="submit" value="&#8592" style="margin:0px; font-size:150%; color:white; background-color:blue; width:100%; height:100%">
				
			</form>
			<form method="POST" style="text-align:center; visibility:inherit; position:absolute; top:0; left:300px; width:40px; height:190px; color:white;">
				<input type="hidden" name="step" value="<?php if($_POST['step']<$stepsCount) {echo $_POST['step']+1;} else {echo $stepsCount; } ?>">
				<input type="submit" value="&#8594" style="margin:0; width:100%; height:100%; font-size:150%; color:white; background-color:blue;">
			</form>
			<form id="auth" method="POST" enctype="multipart/form-data">		
				<h2>Change image</h2>
				<input type="number" max="<?php echo $maxCount; ?>" min="1" name="imgNum" style="margin:4px; width:60%"></br>
				<div class="file-upload">
					 <label>
						  <input type="file" name="img" accept="image/*">
						  <span>CHOOSE FILE</span>
					 </label>
				</div>
				<input type="text" id="filename" class="filename" disabled></br>
				<input id="send" type="submit" value="Save" style="margin: 4px;">
				<input type="hidden" name="step" value="<?php echo $_POST['step']; ?>">
				<?php for($n=1; $n<intval($_POST['step']/($stepsCount + 1))*($maxCount-6) + 7; $n++) {
						for($i=1; $i<$imgPerCard+1; $i++) {?>
				<input id="<?php echo $n."imgInf".$i; ?>" type="hidden" name=imgs<?php echo $n; ?>[] value="">
				<?php } }?>
				<input type="hidden" name="curStep" value="<?php echo $_POST['step']; ?>">
			</form>
			<form id="auth" method="POST" action="images.php">
				<input type="hidden" value="<?php echo $_POST['step']; ?>" name='step'>
				<input type="submit" value="Download as images">
			</form>
			<form id="auth" method="POST" action="../main/main.php">
				<input type="submit" value="Back">
			</form>
		</div>
	</div>
	<div class="messege">
		<h2>Status</h2>
		<p id="messegeText"></p>
		<input type="button" id="commitMesesge" value="OK" style="vertical-align:bottom;">
	</div>
	<?php if(!empty($messege)){ ?>
	<script>
			isMessege=true;
			$('div.messege').toggleClass('<?php echo $class; ?>', true);
			$('#messegeText')[0].innerHTML="<?php echo $messege; ?>";
			$('div.maincontent').toggleClass('plus', true);
			
      

</script>
	<?php } ?>
	<script>
	 function addOnWheel(elem, handler) {
	if (elem.addEventListener) {
        if ('onwheel' in document) {
          // IE9+, FF17+
          elem.addEventListener("wheel", handler);
        } else if ('onmousewheel' in document) {
          // устаревший вариант события
          elem.addEventListener("mousewheel", handler);
        } else {
          // 3.5 <= Firefox < 17, более старое событие DOMMouseScroll пропустим
          elem.addEventListener("MozMousePixelScroll", handler);
        }
      } else { // IE8-
        el.attachEvent("onmousewheel", handler);
      }
    }
	
	    var scale = 1;
		<?php for ($n=1 ;$n < intval($_POST['step']/($stepsCount + 1))*($maxCount-6) + 7; $n++) {
			for($i=1; $i<$imgPerCard+1; $i++) { 
			if($_POST['step']<$stepsCount+1){
				$curCard=$n+(($_POST['step']-1)*6);
			} else {
				$curCard = $n;
			}?>
	el<?php echo $n."_".$i; ?>=document.getElementById("<?php echo $curCard."img".$i; ?>");
    addOnWheel(el<?php echo $n."_".$i; ?>, function(e) {

      var delta = e.deltaY || e.detail || e.wheelDelta;

      // отмасштабируем при помощи CSS
      if (delta > 0) scale = 0.9;
      else scale = 1.1;

      el<?php echo $n."_".$i; ?>.width = el<?php echo $n."_".$i; ?>.height *=scale;

      // отменим прокрутку
      e.preventDefault();
    });
	el<?php echo $n."_".$i; ?>.onmousedown=function(e) {
		var offsetX=window.event.clientX-el<?php echo $n."_".$i; ?>.offsetLeft;
		var offsetY=window.event.clientY-el<?php echo $n."_".$i; ?>.offsetTop;
		
		document.onmousemove=function(e){
			mouse_x = window.event.clientX;
			mouse_y = window.event.clientY;
			if(mouse_x!=0){
				el<?php echo $n."_".$i; ?>.style.top=(mouse_y-offsetY)+"px";
				el<?php echo $n."_".$i; ?>.style.left=(mouse_x-offsetX)+"px";
			}
		}
		el<?php echo $n."_".$i; ?>.onmouseup=function(e){
			document.onmousemove=null;
			el<?php echo $n."_".$i; ?>.onmouseup=null;
		}
	}
	el<?php echo $n."_".$i; ?>.ondragstart=function(e){
		return false;
	}
		<?php }} ?>
	</script>
	</body>
	
</html>
