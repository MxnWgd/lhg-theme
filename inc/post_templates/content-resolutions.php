<a class="compact-wrapper-link" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
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
  <article class="compact-wrapper <?php echo $expired ? 'inactive' : ''; ?>">
      <h1 class="post-title"><?php the_title(); ?> <?php echo $expired ? '(abgelaufen)' : ''; ?></h1>

      <p class="post-meta">
        <?php
          $assembly = get_the_terms(get_the_ID(), 'assembly');

          if ($assembly != false) {
            for ($i = 0; $i < sizeof($assembly); $i++) {
              echo $assembly[$i]->name;

              if ($i < sizeof($assembly) - 1) {
                echo ', ';
              }
            }
          }

          $applicants = get_the_terms(get_the_ID(), 'applicants');

          if ($applicants != false) {
            ?>
            &nbsp;&verbar;&nbsp;
            <?php

            for ($i = 0; $i < sizeof($applicants); $i++) {
              echo $applicants[$i]->name;

              if ($i < sizeof($applicants) - 1) {
                echo ', ';
              }
            }
          }

        ?>
      </p>

      <div class="post-excerpt">
        <?php the_excerpt(); ?>
      </div>
  </article>
</a>
