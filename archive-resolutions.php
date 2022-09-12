<?php get_header(); ?>

<div class="content-wrapper">
  <div class="page">
    <h1 class="page-title-heading">Beschlusssammlung</h1>

    <div class="resolution-search">
      <h3>Filtern</h3>

      <form class="resolution-search-form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
        <select class="resolution-search-select" name="applicants" id="applicantsSelect" onchange="jQuery('#filter').submit();">
          <option value="all">Alle Antragsteller</option>

          <?php
            $all_applicants = get_categories(array(
              'taxonomy' => 'applicants',
              'orderby' => 'name'
            ));

            foreach ($all_applicants as $value) {
              ?><option value="<?php echo $value->cat_ID ?>"><?php echo $value->name ?></option><?php
            }
          ?>
        </select>

        <select class="resolution-search-select" name="assembly" id="assemblySelect" onchange="jQuery('#filter').submit();">
          <option value="all">Alle Versammlungen</option>

          <?php
            $all_assemblies = get_categories(array(
              'taxonomy' => 'assembly',
              'orderby' => 'term_id'
            ));

            foreach ($all_assemblies as $value) {
              ?><option value="<?php echo $value->cat_ID ?>"><?php echo $value->name ?></option><?php
            }
          ?>
        </select>

        <?php
          $all_tags = get_categories(array(
            'taxonomy' => 'resolutiontags',
            'orderby' => 'name'
          ));

          if (sizeof($all_tags) > 0) { ?>
            <select class="resolution-search-select" name="tags" id="tagsSelect" onchange="jQuery('#filter').submit();">
              <option value="all">Alle Schlagworte</option>

              <?php
                foreach ($all_tags as $value) {
                  ?><option value="<?php echo $value->cat_ID ?>">#<?php echo $value->name ?></option><?php
                }
              ?>
            </select>
        <?php } ?>

        <button class="resolution-search-button" type="button" name="Suche">Suche&nbsp;&nbsp;<i class="fas fa-search"></i></button>

        <input type="hidden" name="action" value="resolutionfilter">
      </form>
    </div>

    <div class="posts-list-wrapper" id="response">
      <?php
        if (have_posts()) {
          while (have_posts()) {
            the_post();

            get_template_part('inc/post_templates/content-resolutions');
          }
        } else {
          ?><h2>Keine Beiträge gefunden.</h2><?php
        }
      ?>
    </div>

    <div class="pagination-nav">
      <?php next_posts_link('< Ältere Beiträge'); ?>
      <div>&nbsp;</div>
      <?php previous_posts_link('Neuere Beiträge >') ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function() {
    if (jQuery('#applicantsSelect').val() != 'all'
    || jQuery('#assemblySelect').val() != 'all'
    || jQuery('#tagsSelect').val() != 'all') {
      jQuery('#response').html('<h3>Lädt...</h3>');
      jQuery('#filter').submit();
    }
  });

  jQuery('#filter').submit(function(){
    var filter = jQuery('#filter');
    jQuery.ajax({
      url:filter.attr('action'),
      data:filter.serialize(),
      type:filter.attr('method'),

      beforeSend:function(xhr){
        jQuery('#response').html('<h3>Lädt...</h3>');
      },

      success:function(data){
        jQuery('#response').html(data);
      }
    });
    return false;
  });
</script>

<?php get_footer(); ?>
