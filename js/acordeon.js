$(function(){
    $('.arrow').on("click",function(){
            var $elem = $(this);
            if ($(this).parent().children('.sub').is(":visible")) {
                $(this).parent().children('.sub').slideUp(250);
                
                $({deg: 90}).animate({deg: 0}, {
                    duration: 120,
                    step: function(now) {
                        $elem.css({
                            transform: 'rotate(' + now + 'deg)'
                        });
                    }
                });
            }
            else{
                $(this).parent().children('.sub').slideDown(250);
                $({deg: 0}).animate({deg: 90}, {
                    duration: 120,
                    step: function(now) {
                        $elem.css({
                            transform: 'rotate(' + now + 'deg)'
                        });
                    }
                });
            }
            //$(this).children('.sub').toggle();
        });

});

            /*var $elem = $('.arrow');
            // we use a pseudo object for the animation
            // (starts from `0` to `angle`), you can name it as you want
            $({deg: 0}).animate({deg: 90}, {
                duration: 0,
                step: function(now) {
                    // in the step-callback (that is fired each step of the animation),
                    // you can use the `now` paramter which contains the current
                    // animation-position (`0` up to `angle`)
                    $elem.css({
                        transform: 'rotate(' + now + 'deg)'
                    });
                }
            });*/
