$(function(){
    demoUpload();
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
            reset();
            $('body').css('overflow', 'hidden');
            window.scrollTo(0, 0);
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

    document.getElementById("upload").onchange = function (){
        if ($('#upload').val() == "") {
            err('Nothing selected.');
        }
        else{ 
            $("#options").hide();
            $("#crop").show();
        }
    };
    $("#upform").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "upload.php",
            success: function(result){
                console.html(result);
            }
        });
    });

});

//POPUP: start
function reset(){
    $("#options").show();
    $("#crop").hide();
    $('#upload').val('');
}
function resize(){
    var l = ($(window).width())/4;
    var w =  l + "px";
    $poppy.css({"left":w});
}
function closePoppy(){
    $("#poppyScreen, .poppy").fadeOut();
    $('body').css('overflow-y', 'auto');
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

//POPUP: end


    function output(node) {
        var existing = $('#result .croppie-result');
        if (existing.length > 0) {
            existing[0].parentNode.replaceChild(node, existing[0]);
        }
        else {
            $('#result')[0].appendChild(node);
        }
    }
    function demoUpload() {
        var $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');
                    $uploadCrop.croppie('bind', {
                        url: e.target.result,
                        zoom: 0
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
                width: 350,
                height: 350
            },
            boundary: {
                width: 500,
                height: 400
            },
            enableExif: true

        });

        $('#upload').on('change', function () { readFile(this); });

        document.querySelector('.upload-result').addEventListener('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (blob) {
                $("#url").val(blob);
            });
        });
    }

    function bindNavigation () {
        var $body = $('body');
        $('nav a').on('click', function (ev) {
            var lnk = $(ev.currentTarget),
                href = lnk.attr('href'),
                targetTop = $('a[name=' + href.substring(1) + ']').offset().top;

            $body.animate({ scrollTop: targetTop });
            ev.preventDefault();
        });
    }
