$('.offer').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            nav: true
        },
        600: {
            items: 1,
            nav: false
        },
        1169: {
            items: 3,
            nav: true,
        }
    }
});
$('.customor').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            nav: true
        },
        600: {
            items: 1,
            nav: false
        },
        768: {
            items: 2,
            nav: false
        },
        1023: {
            items: 2,
            nav: false
        },
        1169: {
            items: 4,
            nav: true,
        }
    }
});
$('#responsiveTabsDemo').responsiveTabs({
    startCollapsed: 'accordion'
});

$(".menu-toggle").click(function() {
    $(this).toggleClass("on");
    $(".navbar").slideToggle();
});
$(window).scroll(function() {
    if ($(this).scrollTop() > 1) {
        $('header').addClass("sticky");
    } else {
        $('header').removeClass("sticky");
    }
});