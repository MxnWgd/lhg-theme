<?php
  function getCalendar($m = '', $y = '') {
    $year = $y != '' ? $y : date('Y');
    $month = $m != '' ? $m : date('m');
    $n_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    $weekday_first_day = date('N', strtotime($year . '-' . $month . '-01')); //get weekday number of first day in month
    $first_day_offset = $weekday_first_day - 1;
    $end_offset = 7 - (($n_days_in_month + $first_day_offset) % 7); //get offset at the end of the calendar
    $end_offset = $end_offset == 7 ? 0 : $end_offset; //and set to 0 if 7, otherwise row will be added

    $current_day = 0;
    if ($year == date('Y') && $month == date('m')) {
      $current_day = date('j');
    }

    $prev_month = date('Y-m', strtotime('-1 month', strtotime($year . '-' . $month . '-01')));
    $n_days_in_prev_month = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($prev_month)), date('Y', strtotime($prev_month)));
    $next_month = date('Y-m', strtotime('+1 month', strtotime($year . '-' . $month . '-01')));

    $query_args = array(
      'orderby' => 'meta_value',
      'order' => 'ASC',
      'meta_key' => 'date_start',
      'post_type' => array('events'),
      'posts_per_page' => -1,
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'key' => 'date_start',
          'value' => $prev_month . '-' . ($n_days_in_prev_month - $first_day_offset + 1), //first date visible in calendar including offset
          'compare' => '>=',
        ),
        array(
          'key' => 'date_start',
          'value' => $year . '-' . $month . '-' . $n_days_in_month,
          'compare' => '<=',
        )
      ),
    );

    $cal_query = new WP_Query($query_args);
    $month_events = array();
    $prev_month_events = array();

    //parse query data into usable array
    if ($cal_query->have_posts()) {
      while ($cal_query->have_posts()) {
        $cal_query->the_post();

        $data_ds = get_post_meta(get_the_ID(), 'date_start', true);
        $data_de = get_post_meta(get_the_ID(), 'date_end', true);

        $day_start = ltrim(explode('-', $data_ds)[2], '0');
        $day_end = $data_de != '' ? ltrim(explode('-', $data_de)[2], '0') : $day_start;

        $date_diff = $day_end != $day_start ? date_diff(date_create($data_ds), date_create($data_de))->days : 0;

        $color = get_the_terms(get_the_ID(), 'calendar', true) != '' ? get_term_meta(get_the_terms(get_the_ID(), 'calendar', true)[0]->term_id, 'calendarcolor', true) : '';

        // description
        $desc = '';
        if (get_post_meta(get_the_ID(), 'event_desc', true) !== '') {
          $more_tag_pos = strpos(get_post_meta(get_the_ID(), 'event_desc', true), '<!--more-->');

          if (!$more_tag_pos) {
            $desc = strip_tags(get_post_meta(get_the_ID(), 'event_desc', true), '<b><i><em><strong><del>');
          } else {
            $desc = strip_tags(substr(get_post_meta(get_the_ID(), 'event_desc', true), 0, $more_tag_pos + 11), '<b><i><em><strong><del>');
          }
        }


        $ev = array(
          'title' => get_the_title(),
          'day_start' => explode('-', $data_ds)[2],
          'day_end' => $data_de != '' ? explode('-', $data_de)[2] : explode('-', $data_ds)[2],
          'span' => $date_diff + 1,
          'time_start' => get_post_meta(get_the_ID(), 'time_start', true),
          'time_end' => get_post_meta(get_the_ID(), 'time_end', true),
          'desc' => cutoff($desc, 256),
          'location' => get_post_meta(get_the_ID(), 'location', true),
          'link_to_page' => get_post_meta(get_the_ID(), 'large_event', true) === '1' ? get_permalink() : '',
          'color' => $color,
          'extension' => false,
        );

        if (explode('-', $data_ds)[1] == date('m', strtotime('-1 month', strtotime($year . '-' . $month . '-01')))) { //if event from prev month
          if (array_key_exists($day_start, $prev_month_events)) {
            array_push($prev_month_events[$day_start], $ev);
          } else {
            $prev_month_events[$day_start] = array($ev);
          }
        } else {
          if (array_key_exists($day_start, $month_events)) {
            array_push($month_events[$day_start], $ev);
          } else {
            $month_events[$day_start] = array($ev);
          }
        }
      }
    }


    ?>

      <div class="calendar" id="calendar">
        <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/inc/calendar/calendar.js"></script>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/inc/calendar/calendar.css">

        <h1 class="calendar-title"><?php echo get_month_name($month) . ' ' . $year; ?></h1>

        <div class="calendar-block">
          <button class="calendar-switch-button" type="button" name="<?php echo $prev_month; ?>" title="Vorheriger Monat" href="<?php echo site_url() ?>/wp-admin/admin-ajax.php" onclick="switchCalendar(this)"><span class="arrow-icon left"></span></button>

          <div class="calendar-grid">
            <div class="calendar-element top-bar">Mo<span class="date-extension">ntag</span></div>
            <div class="calendar-element top-bar">Di<span class="date-extension">enstag</span></div>
            <div class="calendar-element top-bar">Mi<span class="date-extension">ttwoch</span></div>
            <div class="calendar-element top-bar">Do<span class="date-extension">nnerstag</span></div>
            <div class="calendar-element top-bar">Fr<span class="date-extension">eitag</span></div>
            <div class="calendar-element top-bar">Sa<span class="date-extension">mstag</span></div>
            <div class="calendar-element top-bar">So<span class="date-extension">nntag</span></div>

            <?php
              //include dummy elements to create offset
              for ($i = 1; $i <= $first_day_offset; $i++) {
                $current = $n_days_in_prev_month - $first_day_offset + $i;
                ?><div class="calendar-element dummy">
                  <span class="calendar-element-label dummy"><?php echo $current; ?></span>

                  <?php
                    if (array_key_exists($current, $prev_month_events)) {
                      foreach ($prev_month_events[$current] as $value) {
                        $total_span = $value['span'];

                        //only display if spans into current month, otherwise continue
                        if ($i + $value['span'] - 1 <= $first_day_offset) {
                          continue;
                        }


                        if (($i + $value['span'] - 1) > 7) { //if span exceeds line
                          $span = 8 - $i; //take until line end
                          $overflow_span = $value['span'] - $span; //calculate overflow

                          $ev = array(
                            'title' => $value['title'],
                            'day_start' => $value['day_start'],
                            'day_end' => $value['day_end'],
                            'span' => $overflow_span,
                            'time_start' => $value['time_start'],
                            'time_end' => $value['time_end'],
                            'desc' => $value['desc'],
                            'location' => $value['location'],
                            'link_to_page' => $value['link_to_page'],
                            'color' => $value['color'],
                            'extension' => true,
                          );

                          if (array_key_exists($i + $span, $month_events)) { //and add new element with overflow data
                            array_push($month_events[$i + $span], $ev);
                          } else {
                            $month_events[$first_day_offset - $i + $span] = array($ev);
                          }
                        } else {
                          $span = $value['span'];
                        }

                        e_event($value, $month, $year, $span);
                      }
                    }
                  ?>
                </div><?php
              }

              //create day elements
              for ($i = 1; $i <= $n_days_in_month; $i++) {
                ?>
                  <div class="calendar-element <?php echo $i == $current_day ? 'current-day' : '' ?>" id="calendar-day-<?php echo $i; ?>">
                    <span class="calendar-element-label"><?php echo $i; ?></span>
                    <?php
                      if (array_key_exists($i, $month_events)) {
                        foreach ($month_events[$i] as $value) {
                          $total_span = $value['span'];

                          if (((($first_day_offset + $i) % 7) + $value['span'] - 1) > 7) { //if span exceeds line
                            $span = 8 - (($first_day_offset + $i) % 7); //take until line end
                            $overflow_span = $value['span'] - $span; //calculate overflow

                            $ev = array(
                              'title' => $value['title'],
                              'day_start' => $value['day_start'],
                              'day_end' => $value['day_end'],
                              'span' => $overflow_span,
                              'time_start' => $value['time_start'],
                              'time_end' => $value['time_end'],
                              'desc' => $value['desc'],
                              'location' => $value['location'],
                              'link_to_page' => $value['link_to_page'],
                              'color' => $value['color'],
                              'extension' => true,
                            );

                            if (array_key_exists($i + $span, $month_events)) { //and add new element with overflow data
                              array_push($month_events[$i + $span], $ev);
                            } else {
                              $month_events[$i + $span] = array($ev);
                            }
                          } else {
                            $span = $value['span'];
                          }

                          e_event($value, $month, $year, $span);
                        }
                      }
                    ?>
                  </div>
                <?php
              }

              //include dummy elements to create offset
              for ($i = 0; $i < $end_offset; $i++) {
                ?><div class="calendar-element dummy">
                  <span class="calendar-element-label dummy"><?php echo $i + 1; ?></span>
                </div><?php
              }
            ?>
          </div>

          <button class="calendar-switch-button" type="button" name="<?php echo $next_month; ?>" title="Nächster Monat" href="<?php echo site_url() ?>/wp-admin/admin-ajax.php" onclick="switchCalendar(this)"><span class="arrow-icon right"></span></button>
        </div>

        <div class="calendar-blur"></div>
      </div>
    <?php
  }

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

  function cutoff($string, $length) {
    if (strlen($string) > $length) {
      return substr($string, 0, $length) . '...';
    } else {
      return $string;
    }
  }

  function e_event($v, $month, $year, $span) {
    ?><span class="calendar-element-event <?php echo $v['extension'] ? 'extension' : '' ?> <?php echo $v['color'] == '' ? 'default' : $v['color']; ?>" span="<?php echo $span; ?>" onclick="event.stopPropagation(); expandEvent(this);">
      <span class="title"><?php echo $v['title']; ?></span>
      <span class="additional-info">
        <span class="subtitle">
          <?php
            echo $v['day_start']; echo $v['day_end'] != $v['day_start'] ? '. - ' . $v['day_end'] : ''; echo '.' . $month . '.' . $year;
            echo $v['time_start'] != '' ? ' | ' . $v['time_start'] : '';
            echo $v['time_end'] != '' ? ' - ' . $v['time_end'] : '';
            echo $v['time_start'] != '' || $v['time_end'] != '' ? ' Uhr' : '';
            echo $v['location'] != '' ? ' | ' . $v['location'] : '';
          ?>
        </span>
        <span>
          <?php
            echo wpautop($v['desc']);
            if ($v['link_to_page'] != '') { ?>
              <br>
              <a class="events-page-link" href="<?php echo $v['link_to_page']; ?>" title="Mehr Infos">Mehr Infos &gt;</a>
            <?php }
          ?>
        </span>
      </span>
    </span><?php
  }


  ?>
