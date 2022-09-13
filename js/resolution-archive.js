let date = new Date();
date.setTime(date.getTime() + (90 * 24 * 60 * 60 * 1000)); //expiring time to 90 days
const expires = "expires=" + date.toUTCString();

jQuery(document).ready(function() {
  //get cookies
  if (cookies.resolutionfilter == 'search') {
    switchToSearch();
  }

  // restore view with old settings
  if (cookies.resolutionfilter != 'search'
  && (jQuery('#applicantsSelect').val() != 'all'
  || jQuery('#assemblySelect').val() != 'all'
  || jQuery('#tagsSelect').val() != 'all')) {
    jQuery('#filter').submit();
  } else if (cookies.resolutionfilter == 'search'
  && jQuery('#resolutionSearchForm').val() != '') {
    jQuery('#resolutionsearch').submit();
  }

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
  document.cookie = 'resolutionfilter=filter;expires' + expires;

  jQuery.ajax({
    url:filter.attr('action'),
    data:filter.serialize(),
    type:filter.attr('method'),

    beforeSend:function(xhr){
      jQuery('#response').html('<div class="resolution-search-loading"></div><div class="resolution-search-loading"></div>');
      jQuery('#paginationNav').hide();
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
  document.cookie = 'resolutionfilter=search;expires' + expires;

  jQuery.ajax({
    url:filter.attr('action'),
    data:filter.serialize(),
    type:filter.attr('method'),

    beforeSend:function(xhr){
      jQuery('#response').html('<div class="resolution-search-loading"></div><div class="resolution-search-loading"></div>');
      jQuery('#paginationNav').hide();
    },

    success:function(data){
      jQuery('#response').html(data);
    }
  });
  return false;
});

function switchToFilter() {
  document.cookie = 'resolutionfilter=filter;expires' + expires;
  jQuery('#resolutionsearch').addClass('hide');
  jQuery('#filter').removeClass('hide');
}

function switchToSearch() {
  document.cookie = 'resolutionfilter=search;expires' + expires;
  jQuery('#filter').addClass('hide');
  jQuery('#resolutionsearch').removeClass('hide');
}
