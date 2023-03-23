<?php get_header(); ?>

<div class="content-wrapper">
  <div class="page">
    <h1 class="page-title-heading">
      <?php the_title(); ?>
      <?php echo is_user_logged_in() ? '&nbsp;<a class="edit-post-link" title="Seite bearbeiten" href="' . get_edit_post_link(get_the_ID()) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
    </h1>

    <div class="page-content">
      <?php the_content(); ?>
    </div>
  </div>

  <?php if (get_post_meta(get_the_ID(), 'page_additional_area') != null && get_post_meta(get_the_ID(), 'page_additional_area')[0] != 0) {
    $additional_content_page = get_post(get_post_meta(get_the_ID(), 'page_additional_area')[0]); ?>
    <div class="page-additional-area">
      <h1 class="page-additional-area-title">
        <?php echo $additional_content_page->post_title; ?>
        <?php echo is_user_logged_in() ? '&nbsp;<a class="edit-post-link" title="Seite bearbeiten" href="' . get_edit_post_link($additional_content_page->ID) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
      </h1>
      <?php echo do_shortcode($additional_content_page->post_content); ?>
    </div>
  <?php } ?>
</div>

<?php get_footer(); ?>
