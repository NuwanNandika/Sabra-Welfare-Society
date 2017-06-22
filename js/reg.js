$(document).ready(function() {
    $(window).bind('scroll', function(e){
        parallax();
    });
});


function parallax(){
    var scrollPosition = $(window).scrollTop();
    //$('#bgImage').css('top', (0 - (scrollPosition* 0.5))+'px');
    $('#cover').css('top', (0 - (scrollPosition* 0.5))+'px');
}
