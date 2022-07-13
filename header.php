<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:url" content="<?php echo $current_url; ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?>">
    <meta property="og:description" content="<?php echo is_front_page() ? bloginfo('description') : get_the_excerpt(get_the_ID()); ?>">
    <meta property="og:image" content="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>">

    <meta name="theme-color" content="#A4005A">
    <meta name="description" content="<?php echo get_the_excerpt(get_the_ID()); ?>">

    <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <?php wp_head(); ?>

    <style media="screen">
      :root {
        <?php
        switch (get_theme_mod('theme_color_option')) {
          case 'magenta':
            echo '--light-accent-color: #A4005A; --dark-accent-color: #52002E; --element-accent-color: #52002E; --element-text-color: #FFFFFF;';
            break;

          case 'blau':
            echo '--light-accent-color: #0071A4; --dark-accent-color: #003852; --element-accent-color: #003852; --element-text-color: #FFFFFF;';
            break;

          case 'cyan':
            echo '--light-accent-color: #00ABAE; --dark-accent-color: #003852; --element-accent-color: #00ABAE; --element-text-color: #FFFFFF;';
            break;

          case 'blau-magenta':
            echo '--light-accent-color: #E5007D; --dark-accent-color: #003852; --element-accent-color: #003852; --element-text-color: #FFFFFF;';
            break;

          case 'gelb*-pink':
          case 'gelb-pink-dark':
            echo '--light-accent-color: #FFED00; --dark-accent-color: #E5007D; --element-accent-color: #FFED00; --element-text-color: #232323;';
            break;

          case 'gelb-pink*':
            echo '--light-accent-color: #FFED00; --dark-accent-color: #E5007D; --element-accent-color: #E5007D; --element-text-color: #FFFFFF;';
            break;

          default:
            echo '--light-accent-color: #A4005A; --dark-accent-color: #52002E; --element-accent-color: #52002E; --element-text-color: #FFFFFF;';
            break;
        } ?>
      }
    </style>
  </head>

  <body class="<?php echo get_theme_mod('theme_color_option') == 'gelb-pink-dark' ? 'dark-background' : '' ?>">
    <header id="header" class="<?php echo is_front_page() ? 'front-page' : '' ?>">
      <div class="header-top-bar">
        <div class="header-top-branding">
          <?php if (has_custom_logo()) {
            the_custom_logo();
           } else {
            wp_title('');
          } ?>
        </div>
        <div class="header-navigation-area">
          <?php if (has_nav_menu('secondary')) { ?>
            <nav class="secondary-nav">
              <?php
                wp_nav_menu(array(
                  'menu_class' => 'header-menu',
                  'container' => '',
                  'theme_location' => 'secondary',
                ));
              ?>
              &nbsp;
            </nav>
          <?php } ?>

          <?php if (has_nav_menu('primary')) { ?>
            <nav class="primary-nav">
              <?php
                wp_nav_menu(array(
                  'menu_class' => 'header-menu',
                  'container' => '',
                  'theme_location' => 'primary',
                ));
              ?>
              <button title="Suche" class="nav-search-button"><i class="fas fa-search"></i></button>
            </nav>
          <?php } ?>

        </div>
      </div>

      <h1 class="header-title"><?php is_front_page() ? bloginfo('description') : wp_title(''); ?></h1>

      <?php if(is_front_page()) { ?>
        <div class="header-image-slider">
          <div class="header-image-slide" style="background-image: url(<?php header_image() ?>)">&nbsp;</div>
        </div>
      <?php } else if (has_post_thumbnail()) { ?>
        <div class="header-image-wrapper">
          <div class="header-image-slide" style="background-image: url(<?php echo get_the_post_thumbnail_url() ?>);"></div>
        </div>
      <?php } ?>

      <div class="header-horizontal-bar"></div>
    </header>
