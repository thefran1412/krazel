$( document ).ready(function() {
	getSelect();
	$('.add_cat').on( "click", function() {
        $('.select').toggle();
    });
});

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
				'<p>'+name+'</p><div class="cat-close" onclick="deletee('+id+');"></div>'+
			'</div>'+
			'<div class="cat-content"></div>'+
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
		$( ".cat-selected" ).find(".cat-"+id).parent().children('.cat-content').append('<div class="cat-sub">'+val.name+'<input type="number" name="'+val.id+'" min="1"></div>');
	});
}
