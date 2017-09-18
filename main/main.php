<?php if(isset($_POST["choosedProject"])){
			if($_POST["choosedProject"]=="newProject"){
				if(isset($_POST["newProject"])){
					$path="../projects/".$_POST["newProject"]."/";
					$imgPerCard = $_POST['count'];
					setcookie('projectSize', $_POST['count'], time()+60*60*24, "/");
					mkdir("../projects/".$_POST["newProject"]);
					copy("background.png", "../projects/".$_POST["newProject"]."/background.png");
					$fd = fopen($path."inf.txt", 'w') or die("не удалось открыть файл");
					fwrite($fd, $_POST['count']);
					fclose($fd);
					setcookie('project', basename($_POST["newProject"]) ,time()+60*60*24, "/");
				}
		}
				else{
					setcookie('project', basename($_POST["choosedProject"]) ,time()+60*60*24, "/");
					$path="../projects/".$_POST["choosedProject"]."/";
					if(file_exists($path."inf.txt")){
						$imgPerCard=file($path."inf.txt")[0];
						setcookie('projectSize', $imgPerCard, time()+60*60*24, "/");
					} else {
						$imgPerCard = 8;
						setcookie('projectSize', 8, time()+60*60*24, "/");
						$fd = fopen($path."inf.txt", 'w') or die("не удалось открыть файл");
						fwrite($fd, 8);
						fclose($fd);
					}
				}
			}
			else if(isset($_COOKIE['project']) && is_dir("../projects/".$_COOKIE['project']."/")){
				$path="../projects/".$_COOKIE['project']."/";
				$imgPerCard = $_COOKIE['projectSize'];
			}
		else{ ?>
			<script>
			window.location.href = "../index.php";
			</script>
		<?php }
		switch($imgPerCard){
							case 5:$maxCount = 21;
							break;
							case 6:$maxCount = 31;
							break;
							case 8:$maxCount = 57;
							break;
				}
		$countImg=0;
		if ($handle = opendir($path)) {
			while ($entry = readdir($handle)) {
				if (preg_match_all("/^[0-9]{1,2}/",$entry)) {
					$countImg++;
					if ($countImg > $maxCount ){
						unlink($path.$entry);
						$countImg--;
						$messege = "Redundant images were found. The latest were deleted. </br> You still can replace another.";
						$class = "red"; ?>
						<script> isMessege=true; </script> <?php
					}
				}
			}
		closedir($handle);
		}
		include "chekFiles.php"; ?> 
		<script>
		var path = "<?php echo $path; ?>";
		var countImg = "<?php echo $countImg; ?>";
		var maxCount = <?php echo $maxCount; ?>;
		</script>
<!DOCTYPE>
<html>
	
	<head>
		<title>do spot-it</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Style-Type" content="text/css">
		<meta http-equiv="Cache-Control" content="no-cache">
		<link href="style.css" rel="stylesheet"> 
  </head>
  <body>

<script type="text/javascript" src="../jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="mainJS.js">	</script>

		<script>
		function checkName(projectName){
		if($(projectName)[0].value==""){
			$(projectName).toggleClass("plus",false);
			$("#send").attr('disabled', "disabled");
		}
		else{
			var isExist=false;
			<?php
			$filelist = glob("../projects/*", GLOB_ONLYDIR);
			foreach ($filelist as $key => $value){ ?>
			if($(projectName)[0].value=="<?php echo basename($value); ?>"){
				isExist=true;
			}
			<?php } ?>
			if(isExist){
				$(projectName).toggleClass("plus",false);
				$("#send").attr('disabled', "disabled");
			}
			else{
				$(projectName).toggleClass("plus",true);
				$("#send").removeAttr('disabled');
			}
		}
		
	}
	</script>
	<input type="hidden" value="<?php echo $countImg; ?>" id="countImg">
	<div class="maincontent">
	<h1> <b>Spot it. Do it</b></h1>
	<table id="mainTable" cellpadding="0" cellspacing="1" id="Table1">
<tr>
	<td class="mainTD n1" id="create"><h2>Create</h2>
		<div id="SlideMenu1">
			<ul>
				<li class="SlideMenu1_Folder"><div id="title"><a>ADD IMAGES</a></div><span><!-- empty --></span>
					<ul id="createMenu" style="display:none;">
						<li>
						<?php if($countImg<$maxCount) { ?>
						<table id="createTable">
							<tr>
								<td class="createTD n1">
									<p style="vertical-align:top;">You needed to download <?php echo $maxCount-$countImg; ?> image(s)</p>
									<form method="POST" enctype="multipart/form-data" >
										<div class="file-upload"><label>
											<input accept="image/*" type="file" id="files" name="myFiles[]" multiple required>
											<span>CHOOSE FILE</span>
										</label>
										</div>
									<p id="filenames"></p>
									<?php for($index=0; $index<10; $index++){
												echo "<img src='' width='100px' height='100px' id='imgAddPreview".$index."' style='display:none; margin:4px;'>";
											} ?>
											</br>
											<input type="submit" value="Send">
									</form>
								</td>
								<td class="createTD n2">
									<h3>Downloaded images</h3>
									<?php
										if ($handle = opendir($path)) { 
											while ($entry = readdir($handle)) {
												if (preg_match_all("/^[0-9]{1,2}/",$entry)) {
													echo "<img class='lookDeck' src='".$path.$entry."'>";
												}
											}
											closedir($handle);
										}
										?>
										
								</td>
							</tr>
						</table>
						<?php } else { ?>
						<p>You have uploaded the required image</p>
						<?php } ?>
						</li>
					</ul>
				</li>
				<li class="SlideMenu1_Folder"><div id="title"><a>MAKE BACKSIDE</a></div><span><!-- empty --></span>
					<ul style="display:none">
						<li> <?php if (!file_exists($path."backside.png")) { ?>
							<form action="../backside/backside.php" method="post" enctype="multipart/form-data">
								<div class="file-upload"><label>
									<input type="file" accept="image/*" id="file3" name="backside" required>
									<span>CHOOSE FILE</span>
								</label></div>
								<p id="filename3"></p>
								<div id="preview3" style="display:none">
									<img src="" id="imgg3" width="150px" height="150px"></br>
								</div>
								<input type="submit" value="Send">
							</form>
						<?php } else { ?>
						<p> Backside is uploaded </p>
						<input type="button" id="toBackside" value="look"> 
						<?php } ?>
						</li>
					</ul>
				</li>
				<li class="SlideMenu1_Folder"><div id="title"><a>MAKE HISTORY</a></div><span><!-- empty --></span>
					<ul style="display:none">
						<li> 
							<script>
							$names = [
							<?php if(file_exists($path."history.txt"))	{
								$history = file($path."history.txt");
								$num = count($history) + 1;
								foreach($history as $name) {
									$PCREpattern  =  '/\r\n|\r|\n/u';
									echo  '"'.preg_replace($PCREpattern, '', $name).'",';
								}
							} else {
								$num = 1;
							}
							?>
							];
							</script>
								<div id="historyNamer" style="<?php if($num > $countImg) echo "display:none;"; ?>">
									<p id="historyCounter"><?php echo $num." of ".$countImg;?></p>
									<img src="<?php echo $path.$num.".png"; ?>" id="historyImg" width="150px" height="150px" style="margin-bottom:10px;"></br>
									<input type="editText" value="" placeholder="Input name" id="historyName">
									<input type="button" value="Send" id="historySend">
								</div>
								<div id="historyDone" style="<?php if($num <= $maxCount) echo "display:none;"; ?>">
									<h3> All images are named</h3>
									<input type="button" value="look" id="lookHistory">
									<h3> Change name </h3>
									<input type="number" id="changeNameNumber" min="1" max="<?php echo $countImg; ?>" name="imgNum" placeholder="Choose image" style="width:110;"></br>
									<div id="changingNamesDiv" style="display:none;">
										<img id="changedNameImage" src="" width="150px" height="150px" style="margin-top:10px;">
										<p id="changingName"><input type="text" id="newName" placeholder="Input new name"> </p>
										<input type="button" value="change" id="changeNameBut">
									</div>
								</div>
								<p id="historyMessege" style="<?php if($countImg == $maxCount || $num < $countImg) echo "display: none"; ?>">You need to download <?php echo $maxCount-$countImg; ?> image(s)</p>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</td>
	<td id="1im" class="mainTD"><h2>Edit</h2>
		<div id="SlideMenu1" >
			<ul>
				<li class="SlideMenu1_Folder"><div id="title"><a>CHANGE IMAGE</a></div><span><!-- empty --></span>
					<ul style="display:none;">
						<li> 
						<?php if ($countImg>0) { ?>
							<form method="post" enctype="multipart/form-data">
								<div style="width:100%;">
								<input type="number" id="imgNum1" min="1" max="<?php echo $countImg; ?>" name="imgNum" placeholder="Choose changed image" onchange="lookChangedImg(this, '<?php echo $path; ?>')" required></br>
								</div>
								<div class="file-upload"><label>
									<input type="file" accept="image/*" id="file1" name="img" required>
									<span>CHOOSE FILE</span>
								</label></div>
								<p id="filename1"></p>
								<div id="preview1" style="display:none">
									<img src="" id="img1" width="150px" height="150px"></br>
									<p id="Arrow">&#8595 </p>
									<img src="" id="imgg1" width="150px" height="150px"></br>
								</div>
								<input type="submit" value="Send">
							</form>
						<?php } else { ?>
						<h3>You have not downloaded image</h3>
						<?php } ?>
						</li>
					</ul>
				</li>
				
					<li class="SlideMenu1_Folder"><div id="title"><a>CHANGE BACKGROUND</a></div><span><!-- empty --></span>
					<ul style="display:none">
						<li>
							<form method="post" enctype="multipart/form-data">
								<div class="file-upload"><label>
									<input type="file" accept="image/*" id="file2" name="background" required>
									<span>CHOOSE FILE</span>
								</label></div>
								<p id="filename2"></p>
								<div id="preview2" style="display:none">
									<img src="<?php echo $path; ?>background.png" width="150px" height="150px"></br>
									<p id="Arrow">&#8595 </p>
									<img src="" id="imgg2" width="150px" height="150px"></br>
								</div>
								<input type="submit" value="Send">
							</form>
						</li>
					</ul>
					</li>
			</ul>
		</div>
	</td>
	<td class="mainTD"><h2>Look</h2>
		<div id="SlideMenu1">
			<ul>
				<li class="SlideMenu1_Folder"><div id="title"><a>LOOK DECK</a></div><span><!-- empty --></span>
					<ul style="display:none">
						<li> <?php if($countImg==$maxCount){ ?>
							<form action="../look/look.php" method="post">
								<select  name="step" style="margin:4px;">
									<option value="<?php echo intval($maxCount/6) + 2; ?>">See all on one page</option>
									<optgroup label="Step">
									<?php for($i = 0; $i<$maxCount; $i+=6) 
										if($i+6<$maxCount) {?>
									<option value="<?php echo ($i)/6 + 1; ?>"><?php echo $i."-".($i+6);?></option>
										<?php } else { ?>
									<option value="<?php echo ($i)/6 + 1; ?>"><?php echo $i."-".$maxCount;?></option>
										<?php } ?>
									</optgroup>
								</select> </br>
								<input type="submit" value="See">
							</form>
						<?php } else { ?>
						<p>You need to download <?php echo $maxCount-$countImg; ?> image(s)</p><?php } ?>
						</li>
					</ul>
				</li>
				<li class="SlideMenu1_Folder"><div id="title"><a>CHANGE PROJECT</a></div><span><!-- empty --></span>
					<ul style="display:none">
						<li>
							<form method="post">
								<select id="select" name="choosedProject" style="margin:4px;">
								<option disabled>Project</option>
								<option value="newProject">New project</option>
								<?php
								$filelist = glob("../projects/*", GLOB_ONLYDIR);
								foreach ($filelist as $key => $value){ ?>
								<option value="<?php echo basename($value); ?>"><?php echo basename($value); ?></option>
								<?php } ?>
								</select> </br>
								<input id="projectName" type="text" placeholder="Enter new Project name" name="newProject" style="margin:4px;" onchange="checkName(this)"></br>
								<select id="count" name="count">
									<option disabled>Count image per card</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="8">8</option>
								</select></br>
								<input id="send" type="submit" value="Commit" disabled>
							</form>
							<input type="button" value="Delete" id="delete">
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</td>
</tr>
</table>
</div>
<div class="messege">
	<h2>Messege</h2>
	<p id="messegeText"></p>
	<input type="button" id="commitMesesge" value="OK" style="vertical-align:bottom;">
</div>
<div class="dialog">
	<h2>Deleting project</h2>
	<p id="dialogText">The project will be deleted</p>
	<form method="post" action="../index.php">
		<input type="hidden" value="<?php echo $path ?>" name="delete">
		<input type="submit" value="ok" style="horizontal-align:center;">
		<input id="dialogCancel" type="button" value="cancel" style="horizontal-align:center;">
	</form>
</div>
	<?php if(!empty($messege)){ ?>
	<script>
			isMessege=true;
			$('div.messege').toggleClass('<?php echo $class; ?>', true);
			$('#messegeText')[0].innerHTML='<?php echo $messege; ?>';
			$('div.maincontent').toggleClass('plus', true);
	</script>
	<?php } ?>
	</body>
	
</html>