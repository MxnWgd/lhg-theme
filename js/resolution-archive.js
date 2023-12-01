let date = new Date();
date.setTime(date.getTime() + (90 * 24 * 60 * 60 * 1000)); //expiring time to 90 days
const expires = "expires=" + date.toUTCString();

let nextPage = 1;
var scrollFromTop = document.documentElement.scrollTop;
let blockInfiniteScrollLoad = false;
let mode = 'filter';

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
    } else {
      requestPosts();
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
  nextPage = 1;
  document.cookie = 'resolutionfilter=filter;expires=' + expires;
  jQuery('#response').html('');
  blockInfiniteScrollLoad = false;

  requestPosts();
  return false;
});

// search form submit
jQuery('#resolutionsearch').submit(function(){
  nextPage = 1;
  document.cookie = 'resolutionfilter=search;expires=' + expires;
  jQuery('#response').html('');
  blockInfiniteScrollLoad = false;

  requestPosts();
  return false;
});

// load more posts
jQuery('#resolutionLoadPosts').submit(function(){
  requestPosts();
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
  mode = 'filter';
}

function switchToSearch() {
  document.cookie = 'resolutionfilter=search;expires=' + expires;
  jQuery('#filter').addClass('hide');
  jQuery('#resolutionsearch').removeClass('hide');
  mode = 'search';

  setTimeout(function() {
    jQuery('#resolutionSearchForm').focus();
  }, 400);
}

function requestPosts() {
  if (blockInfiniteScrollLoad) {
    return false;
  }
  blockFilters();

  var filter;
  switch (mode) {
    case 'filter':
    default:
      filter = jQuery('#filter');
      break;

    case 'search':
      filter = jQuery('#resolutionsearch');
      break;
  }

  jQuery.ajax({
    url:filter.attr('action'),
    data:filter.serialize() + "&page_number=" + nextPage,
    type:filter.attr('method'),

    beforeSend:function(xhr){
      console.log(filter.serialize() + "&page_number=" + nextPage);
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
        if (nextPage == 1) { //no posts found
          jQuery('#response').html('<h2>Keine Beschlüsse gefunden.</h2>');
        }
        blockInfiniteScrollLoad = true;
        return;
      }

      blockInfiniteScrollLoad = false;
      releaseFilters();
    }
  });
}

function blockFilters() {
  jQuery('#assemblySelect').prop('disabled', true);
  jQuery('#tagsSelect').prop('disabled', true);
  jQuery('#openSearchButton').prop('disabled', true);
  jQuery('#resolutionSearchForm').prop('disabled', true);
  jQuery('#closeSearchButton').prop('disabled', true);
  jQuery('#searchSubmitButton').prop('disabled', true);
}

function releaseFilters() {
  jQuery('#assemblySelect').prop('disabled', false);
  jQuery('#tagsSelect').prop('disabled', false);
  jQuery('#openSearchButton').prop('disabled', false);
  jQuery('#resolutionSearchForm').prop('disabled', false);
  jQuery('#closeSearchButton').prop('disabled', false);
  jQuery('#searchSubmitButton').prop('disabled', false);
}
