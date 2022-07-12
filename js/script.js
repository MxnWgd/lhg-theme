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
});
