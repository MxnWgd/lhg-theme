<?php get_header(); ?>

<div class="content-wrapper">
  <div class="front-page-news-wrapper">
    <h1 class="front-page-title"><?php echo get_theme_mod('front_page_news_title'); ?></h1>

    <div class="front-page-news-list">
      <?php
      foreach (get_posts(array(
          'numberposts' => 8,
          'category' => get_cat_ID(get_theme_mod('front_page_news_category')),
        )) as $key => $value) {
        	?>
          <a class="post-tile-link" href="<?php echo get_post_permalink($value->ID); ?>" rel="bookmark" title="<?php echo $value->post_title ?>">
            <article class="post-tile" <?php if (has_post_thumbnail($value->ID)) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url($value->ID, 'large') ?>)" <?php } ?>>
                <div class="post-tile-info">
                  <span class="post-tile-date"><?php echo date_format(date_create($value->post_date), 'd.m.Y') ?></span>
                  <h1 class="post-tile-title"><?php echo $value->post_title ?></h1>
                </div>
            </article>
          </a>
        <?php } ?>
    </div>

    <a href="<?php echo get_category_link(get_cat_ID(get_theme_mod('front_page_news_category'))) ?>" title="Alle Neuigkeiten" class="front-page-large-link">Alle Neuigkeiten &gt;</a>
  </div>

  <?php if (get_theme_mod('front_page_additional_area_page') != 0) {
    $content_area_page = get_post(get_theme_mod('front_page_additional_area_page')); ?>
    <div class="front-page-content-area" style="background-image: url(<?php echo get_the_post_thumbnail_url($content_area_page->ID, 'large'); ?>);">
      <div class="front-page-content-area-box <?php echo get_theme_mod('front_page_additional_area_page_lr') !== '' ? get_theme_mod('front_page_additional_area_page_lr') : 'left'; ?>">
        <h1 class="front-page-content-area-title"><?php echo $content_area_page->post_title; ?></h1>
        <?php echo $content_area_page->post_content; ?>
      </div>
    </div>
  <?php } ?>
</div>

<?php get_footer(); ?>
