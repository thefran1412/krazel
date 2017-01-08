$( document ).ready(function() {
	getSelect();
	$(document).on("click", '.cat-sub', function(event) { 
		$(this).toggleClass('selected');
	});
	var sd = [];
	$(document).on("click", '.subsub', function(event) { 
		sd = [];
		$(this).parent().parent().children('.subcont').find('.selected').each(function() {
			var text = $(this).children('.cat-sub-text').text();
			var id = $(this).children('.cat-sub-id').text();
			sd.push([id, text]);
		});
		// console.log(sd);
		$('.subsel').fadeOut();
		jQuery.each( sd, function( i, val ) {
			$('.cat-content').append(
				'<div class="sub">'+
					'<p hidden>'+val[0]+'</p>'+
					'<p>'+val[1]+'</p>'+
					'<input type="number">'+
				'</div>');
		});
	});
	$(document).on("click", '.mylink', function(event) { 
	    alert("new link clicked!");
	});
	$('.add_cat').on( "click", function() {
        $('.select').toggle();
    });
});
function select (id){
	console.log('exec');
}
function deletee(id) {
	console.log('exec');
	$(".cat-selected" ).find(".cat-"+id).parent().remove();
}
function addcat(id, name){
	$('.select').hide();
	getSub(id);
	
	$('#categoryes').append(
		'<div class="cat-selected">'+
			'<p hidden class="cat-'+id+'"></p>'+
			'<div class="cat-header">'+
				'<p>'+name+'</p>'+
				'<div class="cat-close" onclick="deletee('+id+');"></div>'+
			'</div>'+
			'<div class="cat-content">'+
				'<div class="subsel">'+
					'<div class="subcont"></div>'+
					'<div class="subfoot">'+
						'<button class="subsub">Done</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>');
}

function getSelect(){
	$.ajax({
		method: "POST",
		url: "actions.php",
		data: {action: 'selectcat'},
		success: function(output) {
			var response = jQuery.parseJSON(output);
			jQuery.each( response, function( i, val ) {
				var image = val.image;
				var name = val.name;
				var id = val.id;
				var char = "'";
			$('.select').append(
				'<div onclick="addcat('+id+', '+char+name+char+');" class="catselect">'+
					'<div >'+name+'</div>'+
				'</div>');
			});
		}
	})
}

function getSub(id){
	$.ajax({
		method: "POST",
		url: "actions.php",
		data: {action: 'selectsubcat', father: id},
		success: function(output) {
			listSub(id, jQuery.parseJSON(output));
		}
	})
}
function listSub(id, array){
	jQuery.each( array, function( i, val ) {	
		$( ".cat-selected" ).find(".cat-"+id).parent().children('.cat-content').children('.subsel').children('.subcont').append(
				'<div class="cat-sub"><p class="cat-sub-text">'+val.name+'</p><p class="cat-sub-id" hidden>'+val.id+'</p></div>');
	});
}
