<?php
  if (!function_exists('get_month_name')) {
    function get_month_name($month, $short = false) {
      switch ($month) {
        case '01':
        return $short ? 'Jan' : 'Januar';
        break;

        case '02':
        return $short ? 'Feb' : 'Februar';
        break;

        case '03':
        return $short ? 'Mär' : 'März';
        break;

        case '04':
        return $short ? 'Apr' : 'April';
        break;

        case '05':
        return 'Mai';
        break;

        case '06':
        return $short ? 'Jun' : 'Juni';
        break;

        case '07':
        return $short ? 'Jul' : 'Juli';
        break;

        case '08':
        return $short ? 'Aug' : 'August';
        break;

        case '09':
        return $short ? 'Sep' : 'September';
        break;

        case '10':
        return $short ? 'Okt' : 'Oktober';
        break;

        case '11':
        return $short ? 'Nov' : 'November';
        break;

        case '12':
        return $short ? 'Dez' : 'Dezember';
        break;

        default:
        return '';
        break;
      }
    }
  }

  $color = get_the_terms(get_the_ID(), 'calendar', true) != '' ? get_term_meta(get_the_terms(get_the_ID(), 'calendar', true)[0]->term_id, 'calendarcolor', true) : '';
?>

<article class="event-wrapper <?php echo $v['color'] == '' ? 'default' : $v['color']; ?>">
  <div class="event-wrapper-floater"></div>

  <h1 class="event-wrapper-title"><?php the_title(); ?></h1>

  <div class="event-wrapper-date <?php echo str_contains(get_theme_mod('theme_color_option'), 'gelb') ? 'dark-text' : '' ?>">
    <?php
      $date_start = date_create(get_post_meta(get_the_ID(), 'date_start', true));
      $date_end = date_create(get_post_meta(get_the_ID(), 'date_end', true));

      if (get_post_meta(get_the_ID(), 'date_end', true) !== ''
          && (date_format($date_start, 'd') !== date_format($date_end, 'd') || date_format($date_start, 'm') !== date_format($date_end, 'm'))) {
        ?><span class="event-wrapper-date-day multiple"><?php echo date_format($date_start, 'd') . '-' . date_format($date_end, 'd'); ?></span><?php
      } else {
        ?><span class="event-wrapper-date-day"><?php echo date_format($date_start, 'd'); ?></span><?php
      }

      if (get_post_meta(get_the_ID(), 'date_end', true) !== '' && date_format($date_start, 'm') !== date_format($date_end, 'm')) {
        ?><span class="event-wrapper-date-month multiple"><?php echo get_month_name(date_format($date_start, 'm'), true) . ' - ' . get_month_name(date_format($date_end, 'm'), true); ?></span><?php
      } else {
        ?><span class="event-wrapper-date-month"><?php echo get_month_name(date_format($date_start, 'm'), false); ?></span><?php
      }

      if (date_format($date_start, 'Y') !== date ("Y")) {
        ?><span class="event-wrapper-date-year"><?php echo date_format($date_start, 'Y'); ?></span><?php
      }
    ?>

  </div>

  <p class="post-meta">
    <?php
      $time_stamp = '';

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
        ?>&nbsp;&verbar; <?php
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

  <?php if (get_post_meta(get_the_ID(), 'event_desc', true) !== '') {  ?>
    <details class="event-wrapper-description">
      <summary><span class="expand-icon-ud"></span></summary>
      <div>
        <?php
          // remove html and all text after more-tag
          echo strip_tags(substr(get_post_meta(get_the_ID(), 'event_desc', true), 0, strpos(get_post_meta(get_the_ID(), 'event_desc', true), '<!--more-->') + 11));
        ?>

        <?php if (get_post_meta(get_the_ID(), 'large_event', true) === '1') { ?>
          <br>
          <a class="events-page-link" href="<?php the_permalink(); ?>" title="Mehr Infos">Mehr Infos &gt;</a>
        <?php } ?>
      </div>
    </details>
  <?php } ?>
</article>
