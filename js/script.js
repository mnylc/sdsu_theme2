/**
 * @file
 * A Drupal behaviour, used with the front page slideshow carousel.
 */

(function ($, Drupal, window, document) {
  'use strict';

  var thumb_carousel;
  var large_carousel;

  Drupal.behaviors.owl_slide = {
    attach: function (context, settings) {

      /**
       * Create instances of the Carousel callbacks to override.
       */
      var callbacks = {
        afterInit: afterOWLinit,
        afterMove: afterOWLMove
      };

      /**
       * Our own 'afterInit' function in the Carousel.
       */
      function afterOWLinit() {
        //update_slide_animation(this);
        
//        $('.owl-controls .owl-page').append('<div class="item-link"></div>');
//        var pafinatorsLink = $('.owl-controls .item-link');
        var thumbs_wrapper = $(".view-thumbs");
        large_carousel = this.owl;
        $.each(this.owl.userItems, function (i) {
          $(this).find(".info-content-wrapper").addClass("item-" + i);
          var div = $("<div>", {class: "footer-thumb thumb-" + i});
          div.attr('data-index', i);
          var pid = $(this).find(".front-page-slideshow-image-pid").data("pid");
          var img = $('<img>');
          img.attr('src', "/islandora/object/" + pid + "/datastream/TN/view");
          img.appendTo(div);
          div.appendTo(thumbs_wrapper);
        });
     
        // Thats right, create a second Owl Carosuel for our thumbnail navigation.
        thumb_carousel = $(".view-thumbs");
        thumb_carousel.owlCarousel({
          items: 10,
          itemsDesktop : [1199,5],
          itemsDesktopSmall : [980,3],
          itemsTablet: [768,2],
          itemsTabletSmall: [768,2],
          itemsMobile : [479,1],
          pagination : true,
          navigation: true,
          navigationText: ["<", ">"],
          afterInit: afterOWLTWOinit
        });
       // updateOWLtext(this.owl);
      }



      /**
       * After our second Carousel initilizes, set it up as a control
       * mechinism.
       */
      function afterOWLTWOinit() {
        $.each(this.owl.userItems, function (i) {
          $(this).click(function(e){
            var n = $(this).data('index');
            console.log(n + " <- this is 'n'");
          //  alert);
            $('.owl-wrapper').trigger('owl.jumpTo', [n, 400, true]);
          });
        });
        $('.view-thumbs .owl-prev, .view-thumbs .owl-next').click(function(e){
          if ($(e.currentTarget).hasClass('owl-prev')) {
            $('.owl-wrapper').trigger('owl.prev');
          } else {
            $('.owl-wrapper').trigger('owl.next');
          }
        });
      }



      /**
       * Our own 'afterMove' function in the Carousel.
       */
      function afterOWLMove() {
        update_slide_animation(this);

        // Bilateral update between carousel's, keep them in sync.
        thumb_carousel.trigger('owl.jumpTo', [this.owl.currentItem, 400, true]);
      }


      /**
       * Owl Carousel view fields text placement helper.
       */
      function updateOWLtext(owl) {
        reset_text_selected(owl);
        setTimeout(function(current_item){
          $('.info-content-wrapper.item-' + current_item).fadeIn(200);
        }, 400, owl.currentItem);
      }

      function reset_text_selected(owl) {
        $('.info-content-wrapper').hide();
        $.each($('.footer-thumb'), function(i){
          $(this).removeClass('owl-active');
        });
        $('.footer-thumb.thumb-' + owl.currentItem).toggleClass('owl-active');
      }



      /**
       * @param {string} context
       *   Current context of the slideshow.
       */
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

      /**
       * Override the callback functions specified in the 'callbacks' variable.
       */
      for (var carousel in settings.owlcarousel) {
        if (carousel !== null) {
        	console.log("extend")
          // Extend the functionality of the callbacks per json obj.
          //$.extend(true, settings.owlcarousel[carousel].settings, callbacks);
        }
      }
    }
  };
})(jQuery, Drupal, this, this.document);
