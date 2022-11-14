<?php get_header(); ?>

<div class="content-wrapper">
  <div class="post">
    <?php while (have_posts()) {
    	the_post();

    	?>
      <article class="single-wrapper">
          <p class="post-meta">
            hochgeladen am <?php the_date('d.m.Y'); ?>
          </p>

          <h1 class="post-title"><?php the_title(); ?></h1>

          <div class="post-content">
            <figure class="wp-block-image">
              <?php echo wp_get_attachment_image(get_the_ID(), 'large'); ?>
              <figcaption><?php echo get_the_excerpt(get_the_ID()); ?></figcaption>
            </figure>
          </div>
      </article>
      <?php
    } ?>
  </div>
</div>

<?php get_footer(); ?>
