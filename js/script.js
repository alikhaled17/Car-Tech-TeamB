$(document).ready(function () {
    $('.navar li').each(function () {
        if ($(this).children().length) {
            if (($(this).children().attr("href")).indexOf(window.location.pathname) != -1 || $(this).children().attr("href") === '#') {
                $(this).addClass('active').siblings().removeClass('active');
                return false;
            } else {
                $('.navar li').removeClass('active');
            }
        } else {
            // console.log("else");
            return;
        }
    })
});

$('.our-team .box .member .overlay').hover(function () {
    $(this).fadeToggle(1500);
});

