window.onload = (event) => {
    var slides = document.getElementsByClassName("nav-item");
    for (var i = 0; i < slides.length; i++) {
        // if (slides.item(i).)
        slides.item(i).style.backgroundColor = "yellow";
    }
}
// $(document).ready(function () {
//     $('.navar li').each(function () {
//         if (($(this).children().attr("href")).indexOf(window.location.pathname) != -1 || $(this).children().attr("href") === '#') {
//             console.log("exist");
//             console.log("path: ", "https://car-tch.herokuapp.com");
//             console.log("href: ", $(this).children().attr("href"));
//             console.log("sum: ", ("https://car-tch.herokuapp.com" + window.location.pathname));
//             $(this).addClass('active').siblings().removeClass('active');
//             // $(this).data('tousername')
//             return false;
//         } else {
//             console.log("not found");
//             console.log("path: ", "https://car-tch.herokuapp.com");
//             console.log("href: ", $(this).children().attr("href"));
//             console.log("sum: ", ("https://car-tch.herokuapp.com" + window.location.pathname));
//         }
//     })
// });

$('.our-team .box .member .overlay').hover(function () {
    $(this).fadeToggle(1500);
});

