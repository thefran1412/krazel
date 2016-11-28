$(function(){
    //POPUP FUNCTIONALITY: START
    var opened = false;
    $poppyScreen = $('<div id="poppyScreen"></div>');
    $poppy = $(".poppy");
    resize();
    $(window).resize(function() {
        resize();
    });
    $('#login').on("click",function(){
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
    $("#loginform").submit(function(e){
        e.preventDefault();
        if ($("#username").val() == "" || $("#passwd").val() == "") {
        	console.log('values empty');
        	$('.error').html("There's empty fields.");
        	$('.error').fadeIn('fast');
        }
        else{
        	$('.error').hide();
	        $.ajax({
	            method: "POST",
	            url: "src/login.php",
	            data: {User: $("#username").val(), Password: $("#passwd").val()},
	            success: function(result){
	                console.log(result);
	                if(result == "failed"){
	                	$('.error').html("Username or password don't match");
        				$('.error').fadeIn('fast');
	                }
	                else if (result == "empty") {
	                	$('.error').html("There's empty fields.");
        				$('.error').fadeIn('fast');
	                }
	                else{
	                	window.location.replace("index.php");
	                	//location.href=location.href.replace(/&?action=([^&]$|[^&]*)/i, "");
	                }
	            }
	        });
        }
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
    opened = false;
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