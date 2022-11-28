<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-version" content="<?php echo wp_get_theme()->version ?>">

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?>">

    <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="
      <?php
      try {
        echo get_bloginfo('pingback_url');
      } catch (\Exception $e) {
        echo '';
      }
      ?>
    ">
    
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
        <h3>Wartungsmodus</h3>
        <h1 class="page-title"><i class="fas fa-wrench"></i></h1>
        <h3>Derzeit wird unsere Seite überarbeitet. Sie steht euch in Kürze wieder zur Verfügung.</h3>
      </div>

      <div class="extra-page-footer">
        <div class="extra-page-footer-flex-area">
          <div class="extra-page-footer-branding">
            <?php if (has_custom_logo()) {
              the_custom_logo();
            } else {
              ?><a href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a><?php
            } ?>
          </div>

          <a title="Zur Loginseite" class="extra-page-login-link" href="<?php echo wp_login_url(); ?>">Login</a>
          <script type="text/javascript">
            jQuery(document).ready(function() {
              jQuery('.extra-page-login-link').attr('href', jQuery('.extra-page-login-link').attr('href') + '?redirect_to=' + window.location.href);
            });
          </script>
        </div>
      </div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>
