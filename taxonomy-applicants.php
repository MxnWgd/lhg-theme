<?php get_header(); ?>

<div class="content-wrapper">
  <div class="page">
    <h1 class="page-title-heading"><?php echo get_queried_object()->name; ?></h1>

    <div class="posts-list-wrapper">
      <?php

      $args = array(
        'post_type' => 'resolutions',
        'nopaging' => true,
        'tax_query' => array(
            array(
              'taxonomy' => 'applicants',
              'field'    => 'slug',
              'terms'    => get_queried_object()->name,
            ),
        ),
      );
      $the_query = new WP_Query( $args );

      if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
          $the_query->the_post();

          get_template_part('inc/post_templates/content-resolutions');
        }
      } else {
        ?><h2>Keine Beschlüsse gefunden.</h2><?php
      }
      ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
