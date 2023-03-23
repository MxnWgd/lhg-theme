let date = new Date();
date.setTime(date.getTime() + (90 * 24 * 60 * 60 * 1000)); //expiring time to 90 days
const expires = "expires=" + date.toUTCString();

let nextPage = 2;
var scrollFromTop = document.documentElement.scrollTop;
let blockInfiniteScrollLoad = false;

jQuery(document).ready(function() {
  //get cookies
  if (cookies.resolutionfilter == 'search') {
    switchToSearch();
  }

  // restore view with old settings
  setTimeout(function() {
    if (cookies.resolutionfilter != 'search'
    && (jQuery('#applicantsSelect').val() != 'all'
    || jQuery('#assemblySelect').val() != 'all'
    || jQuery('#tagsSelect').val() != 'all')) {
      jQuery('#filter').submit();
    } else if (cookies.resolutionfilter == 'search'
      && jQuery('#resolutionSearchForm').val() != '') {
      jQuery('#resolutionsearch').submit();
    }
  }, 100);

  jQuery('#openSearchButton').click(function() {
    switchToSearch();
  });
  jQuery('#closeSearchButton').click(function() {
    switchToFilter();
  });
});


// filter form submit
jQuery('#filter').submit(function(){
  var filter = jQuery('#filter');
  document.cookie = 'resolutionfilter=filter;expires=' + expires;

  jQuery.ajax({
    url:filter.attr('action'),
    data:filter.serialize(),
    type:filter.attr('method'),

    beforeSend:function(xhr){
      jQuery('#response').html('<div class="resolution-search-loading"></div><div class="resolution-search-loading"></div>');
      jQuery('#resolutionLoadPosts').hide();
    },

    success:function(data){
      jQuery('#response').html(data);
    }
  });
  return false;
});

// search form submit
jQuery('#resolutionsearch').submit(function(){
  var filter = jQuery('#resolutionsearch');
  document.cookie = 'resolutionfilter=search;expires=' + expires;

  jQuery.ajax({
    url:filter.attr('action'),
    data:filter.serialize(),
    type:filter.attr('method'),

    beforeSend:function(xhr){
      jQuery('#response').html('<div class="resolution-search-loading"></div><div class="resolution-search-loading"></div>');
      jQuery('#resolutionLoadPosts').hide();
    },

    success:function(data){
      jQuery('#response').html(data);
    }
  });
  return false;
});

// load more posts
jQuery('#resolutionLoadPosts').submit(function(){
  var filter = jQuery('#resolutionLoadPosts');

  jQuery.ajax({
    url:filter.attr('action'),
    data: "action=resolutions&page_number=" + nextPage,
    type:filter.attr('method'),

    beforeSend:function(xhr){
      jQuery('#response').append('<div class="resolution-search-loading"></div><div class="resolution-search-loading"></div>');
      jQuery('#resolutionLoadPosts').hide();
      blockInfiniteScrollLoad = true;
    },

    success:function(data){
      jQuery('.resolution-search-loading').remove();
      jQuery('#resolutionLoadPosts').show();

      if (data != 'endOfPosts') {
        jQuery('#response').append(data);
        nextPage++;
      } else {
        jQuery('#resolutionLoadPosts').remove();
      }

      blockInfiniteScrollLoad = false;
    }
  });
  return false;
});

jQuery(document).scroll(function(){
  scrollFromTop = document.documentElement.scrollTop;
  var scrolldistancebottom = scrollFromTop + jQuery(window).height();

  if (jQuery('#resolutionLoadPosts').offset()?.top < scrolldistancebottom + 30
      && !blockInfiniteScrollLoad) {
    jQuery('#resolutionLoadPosts').submit();
  }
});

function switchToFilter() {
  document.cookie = 'resolutionfilter=filter;expires=' + expires;
  jQuery('#resolutionsearch').addClass('hide');
  jQuery('#filter').removeClass('hide');
}

function switchToSearch() {
  document.cookie = 'resolutionfilter=search;expires=' + expires;
  jQuery('#filter').addClass('hide');
  jQuery('#resolutionsearch').removeClass('hide');

  setTimeout(function() {
    jQuery('#resolutionSearchForm').focus();
  }, 400);
}
