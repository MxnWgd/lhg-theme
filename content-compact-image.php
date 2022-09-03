<a class="compact-image-wrapper-link" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
  <article class="compact-image-wrapper" <?php if (has_post_thumbnail($value->ID)) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url($value->ID, 'large') ?>)" <?php } ?>>
    <div class="compact-image-wrapper-info">
      <span class="compact-image-wrapper-date"><?php echo get_the_date('d.m.Y'); ?></span>
      <h1 class="compact-image-wrapper-title"><?php the_title(); ?></h1>

      <div class="compact-image-wrapper-excerpt">
        <?php the_excerpt(); ?>
      </div>
    </div>
  </article>
</a>
