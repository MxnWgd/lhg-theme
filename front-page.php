<?php get_header(); ?>

<div class="content-wrapper">
  <?php $cat_id = get_theme_mod('front_page_news_category') != null ? get_theme_mod('front_page_news_category') : get_categories(array( 'fields' => 'ids'))[0]; ?>
  <?php if ($cat_id != null) { ?>
    <div class="front-page-news-wrapper">
      <h1 class="front-page-title"><?php echo get_theme_mod('front_page_news_title') != null ? get_theme_mod('front_page_news_title') : 'Neuigkeiten'; ?></h1>

      <div class="front-page-list">
        <?php
        $total_number_posts = 8;

        $sticky_posts = get_posts(array(
          'post__in' => get_option('sticky_posts'),
          'ignore_sticky_posts' => 1,
          'posts_per_page' => $total_number_posts,
          'category' => get_cat_ID($cat_id),
          'no_found_rows'  => true
        ));

        $non_sticky_posts = array();
        if ($total_number_posts - sizeof($sticky_posts) > 0) {
          $non_sticky_posts = get_posts(array(
            'post__not_in' => get_option('sticky_posts'),
            'ignore_sticky_posts' => 1,
            'posts_per_page' => $total_number_posts - sizeof($sticky_posts),
            'category' => get_cat_ID($cat_id),
            'no_found_rows'  => true,
          ));
        }

        $iterate_list = array_merge($sticky_posts, $non_sticky_posts);

        foreach ($iterate_list as $key => $value) {
        	?>
          <a class="post-tile-link" href="<?php echo get_post_permalink($value->ID); ?>" rel="bookmark" title="<?php echo $value->post_title ?>">
            <article class="post-tile" <?php if (has_post_thumbnail($value->ID)) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url($value->ID, 'large') ?>)" <?php } ?>>
              <div class="post-tile-info">
                <span class="post-tile-date"><?php if (is_sticky($value->ID)) { ?><span class="post-tile-sticky"><i class="fas fa-thumbtack"></i></span><?php } ?><?php echo date_format(date_create($value->post_date), 'd.m.Y') ?></span>
                <h1 class="post-tile-title"><?php echo $value->post_title ?></h1>
              </div>
            </article>
          </a>
        <?php } ?>
      </div>

      <a href="<?php echo get_category_link(get_cat_ID($cat_id)) ?>" title="Alle Neuigkeiten" class="front-page-large-link">Alle Neuigkeiten &gt;</a>
    </div>
  <?php } ?>


  <?php if (get_theme_mod('front_page_additional_area_page') != 0) {
    $content_area_page = get_post(get_theme_mod('front_page_additional_area_page')); ?>
    <div class="front-page-content-area" style="background-image: url(<?php echo has_post_thumbnail($content_area_page->ID) ? get_the_post_thumbnail_url($content_area_page->ID, 'original') : (get_theme_mod('header_slider_mode') === '2' ? wp_get_attachment_image_src(explode(',', get_theme_mod('header_slider_carousel'))[0], 'full')[0] : wp_get_attachment_image_src(get_theme_mod('header_slider_image'), 'full')[0]); ?>);">
      <div class="front-page-content-area-box <?php echo get_theme_mod('front_page_additional_area_page_lr') !== '' ? get_theme_mod('front_page_additional_area_page_lr') : 'left'; ?>">
        <h1 class="front-page-content-area-title"><?php echo $content_area_page->post_title; ?></h1>
        <?php echo $content_area_page->post_content; ?>
      </div>
    </div>
  <?php } ?>


  <?php if (get_theme_mod('front_page_events_title') != null) { ?>
    <div class="front-page-event-wrapper">
      <h1 class="front-page-title"><?php echo get_theme_mod('front_page_events_title') != null ? get_theme_mod('front_page_events_title') : 'Termine'; ?></h1>

      <div class="front-page-event-list">
        <?php
          $args = array(
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_key' => 'date_start',
            'post_type' => array('events'),
            'posts_per_page' => 3,
            'meta_query' => array(
              array(
                'key' => 'date_start',
                'value' => date('Y-m-d'),
                'compare' => '>=',
              )
            ),
          );

          $query = new WP_Query($args);

          $posts_found = false;

          if ($query->have_posts()) {
            $posts_found = true;

            while ($query->have_posts()) {
              $query->the_post();

              get_template_part('inc/post_templates/content-events');
            }
          } else {
            ?><h3>Derzeit sind keine Veranstaltungen geplant.</h3><?php
          }
        ?>
      </div>

      <?php if ($posts_found) { ?>
        <a href="<?php echo get_post_type_archive_link('events') ?>" title="Alle <?php echo get_theme_mod('front_page_events_title') != null ? get_theme_mod('front_page_events_title') : 'Termine'; ?>" class="front-page-large-link">Alle <?php echo get_theme_mod('front_page_events_title') != null ? get_theme_mod('front_page_events_title') : 'Termine'; ?> &gt;</a>
      <?php } ?>
    </div>
  <?php } ?>


  <?php if (get_theme_mod('front_page_board_list') != '') { ?>
    <div class="front-page-persons-wrapper">
      <h1 class="front-page-title"><?php echo get_theme_mod('front_page_board_title') != null ? get_theme_mod('front_page_board_title') : 'Vorstand'; ?></h1>

      <div class="front-page-list">
        <?php $persons = explode(',', get_theme_mod('front_page_board_list'));
        foreach ($persons as $key => $id) {
          $p = get_post($id);
          if ($p->post_type != 'persons') { continue; }?>

          <a class="post-tile-link" href="<?php echo get_post_permalink($p->ID); ?>" rel="bookmark" title="<?php echo $p->post_title; ?>">
            <article class="post-tile" <?php if (!empty(get_the_post_thumbnail_url($p->ID, 'large'))) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url($p->ID, 'large') ?>)" <?php } ?>>
              <div class="post-tile-info">
                <span class="post-tile-date"><?php echo get_post_meta($p->ID, 'position', true); ?></span>
                <h1 class="post-tile-title"><?php echo $p->post_title; ?></h1>
              </div>
            </article>
          </a>
        <?php } ?>
      </div>

      <?php if (get_theme_mod('front_page_board_page') != '0') { ?>
        <a href="<?php echo get_page_link(get_theme_mod('front_page_board_page')) ?>" title="<?php echo get_theme_mod('front_page_board_page_link_title') != null ? get_theme_mod('front_page_board_page_link_title') : 'Kompletter Vorstand'; ?>" class="front-page-large-link"><?php echo get_theme_mod('front_page_board_page_link_title') != null ? get_theme_mod('front_page_board_page_link_title') : 'Kompletter Vorstand'; ?> &gt;</a>
      <?php } ?>
    </div>
  <?php } ?>
</div>

<?php get_footer(); ?>
