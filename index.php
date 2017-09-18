<?php header("Content-type; text/html; charset=utf-8"); ?> 
<!DOCTYPE>
<html>
	
	<head>
		<title>do spot-it</title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link media="screen" rel="stylesheet" href="indexCss.css">
	</head>
	<body>
	<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
	<?php 
		if (isset($_POST["delete"])){
			setcookie("project", 0);
			function removeDirectory($dir) {
				if ($objs = glob($dir."/*")) {
				   foreach($objs as $obj) {
					 is_dir($obj) ? removeDirectory($obj) : unlink($obj);
				   }
				}
				rmdir($dir);
			}
			removeDirectory("projects/".basename($_POST["delete"]));
		}
		if(isset($_COOKIE["project"]) && is_dir("projects/".$_COOKIE['project']."/")) {
	?>
	window.location.href = "main/main.php"
		<?php } ?>
	$(document).ready(function(){
	   $("#select").change(function(){
		   if($(this)[0].value=="newProject"){
			   $("#projectName").css("visibility","visible");
   			   $("#count").css("visibility","visible");
			   checkName($("#projectName"));
		   }
		   else{
			   $("#projectName").css("visibility","hidden");
			   $("#count").css("visibility","hidden");
			   $("#send").removeAttr('disabled');
		   }
		   
	   });
	});
	function checkName(projectName){
		if($(projectName)[0].value==""){
			$(projectName).toggleClass("plus",false);
			$("#send").attr('disabled', "disabled");
		}
		else{
			var isExist=false;
			<?php
			$filelist = glob("projects/*", GLOB_ONLYDIR);
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
	<div id="messege">
		<h2>Choose or create project</h2>
		<form action="main/main.php" method="post">
			<select id="select" name="choosedProject" style="margin:4px;">
			<option disabled>Project</option>
			<option value="newProject">New project</option>
			<?php
				$filelist = glob("projects/*", GLOB_ONLYDIR);
				foreach ($filelist as $key => $value){ ?>
				<option value="<?php echo basename($value); ?>"><?php echo basename($value); ?></option>
			<?php } ?>
			</select> </br>
			<input id="projectName" type="text" placeholder="Enter new Project name" name="newProject" style="margin:4px;" onchange="checkName(this)"></br>
			<select id="count" name="count" style="margin:4px;">
				<option disabled>Count image per card</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="8">8</option>
			</select></br>
			<input id="send" type="submit" value="Commit" style="margin:4px;" disabled>
		</form>
	</div>
	
	</body>
	
</html>