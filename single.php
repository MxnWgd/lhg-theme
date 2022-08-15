<?php get_header(); ?>

<div class="content-wrapper">
  <div class="post">
    <?php while (have_posts()) {
    	the_post();

    	get_template_part('content-single');
    } ?>
  </div>

  <div class="related-posts-wrapper">
    <h1 class="related-posts-title">Weitere Beiträge</h1>

    <div class="related-posts-list">
      <?php
      $id = get_the_ID();

      foreach (get_posts(array(
          'numberposts' => 7,
          'category' => get_the_category()[0]->cat_ID
        )) as $key => $value) {
          if ($id == $value->ID) {
            continue;
          }
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

    <a href="<?php echo get_category_link(get_the_category()[0]->cat_ID) ?>" title="Alle Beiträge" class="related-posts-large-link">Alle Beiträge &gt;</a>
  </div>
</div>

<?php get_footer(); ?>
