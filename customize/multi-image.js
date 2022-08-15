jQuery(document).ready( function( ) {
  //load selected images
  var begin_attachment_string = jQuery("#imagesInput").val();
  var begin_attachment_array = [];

  if (begin_attachment_string != null) {
    begin_attachment_array = begin_attachment_string.split(",");
  }

  var promises = [];
  for (var i = 0; i < begin_attachment_array.length; i++) {
    var id = begin_attachment_array[i];
    if (id != "") {
      promises[i] = wp.media.attachment(id).fetch();
    }
  }

  Promise.all(promises).then(function() {
    for (var i = 0; i < begin_attachment_array.length; i++) {
      var id = begin_attachment_array[i];
      if (begin_attachment_array[i] != "") {
        jQuery(".images").append("<li class='image-list'><img src='" + wp.media.attachment(id).get("url") + "' data-id='" + id + "'></li>");
      }
    }
  });


  //add image button
  jQuery(".button-secondary.upload").click(function () {
    var custom_uploader = (wp.media.frames.file_frame = wp.media({ multiple: true, }));

    custom_uploader.on("select", function () {
      var selection = custom_uploader.state().get("selection");
      var attachments = [];

      selection.map(function (attachment) {
        attachment = attachment.toJSON();
        jQuery(".images").append("<li class='image-list'><img src='" + attachment.url + "' data-id='" + attachment.id + "'></li>");
        attachments.push(attachment.id);
      });

      var previous = jQuery("#imagesInput").val() ? "," + jQuery("#imagesInput").val() : "";
      var attachment_string = attachments.join() + previous;

      jQuery("#imagesInput").val(attachment_string).trigger("change");
    });

    custom_uploader.open();
  });


  //remove when image clicked
  jQuery(".images").click(function (e) {
    var img_id = jQuery(e.target).find("img").attr("data-id");
    jQuery(e.target).closest("li").remove();

    var attachment_string = jQuery("#imagesInput").val();
    attachments = attachment_string.split(',');
    attachments.splice(attachments.indexOf(img_id), 1);

    jQuery("#imagesInput").val(attachments.join(',')).trigger("change");
  });
});
