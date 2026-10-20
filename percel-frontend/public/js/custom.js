$('.slimmenu').slimmenu({
    resizeWidth: '991',
    collapserTitle: '',
    animSpeed: 'medium',
    indentChildren: true,
    childrenIndenter: '&raquo;'
});


$(window).scroll(function() {
    var wScroll = $(this).scrollTop();

    if (wScroll > $('.header').outerHeight(true)) {
        $(".header").addClass("fixed_header");
    } else {
        $(".header").removeClass("fixed_header");
    }
});

// Helper function for add element box list in WOW
WOW.prototype.addBox = function(element) {
    this.boxes.push(element);
};

// Init WOW.js and get instance
var wow = new WOW();
wow.init();

// Attach scrollSpy to .wow elements for detect view exit events,
// then reset elements and add again for animation
$('.wow').on('scrollSpy:exit', function() {
    $(this).css({
        'visibility': 'hidden',
        'animation-name': 'none'
    }).removeClass('animated');
    wow.addBox(this);
}).scrollSpy();

$(function() {
    $('.lazy').Lazy();
});

// Site Menu JS Start
$('.collapse-button').click(function() {
    $("body").toggleClass('sideMenu');
});
$('.menuOvrly').click(function() {
    $("body").removeClass('sideMenu');
});
$('.closeMenu').click(function() {
    $("body").removeClass('sideMenu');
});
// Site Menu JS End

$('.bannerSec .owl-carousel').owlCarousel({
    items: 1,
    autoplay: true,
    autoplayTimeout: 4000000,
    lazyLoad: true,
    loop: true,
    margin: 0
})


$(document).ready(function() {
    // Swiper: Slider
    new Swiper('.banner_slider .swiper-container', {
        loop: true,
        slidesPerView: 1,
        pagination: {
            el: ".swiper-pagination",
        }
    });
});

$(document).ready(function() {
    var owl = $('.storySlder .owl-carousel');
    owl.owlCarousel({
        autoplay: true,
        lazyLoad: true,
        autoplayHoverPause: true,
        autoplayTimeout: 400000,
        nav: false,
        loop: true,
        responsive: {
            0: {
                items: 2,
                stagePadding: 0
            },
            400: {
                items: 2,
                stagePadding: 0
            },
            480: {
                items: 2,
                stagePadding: 60
            },
            768: {
                items: 3,
                stagePadding: 90
            },
            992: {
                items: 3,
                stagePadding: 100
            },
            1200: {
                items: 4,
                stagePadding: 120
            },
            1600: {
                items: 4,
                stagePadding: 150
            }
        }
    })
});