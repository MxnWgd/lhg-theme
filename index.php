<?php get_header(); ?>

<div class="content-wrapper">
    <?php
      if (have_posts()) {
        while (have_posts()) {
          the_post();

          get_template_part('content');
        }
      } else {
        ?><p>Keine Artikel gefunden.</p><?php
      }
    ?>
</div>

<?php get_footer(); ?>
