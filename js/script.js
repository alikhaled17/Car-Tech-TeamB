// window.onload = (event) => {
//     var slides = document.getElementsByClassName("nav-item");
//     for (var i = 0; i < slides.length; i++) {
//         if($("#myDiv").length) {

//         }
//         var x = slides.item(i).firstElementChild.getAttribute('href');
//         console.log(x);

//     }
// }

$(document).ready(function () {
    $('.navar li').each(function () {
        if ($(this).children().length) {
            console.log("exist");
        } else {
            console.log("else");
            return;
        }
        // if (($(this).children().attr("href")).indexOf(window.location.pathname) != -1 || $(this).children().attr("href") === '#') {
        //     console.log("exist");
        //     console.log("path: ", "https://car-tch.herokuapp.com");
        //     console.log("href: ", $(this).children().attr("href"));
        //     console.log("sum: ", ("https://car-tch.herokuapp.com" + window.location.pathname));
        //     $(this).addClass('active').siblings().removeClass('active');
        //     // $(this).data('tousername')
        //     return false;
        // } else {
        //     console.log("not found");
        //     console.log("path: ", "https://car-tch.herokuapp.com");
        //     console.log("href: ", $(this).children().attr("href"));
        //     console.log("sum: ", ("https://car-tch.herokuapp.com" + window.location.pathname));
        // }
    })
});

$('.our-team .box .member .overlay').hover(function () {
    $(this).fadeToggle(1500);
});

