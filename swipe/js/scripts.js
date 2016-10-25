var paginas = 0;
$(function() {
	//alert('Page: '+getPage()+' | '+getCat());
	//alert(getSquares(getPage(), getCat(), 1));
	//var paginas = getSquares(getPage(), getCat(), 0);
	getSquares(getPage(), getCat(), 0);
	getSquares(getPage(), getCat(), 1);

});
$(window).on('hashchange', function(e){
	//alert('Page: '+getPage()+' | '+getCat());
	if (getPage() <= paginas && getPage() >= 1){
		$("#cont_square").html('loading');
		$("#cont_square").html(getSquares(getPage(), getCat(), 1));
	}
	else if(getPage() < 1) {
		document.location.hash = '#page1';
	}
	else{
		document.location.hash = '#page'+paginas;
	}
});

function getSquares(page, cat, squares){
	$.ajax({
		method: "POST",
		url: "src/pagination.php",
		data: { page: page, cat: cat, sq: squares},
		success: function(output) {
			if(squares == 1){
				$("#cont_square").html('');
				$('#cont_square').append(output);
			}
			else{
				 paginas = Math.ceil((parseInt(output)-7)/12+1);
				 $('#hola').html('Page '+page+' of '+paginas);
				 if(page >= paginas){
				 	document.location.hash = '#page'+paginas;
				 	$('#next').prop("disabled", true);
				 }
				 else if(page <= 1){
				 	document.location.hash = '#page1';
				 	$('#previous').prop("disabled", true);
				 }
			}
			$('#pageinfo').html('Page '+page+' of '+paginas);
		}
	})
}
function getTotalPages(page, cat){
	$.ajax({
		method: "POST",
		url: "src/pagination.php",
		data: { page: page, cat: cat},
		success: function(output) {
			$("#cont_square").html('');
			$('#cont_square').append(output);
		}
	})
}
function getPage(){
		var anchor = document.location.hash;
		if (anchor == "") {
			return 1;
		}
		else{
			var page = anchor.substring(5);
			if ($.isNumeric(page)){
				return parseInt(page);
			}
			else{
				return 1;
			}
			return 1;
		}
}
function getCat() {
	var id = $_GET('category');
	if ($.isNumeric(id)){
		return parseInt(id);
	}
	else{
		return null;
	}
}
function prvsPage() {
	$(function(){
		var page = getPage();
		if (paginas == 1){
			$('#next').prop("disabled", true);
		}
		else{
			$('#next').prop("disabled", false);
		}
		if(page > 1){
			page = parseInt(page)-1;
			document.location.hash = '#page'+page;
			if (page <= 1){
				$('#previous').prop("disabled", true);	
			}
			else{
				$('#previous').prop("disabled", false);	
			}
		}
		else{
			document.location.hash = '#page'+1;
			$('#previous').prop("disabled", true);
		}
	});
}
function nextPage() {
	var page = getPage();
	$('#previous').prop("disabled", false);
	$(function(){
		if(page >= paginas){
			document.location.hash = '#page'+paginas;
			$('#next').prop("disabled", true);
		}
		else{
		 	page = page+1;
		 	document.location.hash = '#page'+page;
		 	if (page >= paginas){
		 		$('#next').prop("disabled", true);
		 	}
		 	else{
		 		$('#next').prop("disabled", false);
		 	}
		}
	 
	});
}

function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}