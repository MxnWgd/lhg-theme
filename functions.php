<?php
  define('CHECK_UPDATE_URL', 'https://bundes-lhg.de/');


  /*---------------------------------------------
    General functions
  ---------------------------------------------*/

  function lhg_theme_enqueue() {
    wp_enqueue_style('customstyle', get_template_directory_uri() . '/style.css', array(), '', 'all');
  }
  add_action('wp_enqueue_scripts', 'lhg_theme_enqueue');

  function lhg_script_enqueue() {
      wp_enqueue_script('customjs', get_template_directory_uri() . '/js/script.js', array('jquery'), '', true);
  }
  add_action('wp_enqueue_scripts', 'lhg_script_enqueue');

  add_action('enqueue_block_editor_assets', function() {
    wp_enqueue_style('lhg-custom-block-editor-styles', get_theme_file_uri( "/inc/editor-style.css" ), false, wp_get_theme()->get('Version'));
  });


  /* Turn off notification mails for updates */
  add_filter('auto_plugin_update_send_email', '__return_false');
  add_filter('auto_core_update_send_email', 'wpb_stop_auto_update_emails', 10, 4);
  function wpb_stop_update_emails($send, $type, $core_update, $result) {
    if (!empty($type) && $type == 'success') {
      return false;
    }
    return true;
  }


  /*-----------------------------------------------
    Additional post types & pages
  -----------------------------------------------*/

  /* Post types */
  require_once(get_template_directory() . '/inc/post-types.php');


  /* Help page */
  function help_page_menu() {
    add_menu_page('Hilfe', 'Hilfe', 'read', 'help', 'help_page', 'dashicons-editor-help', 35);
    add_submenu_page('help', 'Beiträge & Seiten', 'Beiträge & Seiten', 'read', 'help_pages', 'help_pages_page');
    add_submenu_page('help', 'Personen', 'Personen', 'read', 'help_persons', 'help_persons_page');
    add_submenu_page('help', 'Veranstaltungen', 'Veranstaltungen', 'read', 'help_events', 'help_events_page');
    add_submenu_page('help', 'Beschlusssammlung', 'Beschlusssammlung', 'read', 'help_resolutions', 'help_resolutions_page');
    add_submenu_page('help', 'Themeeinstellungen', 'Themeeinstellungen', 'read', 'help_settings', 'help_settings_page');
    add_submenu_page('help', 'Support', 'Support', 'read', 'help_support', 'help_support_page');
  }
  function help_page() {
    include_once(get_template_directory() . '/inc/help/help.php');
  }
  function help_persons_page() {
    include_once(get_template_directory() . '/inc/help/help_persons.php');
  }
  function help_pages_page() {
    include_once(get_template_directory() . '/inc/help/help_pages.php');
  }
  function help_events_page() {
    include_once(get_template_directory() . '/inc/help/help_events.php');
  }
  function help_resolutions_page() {
    include_once(get_template_directory() . '/inc/help/help_resolutions.php');
  }
  function help_settings_page() {
    include_once(get_template_directory() . '/inc/help/help_settings.php');
  }
  function help_support_page() {
    include_once(get_template_directory() . '/inc/help/help_support.php');
  }
  add_action('admin_menu', 'help_page_menu');


  function ensure_metaboxes_visible($user_id) {
    $hidden_metaboxes = array();
    update_user_option($user_id, 'metaboxhidden_nav-menus', $hidden_metaboxes);
  }
  add_action('admin_init', 'ensure_metaboxes_visible', 10, 1);


  /*---------------------------------------------
    Theme support
  ---------------------------------------------*/

  function lhg_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
      'height' => 150,
      'width' => 600,
      'flex-height' => true,
      'flex-width' => true,
    ));

    register_nav_menu('primary', 'Hauptmenü');
    register_nav_menu('secondary', 'Kleines Zusatzmenü im Header und Footer');
  }

  add_action('after_setup_theme', 'lhg_theme_setup');


  /* Add featured image position feature */
  function add_featured_image_position_post() {
    add_meta_box(
        'featured_image_position',
        'Position des Beitragsbildes',
        'featured_image_position_render',
        'post',
        'side',
        'high'
    );
  }
  function add_featured_image_position_page() {
    add_meta_box(
        'featured_image_position',
        'Position des Beitragsbildes',
        'featured_image_position_render',
        'page',
        'side',
        'high'
    );
  }
  function featured_image_position_render() {
    global $post;

    $post_meta = get_post_meta($post->ID);

    ?>
    <label style="margin-bottom: 10px; display: inline-block;">Hier kannst du angeben, wie das Beitragsbild im Header positioniert werden soll.</label>
    <select name="featured_image_position" id="metaFeaturedImagePosition" style="display: block; width: 100%; box-sizing: border-box;">
      <option value="center" <?php echo isset($post_meta['featured_image_position']) && $post_meta['featured_image_position'][0] == 'center' ? 'selected' : ''; ?>>Mittig ausgerichtet (Standard)</option>
      <option value="top" <?php echo isset($post_meta['featured_image_position']) && $post_meta['featured_image_position'][0] == 'top' ? 'selected' : ''; ?>>Oben ausgerichtet</option>
      <option value="bottom" <?php echo isset($post_meta['featured_image_position']) && $post_meta['featured_image_position'][0] == 'bottom' ? 'selected' : ''; ?>>Unten ausgerichtet</option>
    </select>
    <?php
  }
  add_action('add_meta_boxes_' . 'post', 'add_featured_image_position_post');
  add_action('add_meta_boxes_' . 'page', 'add_featured_image_position_page');


  /*-----------------------------------------------
    Theme Customizer
  -----------------------------------------------*/

  require_once(get_template_directory() . '/customize/customize.php');


  /* Theme settings page */
  function theme_settings_page() {
    add_menu_page(
      'Themeeinstellungen',
      'Theme-einstellungen',
      'manage_options',
      'theme_settings',
      function () {
        ?>
          <h2>Alle Themeeinstellungen findest du <a href="<?php echo wp_customize_url(); ?>" title="Link zum Customizer">im Customizer</a>.</h2>
        <?php
      },
      'dashicons-admin-generic',
      36
    );
  }
  add_action('admin_menu', 'theme_settings_page');


  /*-----------------------------------------------
    Warnings
  -----------------------------------------------*/

  /* Maintenance mode redirect & warning */
  function maintenance_mode_redirect() {
    global $wp;

    if (get_theme_mod('maintenance_mode', true) && !is_user_logged_in()) {
      get_template_part('inc/maintenance');
      exit;
    }
  }
  add_action('template_redirect', 'maintenance_mode_redirect');
  function maintenance_mode_warning() {
    if (is_admin() && get_theme_mod('maintenance_mode', true)) {
      ?>
      <div class="notice-info error">
        <p>Der <strong>Wartungsmodus</strong> ist momentan aktiviert. Dadurch können normale Websitebesucher die Inhalte deiner Seite nicht sehen. Bitte denke daran, den Wartungsmodus im <?php $query['autofocus[section]'] = 'maintenance_mode_options'; ?><a href="<?php echo esc_url(add_query_arg($query, admin_url('customize.php'))); ?>">Customizer</a> zu deaktivieren, sobald er nicht mehr benötigt wird.</p>
      </div>
      <?php
    }
  }
  add_action('admin_notices', 'maintenance_mode_warning');


  /* Data protection page warning */
  function no_data_protection_page_warning() {
    if (get_theme_mod('data_protection_page', '0') === '0' && !get_theme_mod('disable_data_protection_warning', false)) { ?>
      <div class="notice-warning notice is-dismissible" id="lhgDataProtectionWarning">
        <button
          type="button"
          class="notice-dismiss"
          onclick="jQuery.post(ajaxurl, { 'action': 'disable_data_protection_warning' }, function(response) {
    					jQuery('#lhgDataProtectionWarning').hide();
    				});"
          >
          <span class="screen-reader-text">Diese Meldung ausblenden.</span>
        </button>

        <p>Du hast derzeit keine Seite als Datenschutzerklärung festgelegt. Wir empfehlen dir <strong>dringend</strong>, dies in den Themeeinstellungen im <?php $query['autofocus[control]'] = 'data_protection_page_control'; ?><a href="<?php echo esc_url(add_query_arg($query, admin_url('customize.php'))); ?>">Customizer</a> zu tun.</p>
      </div>
    <?php }
  }
  add_action('admin_notices', 'no_data_protection_page_warning');

  function disable_data_protection_warning() {
    set_theme_mod('disable_data_protection_warning', true);
  }
  add_action('wp_ajax_disable_data_protection_warning', 'disable_data_protection_warning');
  add_action('wp_ajax_nopriv_disable_data_protection_warning', 'disable_data_protection_warning');
  function enable_data_protection_warning() {
    if (get_theme_mod('data_protection_page', '0') !== '0') {
      set_theme_mod('disable_data_protection_warning', false);
    }
  }
  add_action('customize_save_after', 'enable_data_protection_warning');


  /* No logo set warning */
  function no_logo_set_warning() {
    if (!has_custom_logo() && !get_theme_mod('disable_missing_logo_warning', false)) { ?>
      <div class="notice-warning error notice is-dismissible" id="lhgMissingLogoWarning">
        <button
          type="button"
          class="notice-dismiss"
          onclick="jQuery.post(ajaxurl, { 'action': 'disable_missing_logo_warning' }, function(response) {
    					jQuery('#lhgMissingLogoWarning').hide();
    				});"
          >
          <span class="screen-reader-text">Diese Meldung ausblenden.</span>
        </button>

        <p>Du hast momentan kein Logo für eure Website festgelegt. Wir empfehlen dir dringend, das LHG-Logo deiner Gruppe im <?php $query['autofocus[section]'] = 'title_tagline'; ?><a href="<?php echo esc_url(add_query_arg($query, admin_url('customize.php'))); ?>">Customizer</a> einzurichten. Alle Logos für LHGs findest du in der <a href="https://bundeslhg.sharepoint.com/:f:/s/LHG-Cloud/El8w8EVDNRVGnXinyaoHeXABCcRLo85d9WrdHgtlnWeYag?e=JVWK8Z" title="Link zur LHG-Cloud" target="_blank">LHG-Cloud</a>. Sollte deine Gruppe noch kein Logo haben, wende dich gerne an den Bundesvorstand.</p>
      </div>
    <?php }
  }
  add_action('admin_notices', 'no_logo_set_warning');

  function disable_missing_logo_warning() {
    set_theme_mod('disable_missing_logo_warning', true);
  }
  add_action('wp_ajax_disable_missing_logo_warning', 'disable_missing_logo_warning');
  add_action('wp_ajax_nopriv_disable_missing_logo_warning', 'disable_missing_logo_warning');
  function enable_missing_logo_warning() {
    if (has_custom_logo()) {
      set_theme_mod('disable_missing_logo_warning', false);
    }
  }
  add_action('customize_save_after', 'enable_missing_logo_warning');




  /*-----------------------------------------------
    Check for updates
  -----------------------------------------------*/

  function lhg_check_for_update() {
    $lhg_page = file_get_contents(CHECK_UPDATE_URL);

    if (preg_match('/<meta\sname="theme-version"\scontent="(.+)">/', $lhg_page, $version)) {
      return $version[1] === wp_get_theme()->version;
    } else {
      return false;
    }
  }

  function lhg_ajax_check_for_update() {
    print_r(lhg_check_for_update());
    exit();
  }
  add_action('wp_ajax_check_for_update', 'lhg_ajax_check_for_update');
  add_action('wp_ajax_nopriv_check_for_update', 'lhg_ajax_check_for_update');


  /* Notice on update */

  add_action('wp', 'lhg_auto_update_check');
  function lhg_auto_update_check() {
    if (!wp_next_scheduled('lhg_auto_update_event')) {
      wp_schedule_event(time(), 'hourly', 'lhg_auto_update_event');
    }
  }


  add_action('lhg_auto_update_event', 'lhg_auto_update_notice');
  function lhg_auto_update_notice() {
    set_theme_mod('update_available', false);

    if (!lhg_check_for_update()) {
      set_theme_mod('update_available', true);
    }
  }

  function update_notice() {
    if (get_theme_mod('update_available', false)) {
      ?>
      <div class="notice-info notice">
        <p>Ein Update für das LHG-Theme ist möglicherweise verfügbar. Bitte schaue hierzu in die <a href="https://bundeslhg.sharepoint.com/:f:/s/LHG-Cloud/El8w8EVDNRVGnXinyaoHeXABCcRLo85d9WrdHgtlnWeYag?e=JVWK8Z" title="Link zur LHG-Cloud" target="_blank">LHG-Cloud</a> oder wende dich an den <a href="<?php menu_page_url('help_support'); ?>" title="IT-Support">IT-Support</a>. </p>
      </div>
      <?php
    }
  }
  add_action('admin_notices', 'update_notice');


?>
