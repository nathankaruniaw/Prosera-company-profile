$(document).ready(function () {
    var owl = $('#services-carousel');
    owl.owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: false,
        items: 2.5,
        smartSpeed: 1200,
        responsive: {
            300: {
                items: 1.5,
                margin: 30
            },
            400: {
                items: 1.5,
                margin: 30
            },
            768: {
                items: 2.5,
                margin: 30
            },
            1024: {
                items: 2.5,
                margin: 30
            },
            1440: {
                items: 2.5,
                margin: 30
            }
        }
    });

    // Custom Button
    $('.custom--next-btn').click(function () {
        owl.trigger('next.owl.carousel');
    });
    $('.custom--prev-btn').click(function () {
        owl.trigger('prev.owl.carousel');
    });

    var owl_news = $('#news-carousel');
    owl_news.owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: false,
        items: 1,
        autoplay: true,
        smartSpeed: 1000,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
    });

    // Custom Button
    $('.custom--next-btn-2').click(function () {
        owl_news.trigger('next.owl.carousel');
    });
    $('.custom--prev-btn-2').click(function () {
        owl_news.trigger('prev.owl.carousel');
    });

    // owl_news.on('changed.owl.carousel', function (event) {
    //     $('.owl-item').removeClass('fadeOut');
    // });

    var owl_residential = $('#projects-residential');
    owl_residential.owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: false,
        items: 3,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            300: {
                items: 1.5,
                margin: 30
            },
            400: {
                items: 1.5,
                margin: 30
            },
            768: {
                items: 3,
                margin: 30
            },
            1024: {
                items: 3,
                margin: 30
            },
            1440: {
                items: 3,
                margin: 30
            }
        }
    });

    // Custom Button
    $('.custom--next-btn-3').click(function () {
        owl_residential.trigger('next.owl.carousel');
    });
    $('.custom--prev-btn-3').click(function () {
        owl_residential.trigger('prev.owl.carousel');
    });

    var owl_commercial = $('#projects-commercial');
    owl_commercial.owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: false,
        items: 3,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            300: {
                items: 1.5,
                margin: 30
            },
            400: {
                items: 1.5,
                margin: 30
            },
            768: {
                items: 3,
                margin: 30
            },
            1024: {
                items: 3,
                margin: 30
            },
            1440: {
                items: 3,
                margin: 30
            }
        }
    });

    // Custom Button
    $('.custom--next-btn-4').click(function () {
        owl_commercial.trigger('next.owl.carousel');
    });
    $('.custom--prev-btn-4').click(function () {
        owl_commercial.trigger('prev.owl.carousel');
    });

    var owl_industrial = $('#projects-industrial');
    owl_industrial.owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: false,
        items: 3,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            300: {
                items: 1.5,
                margin: 30
            },
            400: {
                items: 1.5,
                margin: 30
            },
            768: {
                items: 3,
                margin: 30
            },
            1024: {
                items: 3,
                margin: 30
            },
            1440: {
                items: 3,
                margin: 30
            }
        }
    });

    // Custom Button
    $('.custom--next-btn-5').click(function () {
        owl_industrial.trigger('next.owl.carousel');
    });
    $('.custom--prev-btn-5').click(function () {
        owl_industrial.trigger('prev.owl.carousel');
    });

});

// Responsive Menu
const toggleMenu = document.querySelector("#toggler-js-menu");
const toggleClose = document.querySelector(".fa-times");

let time1 = gsap.timeline({ paused: true });
time1.to(".responsive__menu", { opacity: 1, duration: 1, top: 0, ease: Power2.easeInOut });
time1.to(
    ".menu--item",
    {
        opacity: 1,
        marginBottom: 0,
        duration: 1,
        ease: Power2.easeInOut,
        stagger: 0.3,
    },
    ">-0.5"
);

toggleMenu.addEventListener("click", () => {
    time1.play().timeScale(1);
});

toggleClose.addEventListener("click", () => {
    time1.timeScale(2.5);
    time1.reverse();
});