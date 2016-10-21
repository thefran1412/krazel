function getPage(page, cat) {
	$.ajax({
		method: "POST",
		url: "src/pagination.php",
		data: { page: page, cat: cat},
		success: function(output) {
			$('#content').append(output);
		}
	})
}
function pages() {
	var url = window.location.href;
	if (url.match(/category.*/)){
		var pos = url.indexOf('?category=')+10;
		var id = url.substring(pos, pos+1);
		return id;
	}
	else{
		return null;
	} 
}