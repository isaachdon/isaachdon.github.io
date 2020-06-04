$(document).ready(function() {
    var lastScrollTop = 0;
    $(window).on('scroll', function() {
        st = $(this).scrollTop();
        if(st < lastScrollTop) {
            $('#header').slideDown(250);
        }
        else {
            $('#header').slideUp(250);
        }
        lastScrollTop = st;
    });

    //change widths of homepage cards on hover
    
    $('#card1').hover(function() {
        $('#card1').css('width', '50%');
        $('#card2').css('width', '23%');
        $('#card3').css('width', '23%');
    }, function() {
        $('#card1').css('width', '32%');
        $('#card2').css('width', '32%');
        $('#card3').css('width', '32%');
    });
    
    $('#card2').hover(function() {
        $('#card2').css('width', '50%');
        $('#card1').css('width', '23%');
        $('#card3').css('width', '23%');
    }, function() {
        $('#card2').css('width', '32%');
        $('#card1').css('width', '32%');
        $('#card3').css('width', '32%');
    });
    
    $('#card3').hover(function() {
        $('#card3').css('width', '50%');
        $('#card1').css('width', '23%');
        $('#card2').css('width', '23%');
    }, function() {
        $('#card3').css('width', '32%');
        $('#card1').css('width', '32%');
        $('#card2').css('width', '32%');
    });
    
});