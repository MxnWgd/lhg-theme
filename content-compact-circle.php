<a class="compact-circle-wrapper-link" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
  <article class="compact-circle-wrapper">
      <div <?php if (has_post_thumbnail($value->ID)) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url($value->ID, 'large'); ?>); background-size: cover;"<?php } ?> class="compact-circle-wrapper-thumbnail"></div>
      <div class="compact-circle-wrapper-floater"></div>

      <h1 class="post-title"><?php the_title(); ?></h1>

      <p class="post-meta">
        <?php echo get_the_date('d.m.Y'); ?>
      </p>

      <div class="post-excerpt">
        <?php the_excerpt(); ?>
      </div>
  </article>
</a>
