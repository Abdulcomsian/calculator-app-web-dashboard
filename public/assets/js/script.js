$('.menu .menu-link').on('click', 'a', function() {
    $('.menu .menu-link.active').removeClass('active');
    $(this).addClass('active');
});

