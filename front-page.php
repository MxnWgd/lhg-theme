<?php get_header(); ?>

<div class="content-wrapper">
  <div class="front-page-news-wrapper">
    <h1 class="front-page-title"><?php echo get_theme_mod('front_page_news_title'); ?></h1>

    <div class="front-page-news-list">
      <?php
      foreach (get_posts(array(
          'numberposts' => 4,
          'category' => get_cat_ID(get_theme_mod('front_page_news_category')),
        )) as $key => $value) {
        	?>
          <a class="front-page-news-element-link" href="<?php echo get_post_permalink($value->ID); ?>" rel="bookmark" title="<?php echo $value->post_title ?>">
            <article class="front-page-news-element" <?php if (has_post_thumbnail($value->ID)) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url($value->ID, 'large') ?>)" <?php } ?>>
                <div class="front-page-news-element-info">
                  <span class="front-page-news-element-date"><?php echo date_format(date_create($value->post_date), 'd.m.Y') ?></span>
                  <h1 class="front-page-news-element-title"><?php echo $value->post_title ?></h1>
                </div>
            </article>
          </a>
        <?php } ?>
    </div>

    <a href="<?php echo get_category_link(get_cat_ID(get_theme_mod('front_page_news_category'))) ?>" title="Alle Neuigkeiten" class="front-page-large-link">Alle Neuigkeiten &gt;</a>
  </div>
</div>

<?php get_footer(); ?>
