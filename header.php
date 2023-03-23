<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-version" content="<?php echo wp_get_theme()->version ?>">

    <meta property="og:url" content="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?>">
    <meta property="og:description" content="<?php echo is_front_page() ? bloginfo('description') : get_the_excerpt(get_the_ID()); ?>">
    <meta property="og:image" content="<?php
      if (is_front_page()) {
        switch (get_theme_mod('header_slider_mode')) {
          case '0':
          case '1':
          default:
            echo wp_get_attachment_image_src(get_theme_mod('header_slider_image'), 'medium')[0];
            break;

          case '2':
            echo wp_get_attachment_image_src(explode(',', get_theme_mod('header_slider_carousel'))[0], 'medium')[0];
            break;
        }
      } else {
        echo get_the_post_thumbnail_url(get_the_ID(), 'medium');
      }
    ?>">

    <meta name="description" content="<?php echo is_front_page() ? bloginfo('description') : get_the_excerpt(get_the_ID()); ?>">

    <title>
      <?php if (is_front_page()) {
        echo get_bloginfo('description') != '' ? get_bloginfo('description') . ' | ' : '';
      } else {
        wp_title(''); ?> | <?php
      } ?>
      <?php bloginfo('name'); ?>
    </title>
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

  <body class="<?php echo get_theme_mod('theme_color_option') == 'gelb-pink-dark' ? 'dark-background' : '' ?> <?php echo get_theme_mod('bw_mode_option', false) ? 'bw-mode' : '' ?>">
    <?php if (!is_customize_preview() && (!isset($_COOKIE['cookies']) || !$_COOKIE['cookies'] == 'accepted') && get_the_ID() != get_theme_mod('data_protection_page')) { get_template_part('cookies'); } ?>
    <?php get_template_part('image-view'); ?>

    <header id="header" class="<?php echo is_front_page() ? 'front-page' : '' ?> <?php echo !(is_front_page() || has_post_thumbnail()) || (get_post_type() == 'persons' && is_single()) ? 'no-image' : '' ?>">
      <div class="header-top-bar" id="headerTopBar">
        <div class="header-top-branding">
          <?php if (has_custom_logo()) {
            the_custom_logo();
           } else {
            ?><a href="<?php echo get_home_url(); ?>"><?php bloginfo('name'); ?></a><?php
          } ?>

          <?php $query['autofocus[section]'] = 'title_tagline'; echo is_user_logged_in() ? '<a class="edit-post-link" title="Logo bearbeiten" href="' . esc_url(add_query_arg($query, admin_url('customize.php'))) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
        </div>
        <div class="header-navigation-area">
          <?php if (has_nav_menu('secondary')) { ?>
            <nav class="secondary-nav">
              <?php $query['autofocus[panel]'] = 'nav_menus'; $query['autofocus[section]'] = ''; echo is_user_logged_in() ? '<a class="edit-post-link" title="Menü bearbeiten" href="' . esc_url(add_query_arg($query, admin_url('customize.php'))) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
              <?php
                wp_nav_menu(array(
                  'menu_class' => 'header-menu',
                  'container' => '',
                  'theme_location' => 'secondary',
                  'depth' => 1
                ));
              ?>
            </nav>
          <?php } ?>

          <button title="Menü öffnen" class="header-navigation-button" type="button" id="headerNavigationButton"><span class="header-navigation-button-stroke">&nbsp;</span></button>

          <?php if (has_nav_menu('primary')) { ?>
            <nav class="primary-nav" id="primaryNav">
              <?php $query['autofocus[panel]'] = 'nav_menus'; $query['autofocus[section]'] = ''; echo is_user_logged_in() ? '<a class="edit-post-link" title="Menü bearbeiten" href="' . esc_url(add_query_arg($query, admin_url('customize.php'))) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
              <?php
                wp_nav_menu(array(
                  'menu_class' => 'header-menu',
                  'container' => '',
                  'theme_location' => 'primary',
                ));
              ?>

              <?php if (!get_theme_mod('remove_search_button')) { ?>
                <button title="Suche" class="nav-search-button" type="button" id="navSearchButton"><i class="fas fa-search"></i>
                  <div class="nav-search-field">
                    <?php get_search_form(); ?>
                  </div>
                </button>
              <?php } ?>
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
              <div class="header-image-slide" style="background-image: url(<?php echo get_theme_mod('header_slider_image') != null ? wp_get_attachment_image_src(get_theme_mod('header_slider_image'), 'full')[0] : get_template_directory_uri() . '/img/default.jpg'; ?>)">&nbsp;</div>
              <?php $query['autofocus[section]'] = 'header_slider_section'; echo is_user_logged_in() ? '<a class="edit-post-link" title="Header bearbeiten" href="' . esc_url(add_query_arg($query, admin_url('customize.php'))) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
            </div><?php
            break;

          case '1': //Video
            ?><div class="header-image-slider">
              <video class="header-image-video" src="<?php echo wp_get_attachment_url(get_theme_mod('header_slider_video')); ?>" autoplay loop muted></video>
              <?php $query['autofocus[section]'] = 'header_slider_section'; echo is_user_logged_in() ? '<a class="edit-post-link" title="Header bearbeiten" href="' . esc_url(add_query_arg($query, admin_url('customize.php'))) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
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
                  ?><button class="header-image-slider-control-dot" title="Zu Slide <?php echo $i + 1; ?> springen" id="<?php echo $i; ?>" type="button">&nbsp;</button><?php
                } ?>
              </div>
              <?php $query['autofocus[section]'] = 'header_slider_section'; echo is_user_logged_in() ? '<a class="edit-post-link" title="Header bearbeiten" href="' . esc_url(add_query_arg($query, admin_url('customize.php'))) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
            </div><?php
            break;

          default:
            ?><div class="header-image-slider">
              <div class="header-image-slide" style="background-image: url(<?php echo get_template_directory_uri() ?>/img/default.jpg)">&nbsp;</div>
              <?php $query['autofocus[section]'] = 'header_slider_section'; echo is_user_logged_in() ? '<a class="edit-post-link" title="Header bearbeiten" href="' . esc_url(add_query_arg($query, admin_url('customize.php'))) . '"><i class="fas fa-pen-square"></i></a>' : ''?>
            </div><?php
        }
      } else if (has_post_thumbnail()
        && !is_category()
        && !is_search()
        && !is_tag()
        && !(get_post_type() == 'persons' && is_single())) { ?>
        <div class="header-image-wrapper">
          <div class="header-image-slide <?php
            switch (get_post_meta(get_the_ID(), 'featured_image_position', 'center')) {
              case 'top':
                echo 'align-top';
                break;

              case 'bottom':
                echo 'align-bottom';
                break;

              case 'center':
              default:
                echo 'align-center';
                break;
            } ?>"
          style="background-image: url(<?php echo get_the_post_thumbnail_url() ?>);"></div>
        </div>
      <?php } else if (get_theme_mod('header_slider_mode') === '2') { ?>
        <div class="header-image-wrapper">
          <div class="header-image-slide" style="background-image: url(<?php echo wp_get_attachment_image_src(explode(',', get_theme_mod('header_slider_carousel'))[0], 'full')[0]; ?>);">&nbsp;</div>
        </div>
      <?php } else { ?>
        <div class="header-image-wrapper">
          <div class="header-image-slide" style="background-image: url(<?php echo get_theme_mod('header_slider_image') != null ? wp_get_attachment_image_src(get_theme_mod('header_slider_image'), 'full')[0] : get_template_directory_uri() . '/img/default.jpg'; ?>);">&nbsp;</div>
        </div>
      <?php } ?>

      <div class="header-horizontal-bar"></div>
    </header>
