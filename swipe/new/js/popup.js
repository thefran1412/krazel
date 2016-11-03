$(function(){
    //POPUP FUNCTIONALITY: START
    var opened = false;
    $poppyScreen = $('<div id="poppyScreen"></div>');
    $poppy = $(".poppy");
    resize();
    $(window).resize(function() {
        resize();
    });
    $('#poppy').on("click",function(){
        if (opened == false) {
            $("body").prepend($poppyScreen);
            $poppy.hide().each(function(){
                $(this).prepend('<div class="close-btn"></div><div class="min-btn"></div>');
            });
            $poppy.fadeIn();
            $poppyScreen.fadeIn();
            opened = true;
            $(".close-btn, #poppyScreen").on("click",function(){
                closePoppy();
                opened = false;
            });
        }
    });
    //POPUP FUNCTIONALITY: END

    document.getElementById("fileToUpload").onchange = function (){
        if ($('#fileToUpload').val() == "") {
            err('Nothing selected.');
        }
        else{
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("image").src = e.target.result;
            };
            var validate = validateImg(document.getElementById("fileToUpload").files[0]); 
            if(validate == 0){
                $("#options").hide();
                $("#crop").show();
                reader.readAsDataURL(document.getElementById("fileToUpload").files[0]);
                // jcrop_api = $.Jcrop('#image', {
                //     boxWidth: 460,
                //     aspectRatio: 1,
                //     onSelect: showCoords,
                //     onChange: showCoords,
                //     onRelease: disable,
                // });
                //getCrop();
                //changeImage(document.getElementById("image").src);
            }
            else{
                err('File extension not allowed.');
            }
        }
    };

});
function resize(){
    var l = ($(window).width())/4;
    var w =  l + "px";
    $poppy.css({"left":w});
}
function closePoppy(){
    $("#poppyScreen, .poppy").fadeOut();
}
function validateImg(file){
    var fileType = file["type"];
    var ValidImageTypes = ["image/jpeg", "image/png"];
    if ($.inArray(fileType, ValidImageTypes) < 0){
        return 1;
    }
    else{
        return 0;
    }
}
function err(text){
    $('#errors').html('<p style="color: red;">'+text+'</p>');
    $('#errors').show();
}
//CROP: START
function getCrop(){
    if ($('.jcrop-holder').length != 0) {
        $('.jcrop-holder').remove();
    }
    initJcrop();
    //jcrop_api.setSelect([10,10,100,100]);
};
function initJcrop(){
    jcrop_api = $.Jcrop('#image', {
        boxWidth: 460,
        aspectRatio: 1,
        onSelect: showCoords,
        onChange: showCoords,
        onRelease: disable,
    });
};
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
//CROP: END
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








//old version

// $(function(){
//     document.getElementById("fileToUpload").onchange = function (){
//        if ($('#fileToUpload').val() == "") {
//             $('#complete').show();
//             $("#complete").html("<h4 style='color: red;'>Nothing Selected</h4>");
//        }
//        else{
//             if ($('#fileToUpload').val().slice(-4)=='.jpg' || $('#fileToUpload').val().slice(-4)=='jpeg' || $('#fileToUpload').val().slice(-4)=='.png' || $('#fileToUpload').val().slice(-4)=='.JPG' || $('#fileToUpload').val().slice(-4)=='JPEG' || $('#fileToUpload').val().slice(-4)=='.PNG'){
//                 //remove old jcrop and add new one
//                 getCrop();
//                 $("#complete, #select").hide();
//                 $("#preview").fadeIn();
//                 //jcrop begin

//                 // var reader = new FileReader();
//                 // reader.onload = function (e) {
//                 //     document.getElementById("image").src = e.target.result;
//                 //     console.log('IMG cambiada');
//                 // };
//                 // reader.readAsDataURL(document.getElementById("fileToUpload").files[0]);
            
                
//                 //jcrop end
//             }
//             else{
//                 $('.jcrop-holder').hide();
//                 $('#complete').show();
//                 $("#complete").html("<h4 style='color: red;'>File format not allowed</h4>");
//             }
//        }
//     };
//     $('#resizeForm').ajaxForm({
//         beforeSend:function(){
//             $("#preview").slideUp();
//         },
//         uploadProgress:function(event,position,total,percentComplete){
//             $(".sr-only").html(percentComplete+'%'); // show the percentage number
//         },
//         success:function(){
//         },
//         complete:function(response){
//             if(response.responseText=='0'){
//                 $('#complete').show();
//                 $("#complete").html("<h3 style='color: red;'>File is not an image</h3>");
//             }
//             else if(response.responseText=='1'){
//                 $('#complete').show();
//                 $("#complete").html("<h3 style='color: red;'>Image too large</h3>");
//             }
//             else if(response.responseText=='2'){
//                 $('#complete').show();
//                 $("#complete").html("<h3 style='color: red;'>File format not allowed</h3>");
//             }
//             else if(response.responseText.substring(0, 8)=='uploads/'){
//                 $('#complete').show();
//                 $("#complete").html("<h3 style='color: green;'>Complete!</h3>");
//                  $("#poppyScreen, .poppy").fadeOut();
//             }

//             else{
//                 $('#complete').show();
//                 $("#complete").html("<h3 style='color: red;'>Invalid image or not selected</h3>");
//             }
//         }
//      });
// });
// (function(){
//     $.fn.poppy = function(){
//         $poppyScreen = $('<div id="poppyScreen"></div>');
//         $poppy = $(".poppy");
//         $("body").prepend($poppyScreen);
//         $poppy.hide().each(function(){
//             $(this).prepend('<div class="close-btn"></div><div class="min-btn"></div>');
//         });
//         function resize(){
//             var l = ($(window).width())/4;
//             var w =  l + "px";
//             $poppy.css({"left":w});
//         }
//         function closePoppy(){
//             $("#poppyScreen, .poppy").fadeOut();
//         }
//         $(".close-btn, #poppyScreen").on("click",function(){
//             closePoppy();
//         });
//         resize();
//         $(window).resize(function() {
//           resize();
//         });
//         this.on("click",function(){
//             $poppy.fadeIn();
//             $poppyScreen.fadeIn();
//         });
//     };
// })(jQuery);
// function showCoords(c){
//     document.getElementById("x").value=c.x;
//     document.getElementById("y").value=c.y;
//     document.getElementById("w").value=c.w;
//     document.getElementById("h").value=c.h;
//     $('input[type="submit"]').prop('disabled', false);
// };
// function disable(){
//     $('input[type="submit"]').prop('disabled', true);
// };
// function getCrop(){
//     initJcrop();
//     if ($('.jcrop-holder').length != 0) {
//         $('.jcrop-holder').remove();
//     }initJcrop();
    
//     var reader = new FileReader();
//     //console.log($('#fileToCrop').val());
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("image").src = e.target.result;
//         changeImage(e.target.result);
//         console.log('IMG cambiada');
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(document.getElementById("fileToUpload").files[0]);
//     //jcrop_api.setSelect([0, 0, 1000, 1000]);
//     //jcrop_api.setSelect([10,10,100,100]);
// };
// function initJcrop(){
//     jcrop_api = $.Jcrop('#image', {
//         boxWidth: 460,
//         aspectRatio: 1,
//         onSelect: showCoords,
//         onChange: showCoords,
//         onRelease: disable,
//     });
// };
// function changeImage(url){
//     jcrop_api.setImage(url);
// };











// function initJcrop()//{{{
//                 {
//                     jcrop_api = $.Jcrop('#image', {
//                         boxWidth: 460,
//                         aspectRatio: 1,
//                         onSelect: showCoords,
//                         onChange: showCoords,
//                         onRelease: disable,
//                         setSelect: [0, 0, 500, 500]
//                     });
//                 };
//                 //}}}

//                 // A handler to kill the action
//                 // Probably not necessary, but I like it
//                 function nothing(e)
//                 {
//                     e.stopPropagation();
//                     e.preventDefault();
//                     return false;
//                 };

//                 // Use the API to find cropping dimensions
//                 // Then generate a random selection
//                 // This function is used by setSelect and animateTo buttons
//                 // Mainly for demonstration purposes
//                 function getRandom() {
//                     var dim = jcrop_api.getBounds();
//                     return [
//                         Math.round(Math.random() * dim[0]),
//                         Math.round(Math.random() * dim[1]),
//                         Math.round(Math.random() * dim[0]),
//                         Math.round(Math.random() * dim[1])
//                     ];
//                 };

//                 // Attach interface buttons
//                 // This may appear to be a lot of code but it's simple stuff

//                 $('#setSelect').click(function(e) {
//                     // Sets a random selection
//                     jcrop_api.setSelect(0, 0, 500, 500);
//                 });

//                 $('#animateTo').click(function(e) {
//                     // Animates to a random selection
//                     jcrop_api.animateTo(getRandom());
//                 });

//                 $('#release').click(function(e) {
//                     // Release method clears the selection
//                     jcrop_api.release();
//                 });

//                 $('#disable').click(function(e) {
//                     jcrop_api.disable();

//                     $('#enable').show();
//                     $('.requiresjcrop').hide();
//                 });

//                 $('#enable').click(function(e) {
//                     jcrop_api.enable();

//                     $('#enable').hide();
//                     $('.requiresjcrop').show();
//                 });

//                 $('#rehook').click(function(e) {
//                     initJcrop();
//                     $('#rehook,#enable').hide();
//                     $('#unhook,.requiresjcrop').show();
//                     return nothing(e);
//                 });

//                 $('#unhook').click(function(e) {
//                     jcrop_api.destroy();

//                     $('#unhook,#enable,.requiresjcrop').hide();
//                     $('#rehook').show();
//                     return nothing(e);
//                 });

//                 // The checkboxes simply set options based on it's checked value
//                 // Options are changed by passing a new options object

//                 // Also, to prevent strange behavior, they are initially checked
//                 // This matches the default initial state of Jcrop

//                 $('#can_click').change(function(e) {
//                     jcrop_api.setOptions({ allowSelect: !!this.checked });
//                     jcrop_api.focus();
//                 });

//                 $('#can_move').change(function(e) {
//                     jcrop_api.setOptions({ allowMove: !!this.checked });
//                     jcrop_api.focus();
//                 });

//                 $('#can_size').change(function(e) {
//                     jcrop_api.setOptions({ allowResize: !!this.checked });
//                     jcrop_api.focus();
//                 });

//                 $('#ar_lock').change(function(e) {
//                     jcrop_api.setOptions(this.checked? { aspectRatio: 1 }: { aspectRatio: 1 });
//                     jcrop_api.focus();
//                 });
//                 $('#size_lock').change(function(e) {
//                     jcrop_api.setOptions(this.checked? {
//                         minSize: [ 80, 80 ],
//                         maxSize: [ 350, 350 ]
//                     }: {
//                         minSize: [ 0, 0 ],
//                         maxSize: [ 0, 0 ]
//                     });
//                     jcrop_api.focus();
//                 });
//                 $('#bg_swap').change(function(e) {
//                     jcrop_api.setOptions( this.checked? {
//                         outerImage: 'http://jcrop-cdn.tapmodo.com/v0.9.10/demos/demo_files/sagomod.png',
//                         bgOpacity: 1
//                     }: {
//                         outerImage: 'http://jcrop-cdn.tapmodo.com/v0.9.10/demos/demo_files/sago.jpg',
//                         bgOpacity: .6
//                     });
//                     jcrop_api.release();
//                 });