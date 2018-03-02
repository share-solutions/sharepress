$(function () {
    // caches a jQuery object containing the header element
  const header = $('header')
  const originalHeight = header.height()
  $(window)
        .scroll(function () {
          var scroll = $(window).scrollTop()

          if (scroll >= originalHeight) {
            header.removeClass('header--initial').addClass('header--scrolled')
          } else {
            header.removeClass('header--scrolled').addClass('header--initial')
            $('.navbar-collapse').removeClass('navbar-collapse--flex')
            $('.search').removeClass('hidden')
            $('.navbar-toggler').removeClass('change')
            header.removeClass('sidenav-opened')
            $('body').removeClass('lock')
          }
        })
        .trigger('scroll')

    // Opens Menu
  $('.navbar-toggler').click(function () {
    $('.navbar-collapse').toggleClass('navbar-collapse--flex')
    $('.search').toggleClass('hidden')
    $('.navbar-toggler').toggleClass('change')
    header.toggleClass('sidenav-opened')
    $('body').toggleClass('lock')
  })

  $('.fa-search, .fa-close').click(function () {
    $('.search').toggleClass('active')
    if ($('.search').hasClass('active')) {
      $('.search .search__form input').focus()
    }
  })
}(jQuery))
