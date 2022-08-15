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

    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/img/<?php switch (get_theme_mod('theme_color_option')) {
        case 'magenta':
          echo 'lhg-logo-magenta.png';
          break;

        case 'blau':
          echo 'lhg-logo-blau.png';
          break;

        case 'türkis':
          echo 'lhg-logo-türkis.png';
          break;

        case 'blau-magenta':
          echo 'lhg-logo-magenta.png';
          break;

        case 'gelb*-pink':
        case 'gelb-pink-dark':
        case 'gelb-pink*':
          echo 'lhg-logo-gelb.png';
          break;

        default:
          echo 'lhg-logo-gelb.png';
          break;
      } ?>
    ">
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

  <body class="<?php echo get_theme_mod('theme_color_option') == 'gelb-pink-dark' ? 'dark-background' : '' ?>">
    <?php if (!$_COOKIE['cookies'] == 'accepted') { get_template_part('cookies'); } ?>
    <?php if (get_theme_mod('show_flyout')) { get_template_part('flyout'); } ?>
    <div class="image-view">
      <img id="imageViewImg" src="">
      <p class="image-view-subtitle"></p>
    </div>

    <header id="header" class="<?php echo is_front_page() ? 'front-page' : '' ?> <?php echo !(is_front_page() || has_post_thumbnail()) ? 'no-image' : '' ?>">
      <div class="header-top-bar" id="headerTopBar">
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
            </nav>
          <?php } ?>

          <button title="Menü öffnen" class="header-navigation-button" type="button" id="headerNavigationButton"><span class="header-navigation-button-stroke">&nbsp;</span></button>

          <?php if (has_nav_menu('primary')) { ?>
            <nav class="primary-nav" id="primaryNav">
              <?php
                wp_nav_menu(array(
                  'menu_class' => 'header-menu',
                  'container' => '',
                  'theme_location' => 'primary',
                ));
              ?>
              <button title="Suche" class="nav-search-button" type="button"><i class="fas fa-search"></i>
                <div class="nav-search-field">
                  <?php get_search_form(); ?>
                </div>
              </button>
            </nav>
          <?php } ?>

        </div>
      </div>

      <?php if (is_front_page()) {
        ?><h1 class="header-title"><?php bloginfo('description') ?></h1><?php
      } ?>


      <?php if (is_front_page()) {
        switch (get_theme_mod('header_slider_mode')) {
          case '0': //Bild
            ?><div class="header-image-slider">
              <div class="header-image-slide" style="background-image: url(<?php echo wp_get_attachment_image_src(get_theme_mod('header_slider_image'), 'full')[0]; ?>)">&nbsp;</div>
            </div><?php
            break;

          case '1': //Video
            ?><div class="header-image-slider">
              <video class="header-image-video" src="<?php echo wp_get_attachment_url(get_theme_mod('header_slider_video')); ?>" autoplay loop muted></video>
            </div><?php
            break;

          case '2': //Slider
            ?><div class="header-image-slider multiple">
              <?php

              $ids = explode(',', get_theme_mod('header_slider_carousel'));
              foreach ($ids as $value) {
                ?><div class="header-image-slide" style="background-image: url(<?php echo wp_get_attachment_image_src($value, 'full')[0]; ?>)">&nbsp;</div><?php
              } ?>

              <div class="header-image-slider-control">
                <?php for ($i = 0; $i < sizeof($ids); $i++) {
                  ?><button class="header-image-slider-control-dot" id="<?php echo $i ?>">&nbsp;</button><?php
                } ?>
              </div>
            </div><?php
            break;
        }
      } else if (has_post_thumbnail() && !is_category() && !is_search() && !is_tag()) { ?>
        <div class="header-image-wrapper">
          <div class="header-image-slide" style="background-image: url(<?php echo get_the_post_thumbnail_url() ?>);"></div>
        </div>
      <?php } else if (get_theme_mod('header_slider_mode') === '2') { ?>
        <div class="header-image-wrapper">
          <div class="header-image-slide" style="background-image: url(<?php echo wp_get_attachment_image_src(explode(',', get_theme_mod('header_slider_carousel'))[0], 'full')[0]; ?>);">&nbsp;</div>
        </div>
      <?php } else { ?>
        <div class="header-image-wrapper">
          <div class="header-image-slide" style="background-image: url(<?php echo wp_get_attachment_image_src(get_theme_mod('header_slider_image'), 'full')[0]; ?>);">&nbsp;</div>
        </div>
      <?php } ?>

      <div class="header-horizontal-bar"></div>
    </header>
