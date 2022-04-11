$(document).ready(function(){

    // Landing Page
    $('.buttonImageLandingPage').click(function(){
        var image = $(this).data('foto');
        console.log('Image : ', image);

        $('.landing-page-carousel-gambar').toggleClass('hide');

        setTimeout(function(){
            $('.landing-page-carousel-gambar').toggleClass('hide');
            $('#imageLandingPage').attr('src', '/dashboardAssets/'+image);
        }, 300);


    })

    $('.decoration-slider').slick({
        slidesToShow: 2.05,
        slidesToScroll: 1,
        arrows: true,
        infinite: true,
        prevArrow: $('.prev-decoration'),
        nextArrow: $('.next-decoration'),
        responsive: [
            {
                breakpoint: 600,
                settings: {
                    arrows: false,
                    slidesToShow: 1.05,
                    slidesToScroll: 1,
                    infinite: true,
                }
            }

        ]
    })

    $('.landing-page-carousel-mobile').slick({
        slidesToShow: 1,
        infinite: true,
        dots: true,
    })

    function goFlowerShop(){
        location.href = '/flower-shop';

    }

})

