<?php
  /*---------------------------------------------
    General functions
  ---------------------------------------------*/

  function lhg_theme_enqueue() {
    wp_enqueue_style('customstyle', get_template_directory_uri() . '/style.css', array(), '', 'all');
  }

  add_action('wp_enqueue_scripts', 'lhg_theme_enqueue');


  /*---------------------------------------------
    Theme support
  ---------------------------------------------*/

  function lhg_theme_setup() {
    add_theme_support('post-thumbnails');

    register_nav_menu('primary', 'Hauptmenü');
    register_nav_menu('footer', 'Fußleistenmenü');

    // TODO
  }

  add_action('after_setup_theme', 'lhg_theme_setup');

  /*-----------------------------------------------
    Theme Customizer
  -----------------------------------------------*/

// TODO


?>
