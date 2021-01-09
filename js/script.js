$(document).ready(function () {
    $('.navar li').each(function () {
        if ("https://car-tch.herokuapp.com" + window.location.pathname == + $(this).children().attr("href") || $(this).children().attr("href") === '#') {
            console.log("path: ", window.location.pathname);
            console.log("href: ", $(this).children().attr("href"));
            console.log("sum: ", window.location.pathname, $(this).children().attr("href"));
            // $(this).addClass('active').siblings().removeClass('active');
            return false;
        } else {
            console.log("path: ", window.location.pathname);
            console.log("href: ", $(this).children().attr("href"));
            console.log("sum: ", window.location.pathname, $(this).children().attr("href"));
        }
    })
});

$('.our-team .box .member .overlay').hover(function () {
    $(this).fadeToggle(1500);
});

