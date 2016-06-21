/**
 * @file
 * A jQuery closer function doc, used with the front page slideshow carousel.
 */

jQuery(function($) {
  $(".owl-carousel").owlCarousel({
      autoPlay: 3000,
      dots: true,
      items: 1,
      itemsDesktop: [1199, 3],
      itemsDesktopSmall: [979, 3]
  });


  /**
   * Manually handle adding and removing of classes,
   * as part of the slide reveal.
   */
  function update_slide_animation() {
    $('.info-content-wrapper').each(function () {
      $(this).removeClass('owl-info-show');
      $(this).addClass('owl-info-hidden');
    });
    $('.title-field, .desc-field').css('opacity', 0);
    setTimeout(function (data) {
      $(".owl-carousel").find('.info-content-wrapper').removeClass('owl-info-hidden').addClass('owl-info-show');
      $('.title-field, .desc-field').css('opacity', 1);
    }, 800);
  }

  update_slide_animation();
  
});