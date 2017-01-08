$( document ).ready(function() {
	var selected = false;
	$('#previewimg').on('load', function () {
 		if ($('#previewimg').attr('src') == urll) {
 			selected = true;
 			$('#sub').enable();
 		}
 		else{
 			selected = false;
 		}
	});
	$('form').on('submit', function(e) {
	    e.preventDefault();
	});
});