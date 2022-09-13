<a class="compact-wrapper-link" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
  <article class="compact-wrapper">
      <h1 class="post-title"><?php the_title(); ?></h1>

      <p class="post-meta">
        <?php
          $assembly = get_the_terms(get_the_ID(), 'assembly');

          for ($i = 0; $i < sizeof($assembly); $i++) {
            echo $assembly[$i]->name;

            if ($i < sizeof($assembly) - 1) {
              echo ', ';
            }
          }
        ?>
        &nbsp;&verbar;&nbsp;
        <?php
          $applicants = get_the_terms(get_the_ID(), 'applicants');

          for ($i = 0; $i < sizeof($applicants); $i++) {
            echo $applicants[$i]->name;

            if ($i < sizeof($applicants) - 1) {
              echo ', ';
            }
          }
        ?>
      </p>

      <div class="post-excerpt">
        <?php the_excerpt(); ?>
      </div>
  </article>
</a>
