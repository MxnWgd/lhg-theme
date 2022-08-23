<article class="persons-wrapper">
  <div <?php if (has_post_thumbnail($post->ID)) { ?>style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID, 'large'); ?>); background-size: cover;"<?php } ?> class="persons-wrapper-thumbnail"></div>
  <h1 class="persons-wrapper-title"><?php the_title(); ?></h1>

  <p class="persons-wrapper-position"><?php echo get_post_meta($post->ID, 'position', true); ?></p>
  <p class="persons-wrapper-subtitle"><?php echo get_post_meta($post->ID, 'subtitle', true); ?></p>

  <div class="post-excerpt">
    <?php the_content(); ?>
  </div>
</article>
