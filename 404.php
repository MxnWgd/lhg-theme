<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:url" content="<?php echo $current_url; ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?>">

    <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

    <?php if (has_site_icon()) { ?>
        <link rel="icon" type="image/x-icon" href="<?php echo get_site_icon_url(); ?>">
        <link rel="apple-touch-icon" href="<?php echo get_site_icon_url(); ?>">
    <?php } else {
      switch (get_theme_mod('theme_color_option')) {
        case 'magenta':
          ?><link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-magenta.png">
            <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-magenta.png"><?php
          break;

        case 'blau':
          ?><link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-blau.png">
            <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-blau.png"><?php
          break;

        case 'türkis':
          ?><link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-türkis.png">
            <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-türkis.png"><?php
          break;

        case 'blau-magenta':
          ?><link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-magenta.png">
            <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-magenta.png"><?php
          break;

        case 'gelb*-pink':
        case 'gelb-pink-dark':
        case 'gelb-pink*':
          ?><link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-gelb.png">
            <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-gelb.png"><?php
          break;

        default:
          ?><link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-gelb.png">
            <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/lhg-logo-gelb.png"><?php
          break;
      }
    } ?>

    <?php
      switch (get_theme_mod('theme_color_option')) {
        case 'magenta':
          ?><meta name="theme-color" content="#52002E"/><?php
          break;

        case 'blau':
          ?><meta name="theme-color" content="#003852"/><?php
          break;

        case 'türkis':
          ?><meta name="theme-color" content="#00ABAE"/><?php
          break;

        case 'blau-magenta':
          ?><meta name="theme-color" content="#003852"/><?php
          break;

        case 'gelb*-pink':
        case 'gelb-pink-dark':
          ?><meta name="theme-color" content="#FFED00"/><?php
          break;

        case 'gelb-pink*':
          ?><meta name="theme-color" content="#E5007D"/><?php
          break;

        default:
          ?><meta name="theme-color" content="#52002E"/><?php
          break;
    } ?>

    <?php wp_head(); ?>

    <style media="screen">
      :root {
        <?php
        switch (get_theme_mod('theme_color_option')) {
          case 'magenta':
            echo '--light-accent-color: #A4005A; --dark-accent-color: #52002E; --element-accent-color: #52002E; --element-text-color: #FFFFFF; --light-accent-text-color: var(--bright-text-color);';
            break;

          case 'blau':
            echo '--light-accent-color: #0071A4; --dark-accent-color: #003852; --element-accent-color: #003852; --element-text-color: #FFFFFF; --light-accent-text-color: var(--bright-text-color);';
            break;

          case 'türkis':
            echo '--light-accent-color: #00ABAE; --dark-accent-color: #003852; --element-accent-color: #00ABAE; --element-text-color: #FFFFFF; --light-accent-text-color: var(--bright-text-color);';
            break;

          case 'blau-magenta':
            echo '--light-accent-color: #E5007D; --dark-accent-color: #003852; --element-accent-color: #003852; --element-text-color: #FFFFFF; --light-accent-text-color: var(--bright-text-color);';
            break;

          case 'gelb*-pink':
          case 'gelb-pink-dark':
            echo '--light-accent-color: #FFED00; --dark-accent-color: #E5007D; --element-accent-color: #FFED00; --element-text-color: #232323; --light-accent-text-color: var(--element-text-color);';
            break;

          case 'gelb-pink*':
            echo '--light-accent-color: #FFED00; --dark-accent-color: #E5007D; --element-accent-color: #E5007D; --element-text-color: #FFFFFF; --light-accent-text-color: #232323;';
            break;

          default:
            echo '--light-accent-color: #A4005A; --dark-accent-color: #52002E; --element-accent-color: #52002E; --element-text-color: #FFFFFF; --light-accent-text-color: var(--element-text-color);';
            break;
        } ?>
      }
    </style>
  </head>

  <body>
    <div class="extra-page">
      <div class="extra-page-content">
        <h3>404</h3>
        <h1 class="page-title">:(</h1>
        <h3>Die gewünschte Seite konnte nicht gefunden werden.</h3>
      </div>

      <div class="extra-page-footer">
        <div class="extra-page-footer-flex-area">
          <?php if (has_nav_menu('secondary')) { ?>
            <nav class="extra-page-footer-nav">
              <?php
              wp_nav_menu(array(
                'menu_class' => 'header-menu',
                'container' => '',
                'theme_location' => 'secondary',
              ));
              ?>
              <?php if (get_theme_mod('data_protection_page_in_menu') && get_theme_mod('data_protection_page') !== '0') { ?><a title="Datenschutzerklärung" class="footer-menu-button" type="button" href="<?php echo get_page_link(get_theme_mod('data_protection_page')); ?>"><?php echo get_the_title(get_theme_mod('data_protection_page')); ?></a><?php } ?>
              <?php if (get_theme_mod('show_sos_icon')) { ?><a title="SOS" class="footer-menu-button" id="sosButton" type="button" target="_blank" href="https://sos.bundes-lhg.de/">🆘</a><?php } ?>
            </nav>
          <?php } ?>

          <div class="extra-page-footer-branding">
            <?php if (has_custom_logo()) {
              the_custom_logo();
            } else {
              ?><a href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a><?php
            } ?>
          </div>
        </div>
      </div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>
