<?php get_header(); ?>

<div class="content-wrapper">
  <div class="page">
    <?php
      if (have_posts()) {
        while (have_posts()) {
          the_post();

          get_template_part('content');
        }
      } else {
        ?><h1 class="page-title">Keine Artikel gefunden.</h1><?php
      }
    ?>
  </div>
</div>

<?php get_footer(); ?>
