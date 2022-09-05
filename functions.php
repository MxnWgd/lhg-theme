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

  class LHG_Theme_Customize {
    public static function lhg_customize_register($wp_customize) {
      //get categories
      $full_categories_list = get_categories(array('orderby' => 'name',));
      $category_choices = [];

      foreach($full_categories_list as $single_cat) {
        $category_choices[$single_cat->slug] = $single_cat->name;
      }

      //get pages
      $full_pages_list = get_pages();
      $page_choices = [];
      $page_choices[0] = '- Nicht anzeigen -';
      $page_choices_with_external = $page_choices;
      $page_choices_with_external[1] = '- Externe Seite -';

      foreach ($full_pages_list as $single_page) {
        $page_choices[$single_page->ID] = $single_page->post_title;
      }
      $page_choices_with_external += $page_choices;



      $wp_customize->add_section('theme_color_options', array(
        'title' => 'LHG-Farbschema',
        'description' => 'Wähle aus verschiedenen Farbschemata, um die Seite zu individualisieren. Alle Farbschemata sind mit der CI der Liberalen Hochschulgruppen abgestimmt.',
        'priority' => 22,
      ));

      $wp_customize->add_setting('theme_color_option', array(
        'default' => 'magenta',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('theme_color_control', array(
        'settings' => 'theme_color_option',
        'section' => 'theme_color_options',
        'label' => 'Farbschema',
        'type' => 'select',
        'choices' => array(
          'magenta' => 'Magenta',
          'blau' => 'Blau',
          'türkis' => 'Türkis',
          'blau-magenta' => 'Blau-Magenta',
          'gelb*-pink' => 'Gelb-Pink (Gelbe Akzente)',
          'gelb-pink*' => 'Gelb-Pink (Pinke Akzente)',
          'gelb-pink-dark' => 'Gelb-Pink (Dunkler Hintergrund)'
         )
      ));



      $wp_customize->add_section('front_page_options', array(
        'title' => 'Startseiteneinstellungen',
        'description' => 'Lege hier fest, wie die Startseite aussehen soll.',
        'priority' => 22,
      ));

      $wp_customize->add_setting('front_page_news_title', array(
        'default' => 'Neuigkeiten',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('front_page_news_title_control', array(
        'settings' => 'front_page_news_title',
        'section' => 'front_page_options',
        'label' => 'Neuigkeiten',
        'description' => 'Lege fest, wie der Titel des Abschnitts mit den Neuigkeiten lauten wird.',
      ));

      $wp_customize->add_setting('front_page_news_category', array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('front_page_news_category_control', array(
        'settings' => 'front_page_news_category',
        'section' => 'front_page_options',
        'description' => 'Lege fest, welche Beitragskategorie im Neuigkeiten-Abschnitt angezeigt werden soll.',
        'type' => 'select',
        'choices' => $category_choices
      ));

      $wp_customize->add_setting('front_page_additional_area_page', array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('front_page_additional_area_page_control', array(
        'settings' => 'front_page_additional_area_page',
        'section' => 'front_page_options',
        'label' => 'Seite für zusätzlichen Contentbereich',
        'description' => 'Lege fest, welche Seite für den zusätzlichen Inhaltsbereich auf der Startseite verwendet werden soll. Denke daran, dass diese Seite nicht zu viel Inhalt enthalten sollte. Als Hintergrund wird das Beitragsbild der Seite verwendet.',
        'type' => 'select',
        'choices' => $page_choices
      ));

      $wp_customize->add_setting('front_page_additional_area_page_lr', array(
        'default' => 'left',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('front_page_additional_area_page_lr_control', array(
        'settings' => 'front_page_additional_area_page_lr',
        'section' => 'front_page_options',
        'description' => 'Lege fest, ob die Textbox im zusätzlichen Inhaltsbereich links oder rechts ausgerichtet sein soll.',
        'type' => 'select',
        'choices' => array(
          'left' => 'Links',
          'right' => 'Rechts',
        ),
        'active_callback' => function() { return '0' !== get_theme_mod('front_page_additional_area_page'); },
      ));

      $wp_customize->add_setting('front_page_board_list', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('front_page_board_list_control', array(
        'settings' => 'front_page_board_list',
        'section' => 'front_page_options',
        'label' => 'Personenansicht',
        'description' => 'Trage hier die IDs der Personen (durch Komma getrennt) ein, die in der Personenansicht angezeigt werden sollen. Wenn keine ID eingetragen wird, bleibt der Bereich leer.',
      ));

      $wp_customize->add_setting('front_page_board_title', array(
        'default' => 'Vorstand',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('front_page_board_title_control', array(
        'settings' => 'front_page_board_title',
        'section' => 'front_page_options',
        'description' => 'Lege fest, wie der Titel des Abschnitts mit den Personen lauten soll.',
        'active_callback' => function() { return '' !== get_theme_mod('front_page_board_list'); },
      ));

      $wp_customize->add_setting('front_page_board_page', array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('front_page_board_page_control', array(
        'settings' => 'front_page_board_page',
        'section' => 'front_page_options',
        'description' => 'Lege fest, auf welche Seite der Link zum Kompletten Vorstand unterhalb der Personenliste verlinken soll.',
        'type' => 'select',
        'choices' => $page_choices,
        'active_callback' => function() { return '' !== get_theme_mod('front_page_board_list'); },
      ));

      $wp_customize->add_setting('front_page_board_page_link_title', array(
        'default' => 'Kompletter Vorstand',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('front_page_board_page_link_title_control', array(
        'settings' => 'front_page_board_page_link_title',
        'section' => 'front_page_options',
        'description' => 'Titel des Links:',
        'active_callback' => function() { return '0' !== get_theme_mod('front_page_board_page'); },
      ));

      $wp_customize->add_setting('front_page_events', array(
        'default' => 'left',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('front_page_events_control', array(
        'settings' => 'front_page_events',
        'section' => 'front_page_options',
        'label' => 'Termine anzeigen',
        'description' => '[coming soon]',
        'type' => 'checkbox',
      ));



      $wp_customize->add_section('sm_options', array(
        'title' => 'Social-Media-Icons',
        'description' => 'Hier können Links zu Social-Media-Profilen eingefügt werden. Bleibt ein Feld leer, wird kein Symbol für das Social-Media-Netzwerk angezeigt.',
        'priority' => 101,
      ));

      $wp_customize->add_setting('sm_facebook_url', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('sm_facebook_url_option', array(
        'settings' => 'sm_facebook_url',
        'section' => 'sm_options',
        'label' => 'Facebook',
        'description' => 'Hier kannst du den Link zum Facebookprofil eintragen.',
      ));

      $wp_customize->add_setting('sm_insta_url', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('sm_insta_url_option', array(
        'settings' => 'sm_insta_url',
        'section' => 'sm_options',
        'label' => 'Instagram',
        'description' => 'Hier kannst du den Link zum Instagramprofil eintragen.',
      ));

      $wp_customize->add_setting('sm_twitter_url', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('sm_twitter_url_option', array(
        'settings' => 'sm_twitter_url',
        'section' => 'sm_options',
        'label' => 'Twitter',
        'description' => 'Hier kannst du den Link zum Twitterprofil eintragen.',
      ));

      $wp_customize->add_setting('sm_youtube_url', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('sm_youtube_url_option', array(
        'settings' => 'sm_youtube_url',
        'section' => 'sm_options',
        'label' => 'YouTube',
        'description' => 'Hier kannst du den Link zum Youtube-Kanal eintragen.',
      ));



      $wp_customize->add_section('flyout_options', array(
        'title' => 'Flyout-Einstellungen',
        'description' => 'Hier kannst du einstellen, ob und mit welchen Elementen das Flyout angezeigt werden soll.',
        'priority' => 102,
      ));

      $wp_customize->add_setting('show_flyout', array(
        'default' => false,
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('show_flyout_control', array(
        'settings' => 'show_flyout',
        'section' => 'flyout_options',
        'label' => 'Flyout anzeigen',
        'type' => 'checkbox',
      ));

      $wp_customize->add_setting('flyout_donations_page', array(
        'default' => '1',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('flyout_donations_page_control', array(
        'settings' => 'flyout_donations_page',
        'section' => 'flyout_options',
        'label' => 'Spenden-Button',
        'description' => 'Lege fest, auf welche Seite der Spenden-Button verlinken soll oder blende ihn aus.',
        'type' => 'select',
        'choices' => $page_choices_with_external,
        'active_callback' => function() { return true === get_theme_mod('show_flyout'); },
      ));

      $wp_customize->add_setting('flyout_donations_external_page', array(
        'default' => 'https://liberale-hochschulgruppen.de/kontakt/spendenkonto/',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('flyout_donations_external_page_control', array(
        'settings' => 'flyout_donations_external_page',
        'section' => 'flyout_options',
        'description' => 'URL zur externen Seite',
        'active_callback' => function() { return true === get_theme_mod('show_flyout') && '1' === get_theme_mod('flyout_donations_page'); },
      ));

      $wp_customize->add_setting('flyout_newsletter_page', array(
        'default' => '1',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('flyout_newsletter_page_control', array(
        'settings' => 'flyout_newsletter_page',
        'section' => 'flyout_options',
        'label' => 'Newsletter-Button',
        'description' => 'Lege fest, auf welche Seite der Newsletter-Button verlinken soll oder blende ihn aus.',
        'type' => 'select',
        'choices' => $page_choices_with_external,
        'active_callback' => function() { return true === get_theme_mod('show_flyout'); },
      ));

      $wp_customize->add_setting('flyout_newsletter_external_page', array(
        'default' => 'https://news.liberale-hochschulgruppen.de/lists/?p=subscribe&id=1',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('flyout_newsletter_external_page_control', array(
        'settings' => 'flyout_newsletter_external_page',
        'section' => 'flyout_options',
        'description' => 'URL zur externen Seite',
        'active_callback' => function() { return true === get_theme_mod('show_flyout') && '1' === get_theme_mod('flyout_newsletter_page'); },
      ));


      $wp_customize->add_setting('flyout_membership_page', array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('flyout_membership_page_control', array(
        'settings' => 'flyout_membership_page',
        'section' => 'flyout_options',
        'label' => 'Mitglied-werden-Button',
        'description' => 'Lege fest, auf welche Seite der Mitglied-werden-Button verlinken soll oder blende ihn aus.',
        'type' => 'select',
        'choices' => $page_choices,
        'active_callback' => function() { return true === get_theme_mod('show_flyout'); },
      ));

      $wp_customize->add_setting('flyout_contact_page', array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('flyout_contact_page_control', array(
        'settings' => 'flyout_contact_page',
        'section' => 'flyout_options',
        'label' => 'Kontakt-Button',
        'description' => 'Lege fest, auf welche Seite der Kontakt-Button verlinken soll oder blende ihn aus.',
        'type' => 'select',
        'choices' => $page_choices,
        'active_callback' => function() { return true === get_theme_mod('show_flyout'); },
      ));



      $wp_customize->add_section('more_options', array(
        'title' => 'Weitere Themeeinstellungen',
        'description' => 'Hier kannst du weitere Themeeinstellungen vornehmen',
        'priority' => 103,
      ));

      $wp_customize->add_setting('data_protection_page', array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('data_protection_page_control', array(
        'settings' => 'data_protection_page',
        'section' => 'more_options',
        'label' => 'Seite für Datenschutzerklärung',
        'description' => 'Lege fest, auf welcher Seite die Datenschutzerklärung liegt. Dies wird bspw. für die Verlinkung im Cookie-Hinweis verwendet. Zudem wird diese Seite auch ohne Cookie-Bestätigung lesbar sein.',
        'type' => 'select',
        'choices' => $page_choices,
      ));

      $wp_customize->add_setting('data_protection_page_in_menu', array(
        'default' => 'left',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('data_protection_page_in_menu_control', array(
        'settings' => 'data_protection_page_in_menu',
        'section' => 'more_options',
        'label' => 'Datenschutzerklärung im Zusatzmenü im Footer anzeigen.',
        'type' => 'checkbox',
        'active_callback' => function() { return '0' !== get_theme_mod('data_protection_page'); },
      ));

      $wp_customize->add_setting('show_sos_icon', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('show_sos_icon_control', array(
        'settings' => 'show_sos_icon',
        'section' => 'more_options',
        'label' => 'SOS-Link im Zusatzmenü im Footer anzeigen',
        'type' => 'checkbox',
      ));

      $wp_customize->add_setting('remove_footer_branding', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('remove_footer_branding_control', array(
        'settings' => 'remove_footer_branding',
        'section' => 'more_options',
        'label' => 'Branding im Footer entfernen',
        'type' => 'checkbox',
      ));



      $wp_customize->add_section('header_slider_section', array(
         'title'=> 'Header-Einstellungen',
         'description' => 'Hier kannst du einstellen, was im Header auf der Startseite angezeigt wird.',
         'priority' => 21
      ));

      $wp_customize->add_setting('header_slider_mode', array(
        'default' => '0',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('header_slider_mode_control', array(
        'settings' => 'header_slider_mode',
        'section' => 'header_slider_section',
        'label' => 'Header-Modus',
        'description' => 'Wähle, ob im Header ein statisches Bild, ein Video oder eine Slideshow angezeigt werden soll.',
        'type' => 'select',
        'choices' => array(
          '0' => 'Bild',
          '1' => 'Video',
          '2' => 'Slideshow',
        )
      ));

      $wp_customize->add_setting('header_slider_video', array(
          'default'   => array(),
          'transport' => 'refresh',
      ));

      $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'header_slider_video', array(
          'section' => 'header_slider_section',
          'label' => 'Video',
          'description' => 'Lege das Video für den Header auf der Startseite fest. Auf anderen Unterseiten wird das unten festgelegte Bild angezeigt.',
          'mime_type' => 'video',
          'active_callback' => function() { return '1' === get_theme_mod('header_slider_mode'); },
        )
      ));

      $wp_customize->add_setting('header_slider_image', array(
        'default'   => array(),
        'transport' => 'refresh',
      ));

      $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'header_slider_image', array(
          'section' => 'header_slider_section',
          'label' => 'Bild',
          'mime_type' => 'image',
          'active_callback' => function() { return '0' === get_theme_mod('header_slider_mode') || '1' === get_theme_mod('header_slider_mode'); },
        )
      ));

      $wp_customize->add_setting('header_slider_carousel', array(
        'default'   => array(),
        'transport' => 'refresh',
      ));

      $wp_customize->add_control(new Multi_Image_Selector($wp_customize, 'header_slider_carousel', array(
          'section'  => 'header_slider_section',
          'active_callback' => function() { return '2' === get_theme_mod('header_slider_mode'); },
        )
      ));
    }
  }

  add_action('customize_register', array('LHG_Theme_Customize', 'lhg_customize_register'));

  function no_data_protection_page_warning() {
    if (get_theme_mod('data_protection_page') === '0') { ?>
      <div class="notice-warning notice">
        <p>Du hast derzeit keine Seite als Datenschutzerklärung festgelegt. Wir empfehlen dir <strong>dringend</strong>, dies in den Themeeinstellungen im <a href="<?php echo wp_customize_url(); ?>" title="Link zum Customizer">Customizer</a> zu tun.</p>
      </div>
    <?php }
  }
  add_action('admin_notices', 'no_data_protection_page_warning');


  if (!class_exists('WP_Customize_Image_Control')) {
    return null;
  }

  class Multi_Image_Selector extends WP_Customize_Control {
    public function enqueue() {
      wp_enqueue_style('multi-image-style', get_template_directory_uri() . '/customize/multi-image.css');
      wp_enqueue_script('multi-image-script', get_template_directory_uri() . '/customize/multi-image.js', array('jquery'), rand(), true);
    }

    public function render_content() {
      wp_enqueue_media();

      ?>
        <label>
          <span class='customize-control-title'>Ausgewähle Bilder</span>
        </label>
        <span class="customize-control-description">Lege hier die Bilder für die Slideshow fest. Auf anderen Unterseiten wird das erste Bild der Slideshow angezeigt.</span>
        <div>
          <ul class='images'></ul>
        </div>
        <div class='actions'>
          <a class="button-secondary upload">Hinzufügen</a>
        </div>

        <input class="wp-editor-area" id="imagesInput" type="hidden" <?php $this->link(); ?> >
      <?php
    }
  }


?>
