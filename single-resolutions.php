<?php get_header(); ?>

<div class="content-wrapper">
  <div class="post">
    <?php
      $expired = false;

      if (get_post_meta(get_the_ID(), 'resolution_status', true) == 'expired') {
        $expired = true;
      } else if (get_post_meta(get_the_ID(), 'resolution_status', true) == 'auto') { // if status is set to auto and sunset has expired
        if (get_post_meta(get_the_ID(), 'resolution_sunset', true) != '') {
          if (date('Y-m-d') > date('Y-m-d', strtotime(get_the_date('Y-m-d') . ' + ' . get_post_meta(get_the_ID(), 'resolution_sunset', true) . ' years'))) {
            $expired = true;
          }
        }
      }
    ?>
    <?php while (have_posts()) { the_post(); ?>
      <article class="single-wrapper">
          <div class="resolutions-meta">
            <span class="resolutions-date">
              <?php if ($expired) {
                echo 'abgelaufen';
              } else {
                the_date('d.m.Y');
              } ?>
            </span>

            <?php if (get_the_terms(get_the_ID(), 'assembly') != null) { ?>
              <h3 class="resolutions-subtitle"><?php the_terms(get_the_ID(), 'assembly'); ?></h3>
            <?php } ?>

            <h1 class="resolutions-title">
              <?php the_title(); ?>
              <?php echo is_user_logged_in() ? '&nbsp;<a class="edit-post-link" title="Beschluss bearbeiten" href="' . get_edit_post_link(get_the_ID()) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
            </h1>

            <?php if (get_the_terms(get_the_ID(), 'applicants') != null) {
              ?><h3 class="resolutions-subtitle">Antragsteller:&nbsp;<?php the_terms(get_the_ID(), 'applicants'); ?></h3><?php
            } ?>

            <?php if ($expired) {
              ?><h3 class="resolutions-subtitle">Dieser Beschluss ist abgelaufen.</h3><?php
            } else if (get_post_meta(get_the_ID(), 'resolution_sunset', true) != '') {
              ?><h3 class="resolutions-subtitle">Gültigkeitsdauer: <?php echo get_post_meta(get_the_ID(), 'resolution_sunset', true); echo get_post_meta(get_the_ID(), 'resolution_sunset', true) == 1 ? ' Jahr' : ' Jahre'; ?></h3><?php
            } ?>
          </div>

          <div class="post-content">
            <?php the_content(); ?>
          </div>

          <?php if (get_the_terms(get_the_ID(), 'resolutiontags') != null) { ?>
            <div class="post-tags">
              <?php foreach (get_the_terms(get_the_ID(), 'resolutiontags') as $value) { ?>
                <a href="<?php echo get_term_link($value->name, 'resolutiontags') ?>" title="<?php echo $value->name; ?>"><?php echo $value->name; ?></a>
              <?php } ?>
            </div>
          <?php } ?>
      </article>
    <?php } ?>
  </div>

  <?php if (get_the_terms(get_the_ID(), 'assembly') != null) { ?>
    <?php
      $assembly_resolutions = get_posts(array(
        'numberposts' => 7,
        'post_type' => 'resolutions',
        'assembly' => get_the_terms(get_the_ID(), 'assembly')[0]->name,
      ));

      if (sizeof($assembly_resolutions) >= 2) {
    ?>
      <div class="related-posts-wrapper">
        <h1 class="related-posts-title"><?php echo get_the_terms(get_the_ID(), 'assembly')[0]->name; ?> - Beschlüsse</h1>

        <div class="related-posts-list">
          <?php
          $id = get_the_ID();

          foreach ($assembly_resolutions as $key => $value) {
              if ($id == $value->ID) {
                continue;
              }
              ?>
              <a class="post-tile-link" href="<?php echo get_post_permalink($value->ID); ?>" rel="bookmark" title="<?php echo $value->post_title ?>">
                <article class="post-tile resolutions-tile">
                    <div class="post-tile-info resolutions-tile-info">
                      <span class="post-tile-subtitle">
                        <?php
                          $tags = get_the_terms($value->ID, 'resolutiontags');

                          if ($tags != null) {
                            for ($i = 0; $i < sizeof($tags); $i++) {
                              echo '#' . $tags[$i]->name . ' ';
                            }
                          }
                        ?>
                      </span>

                      <h1 class="post-tile-title"><?php echo $value->post_title ?> <?php echo get_post_meta($value->ID, 'resolution_status', true) == 'expired' ? '(abgelaufen)' : '' ?></h1>
                    </div>
                </article>
              </a>
          <?php } ?>
        </div>

        <a href="<?php echo get_term_link(get_the_terms(get_the_ID(), 'assembly')[0]->name, 'assembly') ?>" title="Alle Beschlüsse" class="related-posts-large-link">Alle Beschlüsse &gt;</a>
      </div>
    <?php }
  } ?>
</div>

<?php get_footer(); ?>
