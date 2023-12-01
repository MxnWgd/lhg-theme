<?php

class LHG_Theme_Customize {
  public static function lhg_customize_register($wp_customize) {
    //get categories
    $full_categories_list = get_categories(array('orderby' => 'name',));
    $category_choices = [];

    foreach($full_categories_list as $single_cat) {
      $category_choices[$single_cat->cat_ID] = $single_cat->name;
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



    $wp_customize->add_section('maintenance_mode_options', array(
      'title' => 'Wartungsmodus',
      'description' => 'Hier kannst du den Wartungsmodus aktivieren oder deaktivieren. Ist der Wartungsmodus aktiv, werden alle Seiten vor Besuchern versteckt und sind lediglich für angemeldete Benutzer sichtbar.',
      'priority' => 1,
    ));

    $wp_customize->add_setting('maintenance_mode', array(
      'default' => true,
      'capability' => 'edit_theme_options',
      'type' => 'theme_mod',
    ));

    $wp_customize->add_control('maintenance_mode_control', array(
      'settings' => 'maintenance_mode',
      'section' => 'maintenance_mode_options',
      'label' => 'Wartungsmodus aktivieren',
      'type' => 'checkbox',
    ));


    $wp_customize->add_section('header_slider_section', array(
      'title'=> 'Header-Einstellungen',
      'description' => 'Hier kannst du einstellen, was im Header auf der Startseite angezeigt wird.',
      'priority' => 22,
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


    $wp_customize->add_section('theme_color_options', array(
      'title' => 'LHG-Farbschema',
      'description' => 'Wähle aus verschiedenen Farbschemata, um die Seite zu individualisieren. Alle Farbschemata sind mit der CI der Liberalen Hochschulgruppen abgestimmt.',
      'priority' => 23,
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
    $wp_customize->add_setting('bw_mode_option', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'type' => 'theme_mod',
    ));

    $wp_customize->add_control('bw_mode_control', array(
      'settings' => 'bw_mode_option',
      'section' => 'theme_color_options',
      'label' => '"Trauermodus" (Seite komplett in Schwarz-Weiß) aktivieren',
      'type' => 'checkbox',
    ));



    $wp_customize->add_section('front_page_options', array(
      'title' => 'Startseiteneinstellungen',
      'description' => 'Lege hier fest, wie die Startseite aussehen soll.',
      'priority' => 24,
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
      'description' => 'Lege fest, welche Beitragskategorie im Neuigkeiten-Abschnitt angezeigt werden soll. "Auf der Startseite gehaltene" Beiträge werden unabhängig von ihrer Kategorie angezeigt.',
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

    $wp_customize->add_setting('front_page_events_title', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'type' => 'theme_mod',
    ));

    $wp_customize->add_control('front_page_events_title_control', array(
      'settings' => 'front_page_events_title',
      'section' => 'front_page_options',
      'label' => 'Terminansicht',
      'description' => 'Lege fest, wie der Abschnitt mit den Terminen benannt sein soll. Ist der Titel leer, wird der Abschnitt ausgeblendet.',
    ));

    $wp_customize->add_setting('front_page_board_list', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'type' => 'theme_mod',
    ));

    $wp_customize->add_control(new Person_Selector($wp_customize, 'front_page_board_list', array(
      'section'  => 'front_page_options',
      )
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

    $wp_customize->add_setting('front_page_second_additional_area_page', array(
      'default' => '0',
      'capability' => 'edit_theme_options',
      'type' => 'theme_mod',
    ));

    $wp_customize->add_control('front_page_second_additional_area_page_control', array(
      'settings' => 'front_page_second_additional_area_page',
      'section' => 'front_page_options',
      'label' => 'Weiterer Contentbereich',
      'description' => 'Wenn gewünscht, kann hier eine weitere Seite für den Bereich unten auf der Startseite angezeigt werden.',
      'type' => 'select',
      'choices' => $page_choices
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
      'default' => 'http://newsletter.bundes-lhg.de/',
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

    $wp_customize->add_setting('remove_search_button', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'type' => 'theme_mod',
    ));

    $wp_customize->add_control('remove_search_button_control', array(
      'settings' => 'remove_search_button',
      'section' => 'more_options',
      'label' => 'Suchbutton im Header entfernen',
      'type' => 'checkbox',
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

    $wp_customize->add_setting('use_gdpr_iframes', array(
      'default' => true,
      'capability' => 'edit_theme_options',
      'type' => 'theme_mod',
    ));

    $wp_customize->add_control('use_gdpr_iframes_control', array(
      'settings' => 'use_gdpr_iframes',
      'section' => 'more_options',
      'label' => 'DSGVO-konforme Einbettungen verwenden',
      'description' => 'Diese Einstellung sorgt dafür, dass in Posts eingebettete, externe Inhalte (bspw. YouTube-Videos oder Google-Maps-Karten) nicht automatisch geladen werden, um den Anforderungen der DSGVO zu entsprechen.',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting('hide_expired_resolutions', array(
      'default' => false,
      'capability' => 'edit_theme_options',
      'type' => 'theme_mod',
    ));

    $wp_customize->add_control('hide_expired_resolutions_control', array(
      'settings' => 'hide_expired_resolutions',
      'section' => 'more_options',
      'label' => 'Abgelaufene Beschlüsse vor nicht-eingeloggten Besuchern verstecken',
      'description' => 'Hinweis: diese Option funktioniert NICHT bei automatisch abgelaufenen Anträgen (Sunset-Funktion)',
      'type' => 'checkbox',
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


    $wp_customize->add_setting('event_page_layout', array(
      'default' => 'both',
      'capability' => 'edit_theme_options',
      'type' => 'theme_mod',
    ));

    $wp_customize->add_control('event_page_layout_control', array(
      'settings' => 'event_page_layout',
      'section' => 'more_options',
      'label' => 'Veranstaltungsübersichts-Seite',
      'description' => 'Lege hier das Layout der <a href="' . get_post_type_archive_link('events') . '">Seite für die Veranstaltungsübersicht</a> fest.',
      'type' => 'select',
      'choices' => array(
        'both' => 'Kommende Veranstaltungen oberhalb des Kalenders anzeigen',
        'both_switched' => 'Kommende Veranstaltungen unterhalb des Kalenders anzeigen',
        'only_list' => 'Nur kommende Veranstaltungen anzeigen',
        'only_calendar' => 'Nur Kalender anzeigen',
      ),
    ));

    $wp_customize->add_setting('event_page_amount_elements', array(
      'default' => -1,
      'capability' => 'edit_theme_options',
      'type' => 'theme_mod',
    ));

    $wp_customize->add_control('event_page_amount_elements_control', array(
      'settings' => 'event_page_amount_elements',
      'section' => 'more_options',
      'description' => 'Hier kannst du festlegen, wie viele kommende Veranstaltungen angezeigt werden sollen. Um alle anzuzeigen, trage <code>-1</code> ein.',
      'active_callback' => function() { return 'only_calendar' !== get_theme_mod('event_page_layout'); },
    ));


    //remove static homepage section to prevent wrong settings
    $wp_customize->remove_section('static_front_page');
  }
}

add_action('customize_register', array('LHG_Theme_Customize', 'lhg_customize_register'));



/*---------------------------------------------
  Require components
---------------------------------------------*/

require_once('multi-image.php');



require_once('person-select.php');
function person_select_data() {
  $id = $_POST['id'];

  $return_data = array(
    'name' => get_the_title($id),
    'thumb' => has_post_thumbnail($id) ? get_the_post_thumbnail_url($id, 'thumbnail') : ''
  );

   wp_send_json($return_data);
  exit;
}
add_action('wp_ajax_nopriv_person_select_data', 'person_select_data');
add_action('wp_ajax_person_select_data', 'person_select_data');

?>
