$(document).ready(function(){
	bg = $("#bg0")[0];
	console.log($('#bg0'));
	$curbg = 0;
	$offsetTop = 50;
	$offsetSide = 0;
	$step = 50;
	$height = $offsetTop;
	$x = 0;
	$y = 0;
	function currection(){
		var $crubg = 0;
		for($n=1; $n< maxCount + 1; $n++){
			$img = $("#img"+$n)[0];
			$text = $("#text"+$n)[0];
			$curX = parseInt($img.x / 336) + 1;
			switch(Number($curX)){
				case 1: $img.x += 20;
				case 2: ;
				case 3: ;
			}
			$curY = parseInt($img.y / 336) * 3;
		}
	}
	function reposition(){
		for($n=1; $n<maxCount + 1; $n++){
			$img = $("#img"+$n)[0];
			$text = $("#text"+$n)[0];
			$img.height=$img.width=$step;
			if ($n == 1) {
				$img.style.top = (parseInt(bg.style.top) + $offsetTop)+"px";
				$offsetSide = $x = $img.style.left = (parseInt(bg.style.left) + (bg.width/2)) -
					Math.pow((Math.pow((bg.width/2),2) - Math.pow(((bg.width/2) - $offsetTop),2)),1/2) + 10;
			}
			else if( $x + $step * 2  > 2*(parseInt(bg.style.left)+bg.height/2) - $offsetSide) {
				$height += ($step + (($img.width / 70) * 20 + 3)*2);
				$img.style.top = (parseInt(bg.style.top) + $height)+"px";
				if ($height+$step/2 < bg.height / 2) {
					$offsetSide = $x = $img.style.left = (parseInt(bg.style.left) + (bg.width/2)) -
					Math.pow((Math.pow((bg.width/2),2) - Math.pow(((bg.width/2) - $height),2)),1/2) + 10;
				} else {
					$offsetSide = $x = $img.style.left = 10 +(parseInt(bg.style.left) + (bg.width/2)) -
					Math.pow((Math.pow((bg.width/2),2) - Math.pow(((bg.width/2) - ($height + $step + (($img.width / 70) * 20 + 3)*2)),2)),1/2);
				}
			} else {
				$img.style.top = (parseInt(bg.style.top) + $height)+"px";
				$x += $step + 5;
				$img.style.left = $x;
			}
			if(parseInt($img.style.top) + $img.height + (($img.width / 70) * 20 + 3)*2 > parseInt(bg.style.top) + bg.height) {
				$curbg++;
				if($curbg > 11) {
					$img.width=0;
				} else {
					bg=$("#bg"+$curbg)[0];
					bg.style.display = "block";
					$offsetSide = 0;
					$x = 0;
					$y = 0;
					$height=$offsetTop;
					$img.style.top = (parseInt(bg.style.top) + $offsetTop)+"px";
					$offsetSide = $x = $img.style.left = 10 + (parseInt(bg.style.left) + (bg.width/2)) -
						Math.pow((Math.pow((bg.width/2),2) - Math.pow(((bg.width/2) - $offsetTop),2)),1/2);
				}
			}
			$text.style.top = parseInt($img.style.top) + $img.height;
			$text.style.left = $img.style.left;
			$text.style.width = $img.width;
			$text.style.fontSize = ($img.width / 70) * 20;
		}
		$("#difSizing")[0].style.top = parseInt(($curbg/3) + 1) * 366 + parseInt($curbg/6) * 60;
		$("#saveBut")[0].style.top = parseInt(($curbg/3) + 1) * 366 + 40 + parseInt($curbg/6) * 60;
		$("#asImageBut")[0].style.top = parseInt(($curbg/3) + 1) * 366 + 70 + parseInt($curbg/6) * 60;
		$("#changeName")[0].style.top = parseInt(($curbg/3) + 1) * 366 + 90 + parseInt($curbg/6) * 60;
		for($n=$curbg+1; $n<12; $n++) {
			$("#bg"+$n)[0].style.display = "none";
		}
	}
	
	if (!isImgsExists) { 
		reposition();
	}
		$("#difSizing").change(function(){
			if(Number(this.value)<=70 && Number(this.value)>=40) {
				$height=$offsetTop=$step=Number(this.value);
				bg = $("#bg0")[0];
				$curbg = 0;
				$offsetSide = 0;
				$x = 0;
				$y = 0;
				reposition();
			}
		});
		$("#bg").on("mousemove", function(e){
			if(isDraging){
				var image=document.getElementById("backside");
				mouse_x = window.event.clientX;
				mouse_y = window.event.clientY;
				if(mouse_x!=0){
					image.style.top=(mouse_y-offsetY);
					image.style.left=(mouse_x-offsetX);
				}
			}
		});
		$("input[type='file']").change(function(){
			var input = $(this)[0];
			var index = 0;
			var filename = input.files[index].name.replace(/.*\\/, "");
			var name=filename;
			if (input.files && input.files[index]) {
				if (input.files[index].type.match('image.*')) {
					var reader = new FileReader();
					reader.onload = function (e) {
						text=document.getElementById(input.id.replace("file","filename"));
						text.innerHTML = name;
					}
					reader.readAsDataURL(input.files[index]);
				}
			}
		});
		$("#back").click(function(){
			window.location.href = "../main/main.php";
		});
		$("#asImageBut").click(function(){
			window.location.href = "1image.php";
		});
		$("#changeNameNumber").change(function(){
		  if(this.value>0 && this.value<58) {
			$("#changingNamesDiv")[0].style.display = "block";
			$("#changedNameImage")[0].src = path + this.value + ".png";
			$oldName=$("#changingName")[0];
			$oldName.innerHTML = $names[Number(this.value)] + "   ->   " + "<input type='text' id='newName' placeholder='Input new name'>";
		  }
		});
	  $("#changeNameBut").click(function(){
		 $newName =  $("#newName")[0].value;
		 if($newName != "") {
			 $.ajax({
				 type: "POST",
				 url: "../main/changeName.php",
				 data: {
					 path: path,
					 num: $("#changeNameNumber")[0].value,
					 newName: $newName
				 },
				 success: function(){
					$oldName=$("#changingName")[0];
					$oldName.innerHTML = $newName + "   ->   " + "<input type='text' id='newName' placeholder='Input new name'>";
					$names[Number($("#changeNameNumber")[0].value)] = $newName;
				 }
			 })
		 }
	  });
		$("#saveBut").click(function(){
			var texts = [];
			var imgs = [];
			for( n = 1; n < maxCount + 1; n++){
				img=$("#img"+n)[0];
				imgs[n-1] = img.style.top.substring(0, img.style.top.length - 2) + 
				" " + img.style.left.substring(0,img.style.left.length-2) + " " +
				+ img.width;
				text=$("#text"+n)[0];
				texts[n-1] = text.style.top.substring(0, text.style.top.length - 2) + 
				" " + text.style.left.substring(0,text.style.left.length-2) + " " + text.style.fontSize.substring(0,text.style.fontSize.length-2);
		   }
		   $.ajax({
			    type: "POST",
				 url: "save.php",
				 data: {
					 path: path,
					 imgs: imgs,
					 texts: texts
				 },
				 success: function(msg){
					alert("Success!");
				 }
		   })
		   
		});
		var el=[];
		var text=[];
		var curImg;
		for($n=1; $n<maxCount + 1; $n++){
			el[$n]=document.getElementById("img"+$n);
			el[$n].onmousedown=function(e) {
				var offsetX=window.event.clientX-this.offsetLeft;
				var offsetY=window.event.clientY-this.offsetTop;
				curImg = this;
				
				document.onmousemove=function(e){
					mouse_x = window.event.clientX;
					mouse_y = window.event.clientY;
					if(mouse_x!=0){
						curImg.style.top=(mouse_y-offsetY);
						curImg.style.left=(mouse_x-offsetX);
					}
				}
				curImg.onmouseup=function(e){
					document.onmousemove=null;
					this.onmouseup=null;
				}
			}
			el[$n].ondragstart=function(e){
				return false;
			}
			text[$n]=document.getElementById("text"+$n);
			text[$n].onmousedown=function(e) {
				var offsetX=window.event.clientX-this.offsetLeft;
				var offsetY=window.event.clientY-this.offsetTop;
				curImg = this;
				
				document.onmousemove=function(e){
					mouse_x = window.event.clientX;
					mouse_y = window.event.clientY;
					if(mouse_x!=0){
						curImg.style.top=(mouse_y-offsetY);
						curImg.style.left=(mouse_x-offsetX);
					}
				}
				document.onmouseup=function(e){
					document.onmousemove=null;
					curImg.onmouseup=null;
				}
			}
			text[$n].ondragstart=function(e){
				return false;
			}
		}
});