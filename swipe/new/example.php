<!DOCTYPE html> 
<html lang ="en">
    <head>
        <meta charset="UTF-8" >
        <title>Example Croppie</title>
        <link rel="Stylesheet" type="text/css" href="croppie/croppie.css" />
    </head>
    <body>
        
        <section>     
           	<div>
                <div>
                    <div class="grid">
                        <div>
                            <div class="actions">
                                <a class="btn file-btn">
                                    <span>Upload</span>
                                    <input type="file" id="upload" value="Choose a file" accept="image/*" />
                                </a>
                                <form method="post" action="upload.php">
                                	<input type="hidden" id="url" name="url">
                                	<input type="submit" class="upload-result" name="Upload">
                                </form>
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