<?php if(isset($_FILES['background'])){
		if (isset($_FILES['background']['tmp_name'])){
			if(preg_match('/image\/*/' ,$_FILES['background']['type'])){
				move_uploaded_file($_FILES['background']['tmp_name'], $path.'background.png'); 
				$messege="Background successfully downloaded!";
				$class="green";
				}
			else{ 
			$messege='File isn\'t image! </br> Try again.';
			$class='red';
			}
		}
		else{ 
		$messege='Unexpected error </br> File(s) was(were)n\'t download';
		$class="red";
		}
	} 
	if(isset($_FILES['img'])){
		if(!empty($_POST['imgNum'])){
			if(preg_match("/image\/*/",$_FILES['img']['type'])){
				move_uploaded_file($_FILES['img']['tmp_name'], $path.$_POST['imgNum'].'.png');
				$messege="Image ".$_POST['imgNum']." successfully changed to ".$_FILES['img']['name'].".";
				$class='green';
			}
			else{
				$messege='File isn\'t image! </br> Try again.';
				$class='red';
			}
		}
		else{ 
		$messege='Number image error! </br> Try again.';
		$class="red";
		}
	}
	else if(isset($_FILES['myFiles'])){
		$size=count($_FILES['myFiles']['name']);
		$countImg1=0;
		for($i=0; $i<$size; $i++){
			if(preg_match("/image\/*/",$_FILES['myFiles']['type'][$i])){
				$countImg++;												
				if ($countImg < $maxCount+1 && $i<10) {					
					$countImg1++;
					move_uploaded_file($_FILES['myFiles']['tmp_name'][$i], $path.$countImg.'.png'); 
					} else { 
					$countImg--; 
					}
				}
			else{
				$messege='One or more files isn\'t images! </br> Try again.';
				$class='red';
			}
		} 				if ($countImg1 > 0) {
			$messege=$countImg1.' image(s) successfully downloaded!';
			$class='green';	} else {	?>	<script> isMessege=false; </script>	<?php }
		}
	else{
	?>
	<script> isMessege=false; </script>
	<?php } ?>