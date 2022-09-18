<?php get_header(); ?>

<div class="content-wrapper">
  <div class="page">
    <h1 class="page-title-heading">Veranstaltungen</h1>

    <h3>Demnächst</h3>

    <div class="posts-list-wrapper">
      <?php
        $args = array(
          'orderby' => 'meta_value',
          'order' => 'ASC',
          'meta_key' => 'date_start',
          'post_type' => array('events'),
          'posts_per_page' => -1,
          'meta_query' => array(
            array(
              'key' => 'date_start',
              'value' => date('Y-m-d'),
              'compare' => '>=',
            )
          ),
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
          while ($query->have_posts()) {
            $query->the_post();

            get_template_part('inc/post_templates/content-events');
          }
        } else {
          ?><h2>Keine Veranstaltungen gefunden.</h2><?php
        }
      ?>
    </div>

    <h3>Kalender</h3>

    <p>to be implemented</p>
  </div>
</div>

<?php get_footer(); ?>
