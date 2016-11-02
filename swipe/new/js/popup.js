$(function(){
    $('#x').removeAttr('required');
    document.getElementById("fileToUpload").onchange = function (){
       if ($('#fileToUpload').val() == "") {
            $('#complete').show();
            $("#complete").html("<h4 style='color: red;'>Nothing Selected</h4>");
       }
       else{
            if ($('#fileToUpload').val().slice(-4)=='.jpg' || $('#fileToUpload').val().slice(-4)=='jpeg' || $('#fileToUpload').val().slice(-4)=='.png' || $('#fileToUpload').val().slice(-4)=='.JPG' || $('#fileToUpload').val().slice(-4)=='JPEG' || $('#fileToUpload').val().slice(-4)=='.PNG'){
                
                $("#complete, #select").hide();
                //remove old jcrop and add new one
                $('.jcrop-holder').remove();
                initJcrop();
                var reader = new FileReader();
                //console.log($('#fileToCrop').val());
                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("image").src = e.target.result;
                    changeImage(e.target.result);
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
                $("#preview").fadeIn();
            }
            else{
                $('.jcrop-holder').hide();
                $('#complete').show();
                $("#complete").html("<h4 style='color: red;'>File format not allowed</h4>");
            }
       }
    };
    $('#resizeForm').ajaxForm({
        beforeSend:function(){
            $("#preview").slideUp();
        },
        uploadProgress:function(event,position,total,percentComplete){
            $(".sr-only").html(percentComplete+'%'); // show the percentage number
        },
        success:function(){
        },
        complete:function(response){
            if(response.responseText=='0'){
                $('#complete').show();
                $("#complete").html("<h3 style='color: red;'>File is not an image</h3>");
            }
            else if(response.responseText=='1'){
                $('#complete').show();
                $("#complete").html("<h3 style='color: red;'>Image too large</h3>");
            }
            else if(response.responseText=='2'){
                $('#complete').show();
                $("#complete").html("<h3 style='color: red;'>File format not allowed</h3>");
            }
            else if(response.responseText.substring(0, 8)=='uploads/'){
                $('#complete').show();
                $("#complete").html("<h3 style='color: green;'>Complete!</h3>");
                 $("#poppyScreen, .poppy").fadeOut();
            }

            else{
                $('#complete').show();
                $("#complete").html("<h3 style='color: red;'>Invalid image or not selected</h3>");
            }
        }
     });
});
(function(){
    $.fn.poppy = function(){
        $poppyScreen = $('<div id="poppyScreen"></div>');
        $poppy = $(".poppy");
        $("body").prepend($poppyScreen);
        $poppy.hide().each(function(){
            $(this).prepend('<div class="close-btn"></div><div class="min-btn"></div>');
        });
        function resize(){
            var l = ($(window).width())/4;
            var w =  l + "px";
            $poppy.css({"left":w});
        }
        function closePoppy(){
            $("#poppyScreen, .poppy").fadeOut();
        }
        $(".close-btn, #poppyScreen").on("click",function(){
            closePoppy();
        });
        resize();
        $(window).resize(function() {
          resize();
        });
        this.on("click",function(){
            $poppy.fadeIn();
            $poppyScreen.fadeIn();
        });
    };
})(jQuery);
function showCoords(c){
    document.getElementById("x").value=c.x;
    document.getElementById("y").value=c.y;
    document.getElementById("w").value=c.w;
    document.getElementById("h").value=c.h;
    $('input[type="submit"]').prop('disabled', false);
};
function disable(){
    $('input[type="submit"]').prop('disabled', true);
};
function initJcrop(){
    jcrop_api = $.Jcrop('#image', {
        boxWidth: 460,
        aspectRatio: 1,
        onSelect: showCoords,
        onRelease: disable,
    });
};
function changeImage(url){
    jcrop_api.setImage(url);
    //jcrop_api.setSelect([0,0,10000,10000]);
}

