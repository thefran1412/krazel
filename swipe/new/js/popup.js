$(function(){
    document.getElementById("fileToCrop").onchange = function (){
       if ($('#fileToCrop').val() == "") {
            $('#complete').show();
            $("#complete").html("<h4 style='color: red;'>Nothing Selected</h4>");
       }
       else{
            if ($('#fileToCrop').val().slice(-4)=='.jpg' || $('#fileToCrop').val().slice(-4)=='jpeg' || $('#fileToCrop').val().slice(-4)=='.png' || $('#fileToCrop').val().slice(-4)=='.JPG' || $('#fileToCrop').val().slice(-4)=='JPEG' || $('#fileToCrop').val().slice(-4)=='.PNG'){
                console.log($('#fileToCrop').val());
                $('.jcrop-holder').remove();
                $("#complete").hide();
                initJcrop();
                var reader = new FileReader();
                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("image").src = e.target.result;
                    changeImage(e.target.result);
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            }
            else{
                $('.jcrop-holder').hide();
                $('#complete').show();
                $("#complete").html("<h4 style='color: red;'>File format not allowed</h4>");
            }
       }
    };
});
(function( $ ){
    $.fn.poppy = function(poppyId){
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
            $poppy = $("#"+poppyId);
            $poppy.fadeIn();
            $poppyScreen.fadeIn();
        });
    };
})(jQuery);

