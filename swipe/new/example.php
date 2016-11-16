<!DOCTYPE html> 
<html lang ="en">
    <head>
        <meta charset="UTF-8" >
        <title>Example Croppie</title>
        <link rel="Stylesheet" type="text/css" href="croppie/croppie.css" />
    </head>
    <body>
        
        <section>     
           	<div class="upload-demo">
                <div class="container">
                    <div class="grid">
                        <div>
                            <div class="actions">
                                <a class="btn file-btn">
                                    <span>Upload</span>
                                    <input type="file" id="upload" value="Choose a file" accept="image/*" />
                                </a>
                                <button class="upload-result">Result</button>
                            </div>
                        </div>
                        <div id="view">
                            <div class="upload-demo-wrap">
                                <div id="upload-demo"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="croppie/croppie.js"></script>
        <script src="demo.js"></script>
        <script>
            Demo.init();
        </script>
    </body>
</html>


<!-- <script type="text/javascript">
	//$('.image').croppie();
	/*$( "#target" ).click(function() {
		result({ type, size, format, quality, circle });
			basic.croppie('result', 'html').then(function(html) {
		});
	});
	demoBasic();
	function demoBasic() {
		var el = document.getElementById('demo-basic');
		var url = 'croppie/demo/demo-1.jpg';
		var hola = new Croppie(el, {
	    viewport: { width: 200, height: 200 },
	    boundary: { width: 300, height: 300 },
	    showZoomer: true
	    
	});

		hola.bind({
		    url: url,
		    orientation: 4,
		    zoom: 0
		});
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
			},
			setZoom: 0

		});
		*/
	    demoUpload();
		function demoUpload() {
			var $uploadCrop;
			$uploadCrop = $('#upload-demo').croppie({
				viewport: {
					width: 100,
					height: 100,
					type: 'circle'
				},
				enableExif: true
			});

			$('#upload').on('change', function () {
				console.log('hi21');
				readFile(this); 
			});
			$('.upload-result').on('click', function (ev) {
				$uploadCrop.croppie('result', {
					type: 'canvas',
					size: 'viewport'
				}).then(function (resp) {
					popupResult({
						src: resp
					});
				});
			});
			function readFile(input) {
	 			if (input.files && input.files[0]) {
		            var reader = new FileReader();
		            
		            reader.onload = function (e) {
						$('.upload-demo').addClass('ready');
		            	$uploadCrop.croppie('bind', {
		            		url: e.target.result
		            	}).then(function(){
		            		console.log('jQuery bind complete');
		            	});
		            }
		            reader.readAsDataURL(input.files[0]);
		        }
		        else {
			        swal("Sorry - you're browser doesn't support the FileReader API");
			    }
			}
		}

</script> -->


<?php


/*function demoUpload() {
		var $uploadCrop;

		function readFile(input) {
 			if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
					$('.upload-demo').addClass('ready');
	            	$uploadCrop.croppie('bind', {
	            		url: e.target.result
	            	}).then(function(){
	            		console.log('jQuery bind complete');
	            	});
	            	
	            }
	            
	            reader.readAsDataURL(input.files[0]);
	        }
	        else {
		        swal("Sorry - you're browser doesn't support the FileReader API");
		    }
		}

		$uploadCrop = $('#upload-demo').croppie({
			viewport: {
				width: 100,
				height: 100,
				type: 'circle'
			},
			enableExif: true
		});

		$('#upload').on('change', function () { readFile(this); });
		$('.upload-result').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {
				popupResult({
					src: resp
				});
			});
		});
	}*/
	?>