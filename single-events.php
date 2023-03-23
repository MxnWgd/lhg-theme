<?php get_header(); ?>

<div class="content-wrapper">
  <div class="post">
    <?php while (have_posts()) { the_post(); ?>
      <article class="single-wrapper">
        <p class="post-meta">
          <?php
            $time_stamp = '';
            $date_start = date_create(get_post_meta(get_the_ID(), 'date_start', true));
            $date_end = date_create(get_post_meta(get_the_ID(), 'date_end', true));

            if (get_post_meta(get_the_ID(), 'date_end', true) !== '' && date_format($date_start, 'd. m. Y') !== date_format($date_end, 'd.m.Y')) {
              if (date_format($date_start, 'm') !== date_format($date_end, 'm')) {
                if (date_format($date_start, 'Y') !== date_format($date_end, 'Y')) {
                  //day, month and year different
                  $time_stamp .= date_format($date_start, 'd.m.Y') . ' - ' . date_format($date_end, 'd.m.Y');
                } else {
                  //day and month different
                  $time_stamp .= date_format($date_start, 'd.m.') . ' - ' . date_format($date_end, 'd.m.Y');
                }
              } else {
                if (date_format($date_start, 'Y') !== date_format($date_end, 'Y')) {
                  //day and year different
                  $time_stamp .= date_format($date_start, 'd.m.Y') . ' - ' . date_format($date_end, 'd.m.Y');
                } else {
                  //only day different
                  $time_stamp .= date_format($date_start, 'd.') . ' - ' . date_format($date_end, 'd.m.Y');
                }
              }
            } else {
              $time_stamp .= date_format($date_start, 'd.m.Y');
            }

            $time_stamp .= ' | ';

            $time_start = get_post_meta(get_the_ID(), 'time_start', true);
            $time_end = get_post_meta(get_the_ID(), 'time_end', true);

            if ($time_start !== '') {
              if ($time_end !== '') {
                $time_stamp .= $time_start . ' - ' . $time_end . ' Uhr';
              } else {
                $time_stamp .= 'ab ' . $time_start . ' Uhr';
              }
            } else {
              $time_stamp .= 'ganztägig';
            }

            echo $time_stamp;


            if (get_post_meta(get_the_ID(), 'location', true) !== '') {
              ?>&nbsp;&verbar;&nbsp;<?php
              if (get_post_meta(get_the_ID(), 'link_to_maps', true) === '1') {
                ?><a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode(get_post_meta(get_the_ID(), 'location', true)) ?>" target="_blank" title="<?php echo get_post_meta(get_the_ID(), 'location', true) ?>"><?php echo get_post_meta(get_the_ID(), 'location', true) ?></a><?php
              } else if (get_post_meta(get_the_ID(), 'event_link', true) !== '') {
                ?><a href="<?php echo get_post_meta(get_the_ID(), 'event_link', true) ?>" target="_blank" title="<?php echo get_post_meta(get_the_ID(), 'location', true) ?>"><?php echo get_post_meta(get_the_ID(), 'location', true) ?></a><?php
              } else {
                echo get_post_meta(get_the_ID(), 'location', true);
              }
            }
          ?>
        </p>

        <h1 class="post-title">
          <?php the_title(); ?>
          <?php echo is_user_logged_in() ? '&nbsp;<a class="edit-post-link" title="Veranstaltung bearbeiten" href="' . get_edit_post_link(get_the_ID()) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
        </h1>

        <div class="post-content">
          <?php echo str_replace('<!--more-->', '<br>', get_post_meta(get_the_ID(), 'event_desc', true)); ?>
        </div>
      </article>
    <?php } ?>
  </div>
</div>

<?php get_footer(); ?>
