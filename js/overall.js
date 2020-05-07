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
    
    $('#header').on('mouseOver', function(){
        $('#header').animate({
            'boxShadowX': '10px',
            'boxShadowY':'10px',
            'boxShadowBlur': '20px'
        })
    }, 250);
});