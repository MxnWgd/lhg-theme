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


  /*---------------------------------------------
    Theme support
  ---------------------------------------------*/

  function lhg_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-header');
    add_theme_support('custom-logo');

    register_nav_menu('primary', 'Hauptmenü');
    register_nav_menu('secondary', 'Kleines Zusatzmenü');
    register_nav_menu('footer', 'Fußleistenmenü');

    // TODO
  }

  add_action('after_setup_theme', 'lhg_theme_setup');

  /*-----------------------------------------------
    Theme Customizer
  -----------------------------------------------*/

  class LHG_Theme_Customize {
    public static function lhg_customize_register($wp_customize) {
      $full_categories_list = get_categories(array('orderby' => 'name',));
      $category_choices = [];

      foreach($full_categories_list as $single_cat) {
        $category_choices[$single_cat->slug] = $single_cat->name;
      }

      $wp_customize->add_section('theme_color_options', array(
        'title' => 'LHG-Farbschema',
        'description' => 'Wähle aus verschiedenen Farbschemata, um die Seite zu individualisieren. Alle Farbschemata sind mit der CI der Liberalen Hochschulgruppen abgestimmt.',
        'priority' => 1,
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
          'cyan' => 'Cyan',
          'blau-magenta' => 'Blau-Magenta',
          'gelb*-pink' => 'Gelb-Pink (Gelbe Akzente)',
          'gelb-pink*' => 'Gelb-Pink (Pinke Akzente)',
          'gelb-pink-dark' => 'Gelb-Pink (Dunkler Hintergrund)'
         )
      ));



      $wp_customize->add_section('front_page_options', array(
        'title' => 'Startseiteneinstellungen',
        'description' => 'Lege hier fest, wie die Startseite aussehen soll.',
        'priority' => 1,
      ));

      $wp_customize->add_setting('front_page_news_title', array(
        'default' => 'Neuigkeiten',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('front_page_news_title_control', array(
        'settings' => 'front_page_news_title',
        'section' => 'front_page_options',
        'label' => 'Titel der Neuigkeiten',
        'description' => 'Lege fest, wie der Titel des Abschnitts mit den Neugikeiten benannt wird.',
      ));

      $wp_customize->add_setting('front_page_news_category', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
      ));

      $wp_customize->add_control('front_page_news_category_control', array(
        'settings' => 'front_page_news_category',
        'section' => 'front_page_options',
        'label' => 'Kategory für Neuigkeiten',
        'description' => 'Lege fest, welche Beitragskategorie im Neuigkeiten-Abschnitt angezeigt werden soll.',
        'type' => 'select',
        'choices' => $category_choices
      ));



      $wp_customize->add_section('sm_options', array(
        'title' => 'Social-Media-Icons',
        'description' => 'Hier können Links zu Social-Media-Profilen eingefügt werden. Bleibt ein Feld leer, wird kein Symbol für das Social-Media-Netzwerk angezeigt.',
        'priority' => 1,
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
    }
  }

  add_action('customize_register', array('LHG_Theme_Customize', 'lhg_customize_register'));



?>
