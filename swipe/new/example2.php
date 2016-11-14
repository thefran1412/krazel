<!DOCTYPE html>
<html>
  <head>
    <title>cropit</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="cropit/dist/jquery.cropit.js"></script>

    <style>
      .cropit-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 5px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 250px;
        height: 250px;
      }

      .cropit-preview-image-container {
        cursor: move;
      }

      .cropit-preview-background {
        opacity: .2;
        cursor: auto;
      }

      .image-size-label {
        margin-top: 10px;
      }

      input, .export {
        /* Use relative position to prevent from being covered by image background */
        position: relative;
        z-index: 10;
        display: block;
      }

      button {
        margin-top: 10px;
      }
      /* Show load indicator when image is being loaded */
.cropit-preview.cropit-image-loading .spinner {
  opacity: 1;
}

/* Show move cursor when image has been loaded */
.cropit-preview.cropit-image-loaded .cropit-preview-image-container {
  cursor: move;
}

/* Gray out zoom slider when the image cannot be zoomed */
.cropit-image-zoom-input[disabled] {
  opacity: .2;
}

/* Hide default file input button if you want to use a custom button */
input.cropit-image-input {
  visibility: hidden;
}

/* The following styles are only relevant to when background image is enabled */

/* Translucent background image */
.cropit-preview-background {
  opacity: .2;
}

/*
 * If the slider or anything else is covered by the background image,
 * use non-static position on it
 */
input.cropit-image-zoom-input {
  position: relative;
}

/* Limit the background image by adding overflow: hidden */
#image-cropper {
  overflow: hidden;
}
    </style>
  </head>
  <body>
    <div class="image-editor">
      <input type="file" class="cropit-image-input">
      <div class="cropit-preview"></div>
      <div class="image-size-label">
        Resize image
      </div>
      <input type="range" class="cropit-image-zoom-input">
      <button class="rotate-ccw">Rotate counterclockwise</button>
      <button class="rotate-cw">Rotate clockwise</button>

      <button class="export">Export</button>
    </div>
    <!-- Preview is relative positioned -->
<!-- Add a wrapper if you need to absolute position it -->
<div class="cropit-preview">
  <!-- Background image container is absolute positioned -->
  <div class="cropit-preview-background-container">
    <img class="cropit-preview-background" />
  </div>
  <!-- Image container is also absolute positioned -->
  <div class="cropit-preview-image-container">
    <img class="cropit-preview-image" />
  </div>
</div>

<!-- Zoom slider -->
<input type="range" class="cropit-image-zoom-input" />

<!-- File selector ->
<!-- cropit will add accept="image/*" attribute to it -->
<input type="file" class="cropit-image-input" />

    <script>
      $(function() {
        $('.image-editor').cropit({
          exportZoom: 1.25,
          imageBackground: true,
          imageBackgroundBorderWidth: 20,
          imageState: {
            src: 'http://lorempixel.com/500/400/',
          },
        });

        $('.rotate-cw').click(function() {
          $('.image-editor').cropit('rotateCW');
        });
        $('.rotate-ccw').click(function() {
          $('.image-editor').cropit('rotateCCW');
        });

        $('.export').click(function() {
          var imageData = $('.image-editor').cropit('export');
          window.open(imageData);
        });
      });
    </script>
  </body>
</html>
