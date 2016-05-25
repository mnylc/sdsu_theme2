/**
 * @file
 * A Drupal behaviour, used with the front page slideshow carousel.
 */

(function ($, Drupal, window, document) {
  'use strict';
  Drupal.behaviors.my_custom_behavior = {
    attach: function (context, settings) {

      // Create instances of the Carousel callbacks to override.
      var callbacks = {
        afterInit: afterOWLinit,
        afterMove: afterOWLMove
      };

      /**
       * Our own 'afterInit' function in the Carousel.
       */
      function afterOWLinit() {
    	 console.log("after owl init");
        update_slide_animation(this);
      }

      /**
       * Our own 'afterMove' function in the Carousel.
       */
      function afterOWLMove() {
    	  console.log("after owl move");
        update_slide_animation(this);
      }

      function update_slide_animation(context) {
        $('.info-content-wrapper').each(function () {
          $(this).removeClass('owl-info-show');
          $(this).addClass('owl-info-hidden');
        });
        $('.title-field, .desc-field').css('opacity', 0);
        setTimeout(function (data) {
          $(data[1].owl.userItems[data[0]]).find('.info-content-wrapper').removeClass('owl-info-hidden').addClass('owl-info-show');
          $('.title-field, .desc-field').css('opacity', 1);
        }, 800, [context.currentItem, context]);
      }

      // Override the callback functions specified in the
      // 'callbacks' variable.
      for (var carousel in settings.owlcarousel) {
        console.log(carousel);
        if (carousel === 'owl-carousel-block1') {
          console.log(carousel);
          // Extend the functionality of the callbacks per json obj.
          $.extend(true, settings.owlcarousel[carousel].settings, callbacks);
        }
      }
    }
  };
})(jQuery, Drupal, this, this.document);
