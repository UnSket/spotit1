	$(document).ready(function(){ 

		$("#bg").on("mousemove", function(e){
			if(isDraging){
				var image=document.getElementById("backside");
				mouse_x = window.event.clientX;
				mouse_y = window.event.clientY;
				if(mouse_x!=0){
					image.style.top=(mouse_y-offsetY)+"px";
					image.style.left=(mouse_x-offsetX)+"px";
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
		$("#save").click(function(){
			var img = $("#backside")[0];
			var bg = $("#bg")[0];
			var inf = $("#inf")[0];
			inf.value = (img.style.top.substring(0, img.style.top.length - 2) - bg.style.top.substring(0, bg.style.top.length - 2)) + 
				" " + (img.style.left.substring(0,img.style.left.length-2)- bg.style.left.substring(0,bg.style.left.length-2)) 
				+ " " + img.width;
				console.log(inf);
		});
	});
	var isDraging = false;
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
	el=document.getElementById("backside");
	bg=document.getElementById("bg");
    addOnWheel(bg, function(e) {
      var delta = e.deltaY || e.detail || e.wheelDelta;
      // отмасштабируем при помощи CSS
      if (delta > 0) scale = 0.9;
      else scale = 1.1;
      el.width = el.height *=scale;
      // отменим прокрутку
      e.preventDefault();
	});
	var bg=document.getElementById('bg');
	bg.ondragstart = function() {
		var image=document.getElementById("backside");
		isDraging = true;
		offsetX=window.event.clientX-image.offsetLeft;
		offsetY=window.event.clientY-image.offsetTop;
		return false;
	};
	bg.onmouseup = function() {
		isDraging = false;
	};