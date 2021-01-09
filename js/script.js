$(document).ready(function () {
    $('.navar li').each(function () {
        if (window.location.pathname == "https://care-tech.herokuapp.com" + $(this).children().attr("href") || $(this).children().attr("href") === '#') {
            console.log(window.location.pathname);
            console.log("-- ", $(this).children().attr("href"));
            $(this).addClass('active').siblings().removeClass('active');
            return false;
        }
    })
});

$('.our-team .box .member .overlay').hover(function () {
    $(this).fadeToggle(1500);
});

