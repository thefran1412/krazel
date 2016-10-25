<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="js/jquery.Jcrop.min.js"></script>
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
	</head>
	<body>
		<div id="destino">
			<img src="img/instagram.jpg" id="target" />
			<input type="submit" value="crop" onclick="send();">
		</div>
	</body>
	
	<script language="Javascript">
		var x, y, w, h;
	    function showCoords(c)
		{
		x=c.x;
		y=c.y;
		w=c.w;
		h=c.h;

		};
		jQuery(function($) {
	        $('#target').Jcrop({
	        	boxWidth: 500,
	        	onSelect: showCoords,
	        	aspectRatio: 1,

	        });
	    });
		
		function send(){
			$.ajax({
				url:'controller/cortarController.php',
				type: 'POST',
				data:'x='+x+'&y='+y+'&w='+w+'&h='+h,
				success:function(rpt){
					$("#destino").html(rpt);
				}
			});
	  }
	</script>

</html>