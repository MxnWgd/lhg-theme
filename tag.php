<?php get_header(); ?>

<div class="content-wrapper">
  <div class="page">
    <h1 class="page-title-heading">#<?php single_tag_title(); ?></h1>

    <div class="page-content">
      <p class="page-description"><?php echo tag_description(); ?></p>
    </div>

    <div class="posts-list-wrapper">
      <?php
      if (have_posts()) {
        while (have_posts()) {
          the_post();

          get_template_part('content-compact-circle');
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

<?php get_footer(); ?>
