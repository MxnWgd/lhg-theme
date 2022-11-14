<a class="compact-wrapper-link" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
  <article class="compact-wrapper <?php echo get_post_meta(get_the_ID(), 'resolution_status', true) == 'expired' ? 'inactive' : ''; ?>">
      <h1 class="post-title"><?php the_title(); ?> <?php echo get_post_meta(get_the_ID(), 'resolution_status', true) == 'expired' ? '(abgelaufen)' : ''; ?></h1>

      <p class="post-meta">
        <?php
          $assembly = get_the_terms(get_the_ID(), 'assembly');

          for ($i = 0; $i < sizeof($assembly); $i++) {
            echo $assembly[$i]->name;

            if ($i < sizeof($assembly) - 1) {
              echo ', ';
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
