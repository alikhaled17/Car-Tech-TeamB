$(document).ready(function () {
    $('.navar li').each(function () {
        if (($(this).children().data('path')).indexOf(window.location.pathname) != -1 || $(this).children().attr("href") === '#') {
            console.log("exist");
            console.log("path: ", "https://car-tch.herokuapp.com");
            console.log("href: ", $(this).children().attr("href"));
            console.log("sum: ", ("https://car-tch.herokuapp.com" + window.location.pathname));
            console.log("data-path: ", $(this).children().data('path'));
            $(this).addClass('active').siblings().removeClass('active');

            return false;
        } else {
            console.log("not found");
            console.log("path: ", "https://car-tch.herokuapp.com");
            console.log("href: ", $(this).children().attr("href"));
            console.log("sum: ", ("https://car-tch.herokuapp.com" + window.location.pathname));
            console.log("data-path: ", $(this).children().data('path'));

        }
    })
});

$('.our-team .box .member .overlay').hover(function () {
    $(this).fadeToggle(1500);
});

