$(document).ready(function(){
	
   $(".SlideMenu1_Folder #title").click(function()
   {
		if(!isMessege){
		  if ($(this).parent().find('ul').is(':hidden'))
		  {
			 $("#SlideMenu1 > ul > li > ul").hide();
			 $(this).parent().find('ul').fadeIn();
			 if($(this).parents('td.mainTD.n1').attr('id')=='create'){
				 $('td.mainTD.n1').toggleClass('plus',true);
			 }
			 else{
				 $('td.mainTD.n1').toggleClass('plus',false);
			 }
		  }
		  else
		  {
			 if($(this).parents('td.mainTD.n1').attr('id')=='create'){
				 $('td.mainTD.n1').toggleClass('plus',false);
			 }
			 else{
				 $('td.mainTD.n1').toggleClass('plus',false);
			 }
			 $(this).parent().find('ul').fadeOut();

		  }
		}
   });
   
   $("#commitMesesge").click(function(){
	    $('div.messege').toggleClass('red', false);
		$('div.messege').toggleClass('green', false);
		$('div.maincontent').toggleClass('plus', false);
		isMessege=false;
   });
   
   $("#delete").click(function(){
		$('div.dialog').toggleClass('red',true);
		$('div.maincontent').toggleClass('plus', true);
   });
   $("#dialogCancel").click(function(){
	   $('div.dialog').toggleClass('red', false);
	   $('div.maincontent').toggleClass('plus', false);
   });
   $("#toBackside").click(function(){
	  window.location.href = "../backside/backside.php"; 
   });
   
  $("#historySend").click(function(){
	  $img=$("#historyImg")[0];
	  $name=$("#historyName")[0];
	  $counter=$("#historyCounter")[0];
	  $names.push($name.value);
	  if($name.value != "") {
		  $.ajax({
			  type: "POST",
			  url: "writeName.php",
			  data: {
					number:$img.src,
					name:$name.value,
					path: path
					},
			  success: function(msg){
					if(parseInt(msg) < maxCount + 1 && parseInt(msg) <= countImg){
					$img.src=path+msg+".png";
					$name.value="";
					$counter.innerHTML=msg+" of "+countImg;
				  } else {
					  if (countImg==maxCount) {
						  $("#historyNamer")[0].style.display="none";
						  $("#historyDone")[0].style.display="block";
					  } else {
						  $("#historyNamer")[0].style.display="none";
						  $("#historyMessege")[0].style.display="block";
					  }
				  }
			  }
			});
	  }
  });
  $("#lookHistory").click(function(){
	  window.location.href = "../history/history.php"; 
  });
  $("#changeNameNumber").change(function(){
	  if(this.value>0 && this.value<maxCount + 1) {
		$("#changingNamesDiv")[0].style.display = "block";
		$("#changedNameImage")[0].src = path + this.value + ".png";
		$oldName=$("#changingName")[0];
		$oldName.innerHTML = $names[Number(this.value) - 1] + "   ->   " + "<input type='text' id='newName' placeholder='Input new name'>";
	  }
  });
  $("#changeNameBut").click(function(){
	 $newName =  $("#newName")[0].value;
	 if($newName != "") {
		 $.ajax({
			 type: "POST",
			 url: "changeName.php",
			 data: {
				 path: path,
				 num: $("#changeNameNumber")[0].value,
				 newName: $newName
			 },
			 success: function(){
				isMessege=true;
				$('div.messege').toggleClass('green', true);
				$('#messegeText')[0].innerHTML="Name " + $names[Number($("#changeNameNumber")[0].value) - 1] + " was chaged to " + $newName;
				$('div.maincontent').toggleClass('plus', true);
				$oldName=$("#changingName")[0];
				$oldName.innerHTML = $newName + "   ->   " + "<input type='text' id='newName' placeholder='Input new name'>";
				$names[Number($("#changeNameNumber")[0].value) - 1] = $newName;
			 }
		 })
	 }
  });
   
   
   $("input[type='file']").change(function(){
	   var input = $(this)[0];
	   console.log($(this));
	   var multipleError=false;
	   var count=0;
	   var asdf=0;
	   for (index = 0; index < input.files.length; index++) {
		   asdf=Number(countImg)+Number(index);
		   if(index>=10){
				isMessege=true;
				$('div.messege').toggleClass('red', true);
				$('#messegeText')[0].innerHTML='You tried to upload more than 10 images at a time. </br> Excess will not be loaded';
				$('div.maincontent').toggleClass('plus', true);
		   }
		   else if(asdf >= maxCount && input.name=="myFiles[]"){
				isMessege=true;
				$('div.messege').toggleClass('red', true);
				$('#messegeText')[0].innerHTML='You tried to upload more than 57 images. </br> Excess will not be loaded';
				$('div.maincontent').toggleClass('plus', true);
		   }
		   else{
				var filename = input.files[index].name.replace(/.*\\/, "");
				
				if(index==0){
					var name=filename;
				}
				else{
					name=name+", "+filename;
				}
				
				if (input.files && input.files[index]) {
					if (input.files[index].type.match('image.*')) {
						var reader = new FileReader();
						reader.position = index;
						reader.onload = function (e) {
							if(input.multiple){
								if(!multipleError){
									$("#imgAddPreview"+this.position).attr('src', e.target.result);
									$("#imgAddPreview"+this.position).css("display","");
								}
							}
							else{
								imgName=input.id.replace("file","imgg");
								$("#"+imgName).attr('src', e.target.result);
								preview=document.getElementById(input.id.replace("file","preview"));
								preview.style.display="block";
								$("input[type='submit']").removeAttr('disabled');
								text=document.getElementById(input.id.replace("file","filename"));
								text.innerHTML=name;
							}
						}
						reader.readAsDataURL(input.files[index]);
						$(this).parents('.file-upload').toggleClass('red',false);
					}
					else {
						console.log('ошибка, не изображение');
						$(this).parents('.file-upload').toggleClass('red',true);
						input.value=null;
						if(input.multiple){
							text=document.getElementById(input.id.replace("file","filename"));
							text.innerHTML="Error, one or more files isn't image";
							count=0;
							multipleError=true;
							break;
						}
						else{
							imgName=input.id.replace("file","imgg");
							$('#'+imgName).removeAttr('src');
							$('#'+imgName).attr('alt', "Dowload error");
							text=document.getElementById(input.id.replace("file","filename"));
							text.innerHTML="File isn't image";
						}
					}
				} 
				else {
					console.log('хьюстон у нас проблема');
				}
			count=index+1;
			}
		}
		
		if(!multipleError && input.multiple){
			text=document.getElementById(input.id.replace("file","filename"));
			text.innerHTML=name;
		}
		if(count<10 && input.multiple){
			for(count; count<10; count++){
				$("#imgAddPreview"+count).css("display","none");
			}
		}
   });
   
   
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

	
	function lookChangedImg(number, path){
		img=document.getElementById(number.id.replace("imgNum","img"));
		img.src=path+number.value+".png";
		img.alt=alt="Image number error";
		preview=document.getElementById(number.id.replace("imgNum","preview"));
		preview.style.display="block";
	}