<?php

  //Loads functions
  get_template_part('all-functions');

  //Loads script and scriptsAndStyles
  add_action ('wp_enqueue_scripts','scriptsAndStyles' );
  //
  // //add babel
  // add_filter( 'script_loader_tag', 'BabelType', 10, 3 );

  //register menus
  add_action( 'after_setup_theme', 'register_my_menus' );

  //thumbnail support
  add_theme_support( 'post-thumbnails' );

  //excerpt length
  add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

  //Remove excerpt more
  function new_excerpt_more($more) {
     global $post;
     return '.';
  }
  add_filter('excerpt_more', 'new_excerpt_more');

 ?>
