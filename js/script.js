document.addEventListener('DOMContentLoaded', function() {
  var scrollFromTop = document.documentElement.scrollTop;

  //init
  if (scrollFromTop >= 100) {
    jQuery('#header').addClass('collapsed');
  }

  jQuery(document).scroll(function(){
    scrollFromTop = document.documentElement.scrollTop;

    if (scrollFromTop >= 100) {
      jQuery('#header').addClass('collapsed');
    }

    if (scrollFromTop < 90) {
      jQuery('#header').removeClass('collapsed');
    }
  });



  //navigation
  jQuery('#headerNavigationButton').click(function() {
    jQuery('#headerNavigationButton').toggleClass('open');

    jQuery('#primaryNav').toggleClass('open');
    jQuery('#header').toggleClass('collapsed-force');
  });



  //checkboxes & radio
  jQuery('label input[type="checkbox"]').after('<span class="checkbox">&nbsp;</span>');
  jQuery('label input[type="checkbox"]').addClass('hide');
  jQuery('label input[type="radio"]').after('<span class="radio">&nbsp;</span>');
  jQuery('label input[type="radio"]').addClass('hide');



  //cookie banner
  jQuery('#cookieBannerCloseButton').click(function() {
    let date = new Date();
    date.setTime(date.getTime() + (90 * 24 * 60 * 60 * 1000)); //expiring time to 90 days
    const expires = "expires=" + date.toUTCString();

    document.cookie = 'cookies=accepted;expires' + expires;
    jQuery('.cookie-banner-blur').addClass('hidden');
    jQuery('.cookie-banner').addClass('hidden');
    jQuery('html').removeClass('scroll-blocked');
  });



  //flyout
  jQuery(document).click(function() {
    jQuery('#flyoutButton').blur();
  });

  jQuery('#flyoutButton').click(function() {
    event.stopPropagation();
  });



  //image zoom
  jQuery('.wp-block-image').click(function() {
    event.stopPropagation();

    var srcset = jQuery(this).children('img').attr('srcset').split(',');
    var lastImg = srcset[srcset.length - 1].split(' ')[1];
    var subtitle = jQuery(this).children('figcaption').text();

    if (lastImg != null && lastImg != '') {
      jQuery('#imageViewImg').attr('src', lastImg);
      jQuery('.image-view-subtitle').text(subtitle);
      jQuery('.image-view').addClass('visible');
    }
  });

  jQuery(document).click(function() {
    jQuery('.image-view').removeClass('visible');
    jQuery('#imageViewImg').attr('src', '');
    jQuery('.image-view-subtitle').text('');
  });



  //header slider
  var slide = 0;
  var slideInterval = 8000;
  var sliderInterval = setInterval(nextSlide, slideInterval);

  function showSlide(n) {
    jQuery('.header-image-slider-control-dot.selected').removeClass('selected');
    jQuery(jQuery('.header-image-slider-control-dot')[n]).addClass('selected');

    jQuery('.header-image-slide.visible').removeClass('visible');
    jQuery(jQuery('.header-image-slider.multiple .header-image-slide')[n]).addClass('visible');
    slide = n;
  }

  function nextSlide() {
    slide = (slide + 1) % jQuery('.header-image-slider.multiple .header-image-slide').length;
    showSlide(slide);
  }

  jQuery('.header-image-slider-control-dot').click(function(event) {
    event.stopPropagation();
    clearInterval(sliderInterval);
    showSlide(jQuery(this).attr('id'));
    sliderInterval = setInterval(nextSlide, slideInterval);
  });

  showSlide(slide);
});


jQuery(window).on("load", function (e) {
  // Scroll fade-in
  var boxes = [];
  jQuery.each(jQuery('.content-wrapper').children(), function(key, value) {
    boxes.push(jQuery(value));
  });
  boxes.push(jQuery('footer'));
  if (jQuery(window).width() <= 750 && jQuery('.flyout').length > 0) {
    boxes.push(jQuery('.flyout'));
  }

  var initoffset = jQuery(window).height() + jQuery(document).scrollTop();

  setTimeout(() => {
    for (var i = 0; i < boxes.length; i++) {
      var current = boxes[i];

      if (jQuery(current).offset().top > initoffset) {
        jQuery(current).addClass('invisible');
      }
    }
  }, 250); // delay to ensure DOM load

  jQuery(window).scroll(function(){
    var scrolldistance = jQuery(document).scrollTop();
    var scrolldistancebottom = scrolldistance + jQuery(window).height();

    // make boxes visible again
    for (var i = 0; i < boxes.length; i++) {
      var current = boxes[i];

      if (jQuery(current).offset().top < scrolldistancebottom) {
        jQuery(current).removeClass('invisible');
        boxes.splice(i, 1);
      }
    }
  });

  jQuery(window).resize(function(){
    var scrolldistance = jQuery(document).scrollTop();
    var scrolldistancebottom = scrolldistance + jQuery(window).height();

    // make boxes visible again
    for (var i = 0; i < boxes.length; i++) {
      var current = boxes[i];

      if (jQuery(current).offset().top < scrolldistancebottom) {
        jQuery(current).removeClass('invisible');
        boxes.splice(i, 1);
      }
    }
  });

})
