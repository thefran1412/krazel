// $(function(){
// 	/*document.getElementById("fileToUpload").onchange = function () {
// 	   if ($('#fileToUpload').val() == "") {
// 	   		$('#complete').show();
// 	 		$('.jcrop-holder').hide();
// 	 		$("#complete").html("<h4 style='color: red;'>Nothing Selected</h4>");
// 	   }
// 	   else{
// 			if ($('#fileToUpload').val().slice(-4)=='.jpg' || $('#fileToUpload').val().slice(-4)=='jpeg' || $('#fileToUpload').val().slice(-4)=='.png' || $('#fileToUpload').val().slice(-4)=='.JPG' || $('#fileToUpload').val().slice(-4)=='JPEG' || $('#fileToUpload').val().slice(-4)=='.PNG'){
// 				$('.jcrop-holder').remove();
// 				$("#complete").hide();
// 				initJcrop();
// 				var reader = new FileReader();
// 				reader.onload = function (e) {
// 			        // get loaded data and render thumbnail.
// 			        document.getElementById("image").src = e.target.result;
// 			        changeImage(e.target.result);
// 			    };
// 			    // read the image file as a data URL.
// 			    reader.readAsDataURL(this.files[0]);
// 			}
// 	   		else{
// 	   			$('.jcrop-holder').hide();
// 	   			$('#complete').show();
// 	 			$("#complete").html("<h4 style='color: red;'>File format not allowed</h4>");
// 	   		}
// 	   }
// 	};*/

// 	$('#myForm').ajaxForm({
// 	 	beforeSend:function(){
// 	 		$("#hide").slideUp();
// 	 	},
// 	 	uploadProgress:function(event,position,total,percentComplete){
// 	 		$(".sr-only").html(percentComplete+'%'); // show the percentage number
// 	 	},
// 	 	success:function(){
// 	 	},
// 	 	complete:function(response){
// 	 		if(response.responseText=='0'){
// 	 			$('#complete').show();
// 	 			$("#complete").html("<h3 style='color: red;'>File is not an image</h3>");
// 	 		}
// 	 		else if(response.responseText=='1'){
// 	 			$('#complete').show();
// 	 			$("#complete").html("<h3 style='color: red;'>Image too large</h3>");
// 	 		}
// 	 		else if(response.responseText=='2'){
// 	 			$('#complete').show();
// 	 			$("#complete").html("<h3 style='color: red;'>File format not allowed</h3>");
// 	 		}
// 	 		else if(response.responseText.substring(0, 8)=='uploads/'){
// 	 			$('#complete').show();
// 	 			$("#complete").html("<h3 style='color: green;'>Complete!</h3>");
// 	 		}

// 	 		else{
// 	 			$('#complete').show();
// 	 			$("#complete").html("<h3 style='color: red;'>Invalid image or not selected</h3>");
// 	 		}
// 	 	}
// 	 });
	
// });

// function hola() {
//     alert('done');
// };
// function showCoords(c){
// 	document.getElementById("x").value=c.x;
// 	document.getElementById("y").value=c.y;
// 	document.getElementById("w").value=c.w;
// 	document.getElementById("h").value=c.h;
// 	$('input[type="submit"]').prop('disabled', false);
// };
// function disable(){
// 	$('input[type="submit"]').prop('disabled', true);
// };
// function initJcrop(){
//     jcrop_api = $.Jcrop('#image', {
//     	boxWidth: 460,
//     	aspectRatio: 1,
//     	onSelect: showCoords,
//     	onRelease: disable,
// 	});
// };
// function changeImage(url){
// 	jcrop_api.setImage(url);
// 	//jcrop_api.setSelect([0,0,10000,10000]);
// }
// function send(){
// 	$.ajax({
// 		url:'controller/cortarController.php',
// 		type:'POST',
// 		data:'x='+x+'&y='+y+'&w='+w+'&h='+h,
// 		success:function(rpt){
// 			$("#destino").html(rpt);
// 		}
// 	});
// };
// function popup_img() {
// 	alert('popup');
// }