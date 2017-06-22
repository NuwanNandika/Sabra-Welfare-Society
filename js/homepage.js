$(document).ready(function() {
    $(window).bind('scroll', function(e){
        parallax();
    });
    
    $('a#middle').click(function(){
        $('html, body').animate({ scrollTop:$('#title1').offset().top }, 1000);
        return false;
    });
    
    $('a#next').click(function(){
        $('html, body').animate({ scrollTop:$('#title2').offset().top }, 1000);
        return false;
    });
    
    $('a#explore').click(function(){
        $('html, body').animate({ scrollTop:$('#joinUs').offset().top }, 1000);
        return false;
    });
    
    $('a#questions').click(function(){
        $('html, body').animate({ scrollTop:$('#form').offset().top }, 1000);
        return false;
    });
    
    $('a#arrow').click(function(){
        $('html, body').animate({ scrollTop:$('#header').offset().top }, 1000);
        return false;
    });
    
 
});


function parallax(){
    var scrollPosition = $(window).scrollTop();
    $('#header').css('top', (0 - (scrollPosition* 0.5))+'px');
    $('#slideShow').css('top', (0 - (scrollPosition* 0.2))+'px');
    $('#navBar').css('top', (0 - (scrollPosition* 0.5))+'px');
    //$('#joinUs').css('top', (0 - (scrollPosition* 0.5))+'px');
}
