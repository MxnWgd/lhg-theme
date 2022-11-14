<?php get_header(); ?>

<div class="content-wrapper">
  <div class="page">
    <h1 class="page-title-heading">Veranstaltungen</h1>
    <?php
      if (get_theme_mod('event_page_layout', 'both') == 'both_switched'
          || get_theme_mod('event_page_layout', 'both') == 'only_calendar') {
        include_once 'inc/calendar/calendar.php';

        getCalendar();
      }
    ?>

    <?php if (get_theme_mod('event_page_layout', 'both') == 'both'
              || get_theme_mod('event_page_layout', 'both') == 'both_switched'
              || get_theme_mod('event_page_layout', 'both') == 'only_list') { ?>
      <h3>Demnächst</h3>

      <div class="posts-list-wrapper">
        <?php
          $args = array(
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_key' => 'date_start',
            'post_type' => array('events'),
            'posts_per_page' => get_theme_mod('event_page_amount_elements', -1),
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
            ?><h4>Derzeit sind keine Veranstaltungen geplant.</h4><?php
          }
        ?>
      </div>

    <?php } ?>

    <?php
      if (get_theme_mod('event_page_layout', 'both') == 'both') {
        ?><br><?php
        include_once 'inc/calendar/calendar.php';

        getCalendar();
      }
    ?>
  </div>
</div>

<?php get_footer(); ?>
