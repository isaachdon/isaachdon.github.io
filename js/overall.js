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
    
});