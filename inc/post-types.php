<?php
/*-----------------------------------------------
  Persons
-----------------------------------------------*/

function post_type_persons() {
  register_post_type('persons', array(
    'labels' => array(
      'name' => 'Personen',
      'singular_name' => 'Person',
      'menu_name' => 'Personen',
      'parent_item_colon' => 'Übergeordnete Person',
      'all_items' => 'Alle Personen',
      'view_item' => 'Person anzeigen',
      'add_new_item' => 'Person erstellen',
      'add_new' => 'Erstellen',
      'edit_item' => 'Person bearbeiten',
      'update_item' => 'Person aktualisieren',
      'search_items' => 'Person suchen',
      'not_found' => 'Keine Person gefunden.',
      'not_found_in_trash' => 'Keine Person im Papierkorb gefunden',
    ),
    'public' => true,
    'exclude_from_search' => true,
    'menu_icon' => 'dashicons-groups',
    'has_archive' => false,
    'show_in_nav_menus' => false,
    'supports' => array('title', 'thumbnail'),
  ));
}
add_action('init', 'post_type_persons');

function adding_person_meta_boxes(){
  add_meta_box(
      'person_data',
      'Daten',
      'person_form_render',
      'persons',
      'normal',
      'high'
  );
  add_meta_box(
      'person_id',
      'Shortcode',
      'person_shortcode_render',
      'persons',
      'side'
  );
}
function person_form_render() {
  global $post;

  $post_meta = get_post_meta($post->ID);

  ?>
  <div style="display: grid; grid-template-columns: 150px auto; grid-gap: 10px;">

    <label for="metaInputPersonPositon" style="width: 100%; margin: 10px 5px;"><strong>Funktion/Position</strong></label>
    <input type="text" id="metaInputPersonPositon" name="position" value="<?php echo isset($post_meta['position'][0]) ? $post_meta['position'][0] : ''; ?>"/>

    <label for="metaInputPersonSubtitle" style="width: 100%; margin: 10px 5px;"><strong>Untertitel</strong></label>
    <input type="text" id="metaInputPersonSubtitle" name="subtitle" value="<?php echo isset($post_meta['subtitle'][0]) ? $post_meta['subtitle'][0] : ''; ?>"/>

    <label for="metaInputPersonDescription" style="width: 100%; margin: 10px 5px;"><strong>Beschreibung</strong></label>
    <?php wp_editor(isset($post_meta['description'][0]) ? $post_meta['description'][0] : '', 'description', array(
      'textarea_rows' => '8',
      'media_buttons' => false,
      'wpautop' => false
    )); ?>

    <h1 style="grid-column: 1 / span 2;">Social-Media</h1>
    <span style="grid-column: 1 / span 2;"><em>Bitte nicht mehr als 5 Social-Media-Einträge gleichzeitig verwenden.</em></span>

    <label for="metaInputPersonMail" style="width: 100%; margin: 10px 5px;"><strong>E-Mail-Adresse</strong></label>
    <input type="email" id="metaInputPersonMail" name="mail" value="<?php echo isset($post_meta['mail'][0]) ? $post_meta['mail'][0] : ''; ?>"/>

    <label for="metaInputPersonPhone" style="width: 100%; margin: 10px 5px;"><strong>Telefonnummer</strong></label>
    <input type="tel" id="metaInputPersonPhone" name="phone" value="<?php echo isset($post_meta['phone'][0]) ? $post_meta['phone'][0] : ''; ?>"/>

    <label for="metaInputPersonFacebook" style="width: 100%; margin: 10px 5px;"><strong>Facebook-Profil</strong></label>
    <input type="url" id="metaInputPersonFacebook" name="facebook" value="<?php echo isset($post_meta['facebook'][0]) ? $post_meta['facebook'][0] : ''; ?>"/>

    <label for="metaInputPersonInstagram" style="width: 100%; margin: 10px 5px;"><strong>Instagram-Account</strong></label>
    <input type="url" id="metaInputPersonInstagram" name="instagram" value="<?php echo isset($post_meta['instagram'][0]) ? $post_meta['instagram'][0] : ''; ?>"/>

    <label for="metaInputPersonTwitter" style="width: 100%; margin: 10px 5px;"><strong>Twitter-Account</strong></label>
    <input type="url" id="metaInputPersonTwitter" name="twitter" value="<?php echo isset($post_meta['twitter'][0]) ? $post_meta['twitter'][0] : ''; ?>"/>

    <label for="metaInputPersonLinkedin" style="width: 100%; margin: 10px 5px;"><strong>LinkedIn-Account</strong></label>
    <input type="url" id="metaInputPersonLinkedin" name="linkedin" value="<?php echo isset($post_meta['linkedin'][0]) ? $post_meta['linkedin'][0] : ''; ?>"/>
  </div>
  <?php
}
function person_shortcode_render() {
  global $post;

  ?>
  <h3>ID: <?php echo get_post()->ID; ?></h3>
  <p>Verwende den folgenden Shortcode, um die Person auf einer beliebigen Seite anzuzeigen:</p>
  <code>[person id="<?php echo get_post()->ID; ?>"]</code>
  <h3>Hilfe</h3>
  <a href="<?php menu_page_url('help_persons'); ?>" title="Hilfe zu den Personen" target="_blank">Hilfe zu den Personen</a>
  <?php
}
add_action('add_meta_boxes_' . 'persons', 'adding_person_meta_boxes');

function persons_shorttag_func($prop) {
  global $post;

  $person = get_post($prop['id']);
  include('post_templates/content-persons.php');
  return $result;
}
add_shortcode('person', 'persons_shorttag_func');



/*-----------------------------------------------
  Events
-----------------------------------------------*/

function post_type_events() {
  register_post_type('events', array(
    'labels' => array(
      'name' => 'Veranstaltungen',
      'singular_name' => 'Veranstaltung',
      'menu_name' => 'Veranstaltungen',
      'parent_item_colon' => 'Übergeordnete Veranstaltung',
      'all_items' => 'Veranstaltungen',
      'view_item' => 'Veranstaltung anzeigen',
      'add_new_item' => 'Veranstaltung erstellen',
      'add_new' => 'Erstellen',
      'edit_item' => 'Veranstaltung bearbeiten',
      'update_item' => 'Veranstaltung aktualisieren',
      'search_items' => 'Veranstaltung suchen',
      'not_found' => 'Keine Veranstaltungen gefunden.',
      'not_found_in_trash' => 'Keine Veranstaltungen im Papierkorb gefunden',
    ),
    'public' => true,
    'exclude_from_search' => true,
    'menu_icon' => 'dashicons-calendar-alt',
    'has_archive' => true,
    'show_in_nav_menus' => true,
    'supports' => array('title'),
  ));
}
add_action('init', 'post_type_events');

function adding_events_meta_boxes(){
  add_meta_box(
      'event_data',
      'Veranstaltungsdaten',
      'event_form_render',
      'events',
      'normal',
      'high'
  );
}
function event_form_render() {
  global $post;

  $currentDate = new DateTime();
  $post_meta = get_post_meta($post->ID);

  ?>

  <div class="notice-info error" style="display: none;" id="errorDateTime">
    <p><strong>Bitte überprüfe die Angaben zu Veranstaltungsdatum und -zeit.</strong></p>
  </div>

  <div style="display: grid; grid-template-columns: 150px auto; grid-gap: 10px;">
    <label for="metaInputEventDateStart" style="width: 100%; margin: 10px 5px;"><strong>Beginn</strong></label>
    <div>
      <input type="date" id="metaInputEventDateStart" name="date_start" value="<?php echo isset($post_meta['date_start'][0]) ? $post_meta['date_start'][0] : $currentDate->format('Y-m-d'); ?>" onchange="validateTimeDateEnd()"/>
      <input type="time" id="metaInputEventTimeStart" name="time_start" value="<?php echo isset($post_meta['time_start'][0]) ? $post_meta['time_start'][0] : '' ?>" onchange="validateTimeDateEnd()"/>
    </div>

    <label for="metaInputEventDateEnd" style="width: 100%; margin: 10px 5px;"><strong>Ende</strong></label>
    <div>
      <input type="date" id="metaInputEventDateEnd" name="date_end" value="<?php echo isset($post_meta['date_end'][0]) ? $post_meta['date_end'][0] : '' ?>" onchange="validateTimeDateEnd()"/>
      <input type="time" id="metaInputEventTimeEnd" name="time_end" value="<?php echo isset($post_meta['time_end'][0]) ? $post_meta['time_end'][0] : '' ?>" onchange="validateTimeDateEnd()"/>
    </div>

    <div>&nbsp;</div><div>&nbsp;</div>

    <label for="metaInputEventLocation" style="width: 100%; margin: 10px 5px;"><strong>Veranstaltungsort</strong></label>
    <input type="text" id="metaInputEventLocation" name="location" value="<?php echo isset($post_meta['location'][0]) ? $post_meta['location'][0] : ''; ?>"/>

    <label for="metaInputEventMaps" style="width: 100%; margin: 10px 5px;">
      <input type="checkbox" value="1" id="metaInputEventMaps" name="link_to_maps" onchange="toggleLinkBox()" <?php if (isset($post_meta['link_to_maps']) && $post_meta['link_to_maps'][0] === '1') { echo 'checked'; } ?>/>
      <strong>Google Maps-Link anzeigen</strong>
    </label>
    <p>
      Die Veranstaltungslocation wird automatisch auf einen Google Maps Treffer verlinkt. <em>Es wird empfohlen, diesen Link zu testen!</em>
    </p>

    <label for="metaInputEventLink" style="width: 100%; margin: 10px 5px;"><strong>Veranstaltungslink</strong></label>
    <input type="url" id="metaInputEventLink" name="event_link" value="<?php echo isset($post_meta['event_link'][0]) ? $post_meta['event_link'][0] : ''; ?>"/>

    <div>&nbsp;</div><div>&nbsp;</div>

    <label style="width: 100%; margin: 10px 5px;"><strong>Beschreibung</strong></label>
    <?php wp_editor(
      wpautop(isset($post_meta['event_desc'][0]) ? $post_meta['event_desc'][0] : ''),
      'event_desc',
      array(
        'wpautop' => false,
        'textarea_rows' => '8',
      )
    ); ?>

    <div>&nbsp;</div><div>&nbsp;</div>

    <label for="metaInputEventLarge" style="width: 100%; margin: 10px 5px;">
      <input type="checkbox" value="1" id="metaInputEventLarge" name="large_event" <?php if ((isset($post_meta['large_event']) && $post_meta['large_event'][0] === '1') || !isset($post_meta['large_event'])) { echo 'checked'; } ?>/>
      <strong>Veranstaltungsseite erstellen</strong>
    </label>
    <p>
      Diese Veranstaltung soll eine eigene Unterseite für mehr Informationen bekommen. Dadurch wird der Beschreibungstext nach dem Weiterlesen-Tag erst auf der Unterseite angezeigt. <br>
      <a href="<?php menu_page_url('help_events'); ?>#large_event" target="_blank">Mehr Informationen in der Hilfe</a>
    </p>

  </div>

  <script type="text/javascript">
    jQuery(document).ready(function() {
      toggleLinkBox();
    });

    function toggleLinkBox() {
      if (jQuery('#metaInputEventMaps').prop('checked')) {
        jQuery('#metaInputEventLink').hide();
        jQuery('label[for="metaInputEventLink"]').hide();
      } else {
        jQuery('#metaInputEventLink').show();
        jQuery('label[for="metaInputEventLink"]').show();
      }
    }

    function validateTimeDateEnd() {
      if (new Date(jQuery('#metaInputEventDateStart').val() + ' ' + jQuery('#metaInputEventTimeStart').val())
          > new Date(jQuery('#metaInputEventDateEnd').val() + ' ' + jQuery('#metaInputEventTimeEnd').val())) {
        jQuery('#publish').prop("disabled", true);
        jQuery('#errorDateTime').show();
      } else {
        jQuery('#publish').prop("disabled", false);
        jQuery('#errorDateTime').hide();
      }
    }
  </script>

  <?php
}
add_action('add_meta_boxes_' . 'events', 'adding_events_meta_boxes');

function register_taxonomy_calendar() {
   $labels = array(
     'name'              => 'Kalender',
     'singular_name'     => 'Kalender',
     'search_items'      => 'Kalender suchen',
     'all_items'         => 'Alle Kalender',
     'edit_item'         => 'Kalender bearbeiten',
     'update_item'       => 'Kalender aktualisieren',
     'add_new_item'      => 'Kalender hinzufügen',
     'new_item_name'     => 'Kalendername',
     'menu_name'         => 'Kalender',
   );
   $args   = array(
     'hierarchical'      => true,
     'labels'            => $labels,
     'show_ui'           => true,
     'show_admin_column' => true,
     'show_in_nav_menus' => false,
     'query_var'         => true,
     'rewrite'           => ['slug' => 'calendar'],
   );
   register_taxonomy('calendar', ['events'], $args);
}
add_action('init', 'register_taxonomy_calendar');

function calendar_add_color_select($taxonomy) {
  ?>
    <div class="form-field">
      <label for="calendarcolor">Kalenderfarbe</label>
      <select name="calendarcolor">
        <option value="default" selected>Standard</option>
        <option value="pink" style="background-color: #A4005A; color: #FFFFFF;">Violett</option>
        <option value="magenta" style="background-color: #52002D; color: #FFFFFF;">Dunkles Magenta</option>
        <option value="dark-blue" style="background-color: #003852; color: #FFFFFF;">Dunkelblau</option>
        <option value="blue" style="background-color: #0071A4; color: #FFFFFF;">Blau</option>
        <option value="turquoise" style="background-color: #00ABAE; color: #FFFFFF;">Türkis</option>
        <option value="yellow" style="background-color: #FFED00; color: #232323;">Gelb</option>
        <option value="grey" style="background-color: #555555; color: #FFFFFF;">Grau</option>
      </select>
    </div>
  <?php
}
function calendar_edit_color_select($term, $taxonomy) {
  $value = get_term_meta($term->term_id, 'calendarcolor', true);
  ?>
    <table class="form-table">
      <tr class="form-field">
        <th><label for="calendarcolor">Kalenderfarbe</label></th>
        <td>
          <select name="calendarcolor">
            <option value="default" <?php echo $value == 'default' ? 'selected' : ''; ?>>Standard</option>
            <option value="pink" style="background-color: #A4005A; color: #FFFFFF;" <?php echo $value == 'pink' ? 'selected' : ''; ?>>Violett</option>
            <option value="magenta" style="background-color: #52002D; color: #FFFFFF;" <?php echo $value == 'magenta' ? 'selected' : ''; ?>>Dunkles Magenta</option>
            <option value="dark-blue" style="background-color: #003852; color: #FFFFFF;" <?php echo $value == 'dark-blue' ? 'selected' : ''; ?>>Dunkelblau</option>
            <option value="blue" style="background-color: #0071A4; color: #FFFFFF;" <?php echo $value == 'blue' ? 'selected' : ''; ?>>Blau</option>
            <option value="turquoise" style="background-color: #00ABAE; color: #FFFFFF;" <?php echo $value == 'turquoise' ? 'selected' : ''; ?>>Türkis</option>
            <option value="yellow" style="background-color: #FFED00; color: #555555;" <?php echo $value == 'yellow' ? 'selected' : ''; ?>>Gelb</option>
            <option value="grey" style="background-color: #555555; color: #FFFFFF;" <?php echo $value == 'grey' ? 'selected' : ''; ?>>Grau</option>
          </select>
        </td>
      </tr>
    </table>
  <?php
}
add_action('calendar_add_form_fields', 'calendar_add_color_select');
add_action('calendar_edit_form_fields', 'calendar_edit_color_select', 10, 2);

function calendar_save_color_select($term_id) {
  update_term_meta($term_id, 'calendarcolor', sanitize_text_field($_POST['calendarcolor']));
}
add_action('created_calendar', 'calendar_save_color_select');
add_action('edited_calendar', 'calendar_save_color_select');


function calendar_shorttag_func() {
  include('calendar/calendar.php');
  getCalendar();
}
add_shortcode('calendar', 'calendar_shorttag_func');


/* AJAX responder */

function calendar_switch(){
  $date = explode('-', $_POST['date']);

  include_once('calendar/calendar.php');
  echo getCalendar($date[1], $date[0]);

  exit();
}
add_action('wp_ajax_calendarswitch', 'calendar_switch');
add_action('wp_ajax_nopriv_calendarswitch', 'calendar_switch');



/*-----------------------------------------------
  Resolutions
-----------------------------------------------*/

function post_type_resolutions() {
  register_post_type('resolutions', array(
    'labels' => array(
      'name' => 'Beschlüsse',
      'singular_name' => 'Beschluss',
      'menu_name' => 'Beschlüsse',
      'parent_item_colon' => 'Übergeordneter Beschluss',
      'all_items' => 'Beschlüsse',
      'view_item' => 'Beschluss anzeigen',
      'add_new_item' => 'Beschluss erstellen',
      'add_new' => 'Erstellen',
      'edit_item' => 'Beschluss bearbeiten',
      'update_item' => 'Beschluss aktualisieren',
      'search_items' => 'Beschluss suchen',
      'not_found' => 'Keine Beschlüsse gefunden.',
      'not_found_in_trash' => 'Keine Beschlüsse im Papierkorb gefunden',
    ),
    'public' => true,
    'exclude_from_search' => true,
    'menu_icon' => 'dashicons-text-page',
    'has_archive' => true,
    'show_in_nav_menus' => true,
    'taxonomies' => array('applicants', 'assembly', 'resolutiontags'),
    'supports' => array('title', 'editor'),
  ));
}
add_action('init', 'post_type_resolutions');

function register_taxonomy_applicants() {
  $labels = array(
    'name'              => 'Antragsteller',
    'singular_name'     => 'Antragsteller',
    'search_items'      => 'Antragsteller suchen',
    'all_items'         => 'Alle Antragsteller',
    'edit_item'         => 'Antragsteller bearbeiten',
    'update_item'       => 'Antragsteller aktualisieren',
    'add_new_item'      => 'Antragsteller hinzufügen',
    'new_item_name'     => 'Antragsteller',
    'separate_items_with_commas' => 'Antragsteller mit Kommas trennen',
    'choose_from_most_used' => 'Meist verwendete Antragsteller',
    'menu_name'         => 'Antragsteller',
  );
  $args   = array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'query_var'         => true,
    'rewrite'           => ['slug' => 'applicants'],
  );
  register_taxonomy('applicants', ['resolutions'], $args);
}
add_action('init', 'register_taxonomy_applicants');

function register_taxonomy_assembly() {
   $labels = array(
     'name'              => 'Versammlungen',
     'singular_name'     => 'Versammlung',
     'search_items'      => 'Versammlung suchen',
     'all_items'         => 'Alle Versammlungen',
     'edit_item'         => 'Versammlung bearbeiten',
     'update_item'       => 'Versammlung aktualisieren',
     'add_new_item'      => 'Versammlung hinzufügen',
     'new_item_name'     => 'Versammlungsname',
     'menu_name'         => 'Versammlungen',
   );
   $args   = array(
     'hierarchical'      => true,
     'labels'            => $labels,
     'show_ui'           => true,
     'show_admin_column' => true,
     'show_in_nav_menus' => false,
     'query_var'         => true,
     'rewrite'           => ['slug' => 'assembly'],
   );
   register_taxonomy('assembly', ['resolutions'], $args);
}
add_action('init', 'register_taxonomy_assembly');

function register_taxonomy_resolutiontags() {
   $labels = array(
     'name'              => 'Schlagworte',
     'singular_name'     => 'Schlagwort',
     'search_items'      => 'Schlagwort suchen',
     'all_items'         => 'Alle Schlagworte',
     'edit_item'         => 'Schlagwort bearbeiten',
     'update_item'       => 'Schlagwort aktualisieren',
     'add_new_item'      => 'Schlagwort hinzufügen',
     'new_item_name'     => 'Schlagwort',
     'menu_name'         => 'Schlagworte',
   );
   $args   = array(
     'hierarchical'      => false,
     'labels'            => $labels,
     'show_ui'           => true,
     'show_admin_column' => true,
     'show_in_nav_menus' => false,
     'query_var'         => true,
     'rewrite'           => ['slug' => 'resolutiontags'],
   );
   register_taxonomy('resolutiontags', ['resolutions'], $args);
}
add_action('init', 'register_taxonomy_resolutiontags');


function add_resolutions_meta() {
  add_meta_box(
      'resolutions_meta',
      'Weitere Einstellungen',
      'resolutions_meta_render',
      'resolutions',
      'side',
      'default'
  );
}
function resolutions_meta_render() {
  global $post;

  $post_meta = get_post_meta($post->ID);

  ?>
  <label style="margin-bottom: 10px; display: inline-block; font-weight: bold;">Beschlussstatus</label>
  <select name="resolution_status" id="metaResolutionStatus" style="display: block; width: 100%; box-sizing: border-box;">
    <option value="auto" <?php echo isset($post_meta['resolution_status']) && $post_meta['resolution_status'][0] == 'auto' ? 'selected' : ''; ?>>Automatisch</option>
    <option value="normal" <?php echo isset($post_meta['resolution_status']) && $post_meta['resolution_status'][0] == 'normal' ? 'selected' : ''; ?>>Gültig</option>
    <option value="expired" <?php echo isset($post_meta['resolution_status']) && $post_meta['resolution_status'][0] == 'expired' ? 'selected' : ''; ?>>Abgelaufen</option>
  </select>
  <p>In der Einstellung "Automatisch" wird der Beschluss automatisch als abgelaufen angezeigt, wenn die Gültigkeitsdauer (bezogen auf das Veröffentlichungsdatum) verstrichen ist.</p>
  <br>
  <label style="margin-bottom: 10px; display: inline-block; font-weight: bold;">Gültigkeitsdauer (Sunset)</label><br>
  <input value="<?php echo isset($post_meta['resolution_sunset']) ? $post_meta['resolution_sunset'][0] : '' ?>" name="resolution_sunset" type="number" min="1" id="metaResolutionSunset" style="display: inline-block; width: 50px; box-sizing: border-box;"> Jahr(e)
  <?php
}
add_action('add_meta_boxes_' . 'resolutions', 'add_resolutions_meta');


/* AJAX responder */

function resolution_filter() {
  $args = array(
    'orderby' => 'date',
    'post_type' => array('resolutions'),
    'paged' => $_POST['page_number'] ?? 0,
  );

  $args['tax_query'] = array('relation' => 'AND');

  if (isset($_POST['applicants']) && $_POST['applicants'] != 'all') {
    $args['tax_query'] = array_merge($args['tax_query'], array(
      array(
        'taxonomy' => 'applicants',
        'field' => 'id',
        'terms' => $_POST['applicants']
      )
    ));
  }

  if (isset($_POST['assembly']) && $_POST['assembly'] != 'all') {
    $args['tax_query'] = array_merge($args['tax_query'], array(
      array(
        'taxonomy' => 'assembly',
        'field' => 'id',
        'terms' => $_POST['assembly']
      )
    ));
  }

  if (isset($_POST['tags']) && $_POST['tags'] != 'all') {
    $args['tax_query'] = array_merge($args['tax_query'], array(
      array(
        'taxonomy' => 'resolutiontags',
        'field' => 'id',
        'terms' => $_POST['tags']
      )
    ));
  }

  if (get_theme_mod('hide_expired_resolutions', false) && !is_user_logged_in()) {
    $args['meta_query'] = array(
      'relation' => 'OR',
      array(
        'key' => 'resolution_status',
        'value' => 'expired',
        'compare' => '!=',
      ),
      array(
        'key' => 'resolution_status',
        'compare' => 'NOT EXISTS'
      ),
    );
  }

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();

      get_template_part('inc/post_templates/content-resolutions');
    }
  } else {
    echo "endOfPosts";
  }

  die();
}
add_action('wp_ajax_resolutionfilter', 'resolution_filter');
add_action('wp_ajax_nopriv_resolutionfilter', 'resolution_filter');

function resolution_search(){
  $args = array(
    'orderby' => 'date',
    'post_type' => array('resolutions'),
    's' => $_POST['search'],
    'paged' => $_POST['page_number'] ?? 0,
  );

  if (get_theme_mod('hide_expired_resolutions', false) && !is_user_logged_in()) {
    $args['meta_query'] = array(
      'relation' => 'OR',
      array(
        'key' => 'resolution_status',
        'value' => 'expired',
        'compare' => '!=',
      ),
      array(
        'key' => 'resolution_status',
        'compare' => 'NOT EXISTS'
      ),
    );
  }

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();

      get_template_part('inc/post_templates/content-resolutions');
    }
  } else {
    echo "endOfPosts";
  }

  die();
}
add_action('wp_ajax_resolutionsearch', 'resolution_search');
add_action('wp_ajax_nopriv_resolutionsearch', 'resolution_search');


/*-----------------------------------------------
  Post type save function
-----------------------------------------------*/

function save_metabox($post_id) {
  //reset checkboxes
  delete_post_meta($post_id, 'link_to_maps', '1');
  delete_post_meta($post_id, 'large_event', '1');

  foreach ($_POST as $key => $value) {
    update_post_meta($post_id, $key, $value);
  }
}
add_action('save_post', 'save_metabox');

?>
