function switchCalendar(element) {
  var data = {
    'action': 'calendarswitch',
    'post_type': 'POST',
    'date' : jQuery(element).attr('name'),
  }

  jQuery('#calendar').addClass('loading');

  jQuery.post(jQuery(element).attr('href'), data, function(response) {
    jQuery('#calendar').replaceWith(response);
    jQuery('#calendar').removeClass('loading');
  });

}

function expandEvent(element) {
  jQuery('.calendar-element-event.expanded').removeClass('expanded');
  jQuery(element).addClass('expanded');
  jQuery('.calendar-blur').addClass('visible');
}

jQuery(document).ready(function() {
  jQuery(document).click(function() {
    jQuery('.calendar-element-event.expanded').removeClass('expanded');
    jQuery('.calendar-blur').removeClass('visible');
  });
});
