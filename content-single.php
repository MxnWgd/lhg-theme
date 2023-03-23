<article class="single-wrapper">
    <p class="post-meta">
      <?php the_date('d.m.Y'); ?>
      <?php if (get_the_category_list() !== '') { ?>
        &nbsp;&verbar;&nbsp; <?php the_category(',&nbsp;'); ?>
      <?php } ?>
    </p>

    <h1 class="post-title">
      <?php the_title(); ?>
      <?php echo is_user_logged_in() ? '&nbsp;<a class="edit-post-link" title="Beitrag bearbeiten" href="' . get_edit_post_link(get_the_ID()) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
    </h1>

    <div class="post-content">
      <?php the_content(); ?>
    </div>

    <div class="post-tags">
      <?php the_tags('', ''); ?>
    </div>
</article>
