<?php
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
    wp_enqueue_style('twentytwenty-custom-block-editor-styles', get_theme_file_uri( "/inc/editor-style.css" ), false, wp_get_theme()->get('Version'));
  });



  /*-----------------------------------------------
    Additional post types
  -----------------------------------------------*/

  /* Persons */

  function post_type_persons() {
    register_post_type('persons', array(
      'labels' => array(
        'name' => 'Personen',
        'singular_name' => 'Person',
      ),
      'public' => true,
      'exclude_from_search' => true,
      'menu_icon' => 'dashicons-groups',
      'has_archive' => false,
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
      <textarea rows="8" id="metaInputPersonDescription" name="description"><?php echo isset($post_meta['description'][0]) ? $post_meta['description'][0] : ''; ?></textarea>

      <label for="metaInputPersonMail" style="width: 100%; margin: 10px 5px;"><strong>E-Mail-Adresse</strong></label>
      <input type="email" id="metaInputPersonMail" name="mail" value="<?php echo isset($post_meta['mail'][0]) ? $post_meta['mail'][0] : ''; ?>"/>

      <label for="metaInputPersonFacebook" style="width: 100%; margin: 10px 5px;"><strong>Facebook-Profil</strong></label>
      <input type="url" id="metaInputPersonFacebook" name="facebook" value="<?php echo isset($post_meta['facebook'][0]) ? $post_meta['facebook'][0] : ''; ?>"/>

      <label for="metaInputPersonInstagram" style="width: 100%; margin: 10px 5px;"><strong>Instagram-Account</strong></label>
      <input type="url" id="metaInputPersonInstagram" name="instagram" value="<?php echo isset($post_meta['instagram'][0]) ? $post_meta['instagram'][0] : ''; ?>"/>

      <label for="metaInputPersonTwitter" style="width: 100%; margin: 10px 5px;"><strong>Twitter-Account</strong></label>
      <input type="url" id="metaInputPersonTwitter" name="twitter" value="<?php echo isset($post_meta['twitter'][0]) ? $post_meta['twitter'][0] : ''; ?>"/>
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
  function save_metabox($post_id, $post){
    foreach ($_POST as $key=>$value) {
      update_post_meta($post_id, $key, $value);
    }
  }
  add_action('add_meta_boxes_' . 'persons', 'adding_person_meta_boxes');
  add_action('save_post', 'save_metabox' , 10, 2);


  function persons_shorttag_func($prop) {
    global $post;

    $person = get_post($prop['id']);
    include('inc/post_templates/content-persons.php');
    return $result;
  }
  add_shortcode('person', 'persons_shorttag_func');


  /* Events */
  // TODO

  function events_page_placeholder() {
    add_menu_page('Veranstaltungen', 'Veranstaltungen', 'manage_options', 'events', 'placeholder_page', 'dashicons-calendar-alt', 26);
  }
  add_action('admin_menu', 'events_page_placeholder');


  /* Resolutions */
  // TODO

  function resolution_page_placeholder() {
    add_menu_page('Beschlüsse', 'Beschlüsse', 'manage_options', 'resolutions', 'placeholder_page', 'dashicons-text-page', 27);
  }
  add_action('admin_menu', 'resolution_page_placeholder');





  function placeholder_page() {
    ?><h1>Coming soon</h1><p>Dieses Feature wird derzeit entwickelt und im nächsten Release des Themes nachgereicht. Wir bitten noch um etwas Geduld.</p><?php
  }


  /* Help page */

  function help_page_menu() {
    add_menu_page('Hilfe', 'Hilfe', 'read', 'help', 'help_page', 'dashicons-editor-help', 28);
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


  /*-----------------------------------------------
    Theme Customizer
  -----------------------------------------------*/

  require_once(get_template_directory() . '/customize/customize.php');


?>
