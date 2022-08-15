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


  add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_style( 'twentytwenty-custom-block-editor-styles', get_theme_file_uri( "/inc/editor-style.css" ), false, wp_get_theme()->get('Version'));
  });


  /*---------------------------------------------
    Theme support
  ---------------------------------------------*/

  function lhg_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');

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
        'description' => 'Lege fest, wie der Titel des Abschnitts mit den Neugikeiten benannt wird.',
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
        'description' => 'Lege fest, welche Seite für den zusätzlichen Inhaltsbereich auf der Startseite verwendet werden soll. Denke daran, dass diese Seite nicht zu viel Inhalt enthalten sollte.',
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
        )
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
        'default' => 'true',
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

      $wp_customize->add_control('remove-footer-branding_control', array(
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

        <input class="wp-editor-area" id="imagesInput" type="hidden" <?php $this->link(); ?>>
      <?php
    }
  }



  /*-----------------------------------------------
    Additional post types (?)
  -----------------------------------------------*/

  //To-do

?>
