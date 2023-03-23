jQuery(document).ready(function() {
  jQuery('#addPostTileImageBtn').click(function() {
    var custom_uploader = (wp.media.frames.file_frame = wp.media({ multiple: false, }));

    custom_uploader.on("select", function () {
      var attachment = custom_uploader.state().get("selection").first().toJSON();

      jQuery("#postTileImageObj").attr('src', attachment.url);
      jQuery("#postTileImageObj").show();
      jQuery("#removePostTileImageBtn").show();
      jQuery('#postTileImageInput').attr('value', attachment.id);
    });

    custom_uploader.open();
  });

  jQuery('#removePostTileImageBtn').click(function() {
    jQuery("#postTileImageObj").attr('src', '');
    jQuery("#postTileImageObj").hide();
    jQuery('#postTileImageInput').attr('value', '');
    jQuery("#removePostTileImageBtn").hide();
  });
});
