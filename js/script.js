$(document).ready(function () {
    $('.navar li').each(function () {
        // if ("https://car-tch.herokuapp.com" + window.location.pathname == + $(this).children().attr("href") || $(this).children().attr("href") === '#') {
        if (($(this).children().attr("href")).indexOf(window.location.pathname) != -1) {
            console.log("exist");
            console.log("path: ", "https://car-tch.herokuapp.com");
            console.log("href: ", $(this).children().attr("href"));
            console.log("sum: ", "https://car-tch.herokuapp.com", window.location.pathname);
            $(this).addClass('active').siblings().removeClass('active');
            return false;
        } else {
            console.log("not found");
            console.log("path: ", "https://car-tch.herokuapp.com");
            console.log("href: ", $(this).children().attr("href"));
            console.log("sum: ", "https://car-tch.herokuapp.com", window.location.pathname);
        }
    })
});

$('.our-team .box .member .overlay').hover(function () {
    $(this).fadeToggle(1500);
});

