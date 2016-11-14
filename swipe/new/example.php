<!DOCTYPE html>
<html>
<head>
	<title>example</title>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="http://malsup.github.com/jquery.form.js"></script> 

    <link rel="Stylesheet" type="text/css" href="croppie/croppie.css" />
    <script src="croppie/croppie.js"></script>
</head>
<body>
	<div class="demo-wrap">
                <div class="container">
                    <div id="demo-basic"></div>
                    <img src="croppie/demo/cat.jpg" class="image">
                </div>
            </div>
</body>
<script type="text/javascript">
	$('.image').croppie();

	//demoBasic();
	/*function demoBasic() {
		var $w = $('.basic-width'),
			$h = $('.basic-height'),
			basic = $('#demo-basic').croppie({
			viewport: {
				width: 200,
				height: 200
			},
			boundary: {
				width: 300,
				height: 300
			}
		});
		basic.croppie('bind', {
			url: 'croppie/demo/cat.jpg',
			points: [77,469,280,739]
		});
	}*/
</script>
</html>