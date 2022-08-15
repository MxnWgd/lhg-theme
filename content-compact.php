<a class="compact-wrapper-link" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
  <article class="compact-wrapper">
      <h1 class="post-title"><?php the_title(); ?></h1>

      <p class="post-meta">
        <?php echo get_the_date('d.m.Y'); ?>
      </p>

      <div class="post-excerpt">
        <?php the_excerpt(); ?>
      </div>
  </article>
</a>
