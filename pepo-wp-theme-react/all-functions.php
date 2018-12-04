<?php

  //Load scripts and styles
  function scriptsAndStyles() {
    //React, react-dom, jquery, babel-core, bootstrap, react js file
    wp_enqueue_style("style", get_stylesheet_uri() );
    wp_enqueue_style("bootstrap", "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" );
    wp_enqueue_script("jquery", "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" );wp_enqueue_script("react", "https://fb.me/react-15.0.1.min.js" );
    /*The react-dom package provides DOM-specific methods that can be used at the top level of your app and as an
    escape hatch to get outside of the React model if you need to. Most of your components should not need to use this module.*/
    wp_enqueue_script("react-dom", "https://fb.me/react-dom-15.0.1.min.js", array("react") );
    wp_enqueue_script("babel", "https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js" );
    wp_enqueue_script("resources", get_template_directory_uri() . "/assets/scripts/resources.js", array()  );
    wp_enqueue_script("header",get_template_directory_uri() . "/assets/scripts/header.js", array("react","react-dom","babel"));
    wp_enqueue_script("projects" ,get_template_directory_uri() . "/assets/scripts/projects.js", array("react","react-dom","babel"));
    wp_enqueue_script("projects-description" ,get_template_directory_uri() . "/assets/scripts/projects-description.js", array("react","react-dom","babel"));
    wp_enqueue_script("contact-form" ,get_template_directory_uri() . "/assets/scripts/contact-form.js", array("react","react-dom","babel"));


  }


  //excerpt length
  function custom_excerpt_length( $length ) {
  	return 20;
  }

  // adds babel type to the script tag
  function BabelType( $tag, $handle, $src ) {
     if (!checkhandle($handle) ) {
       return $tag;
     }
       return '<script src="' . $src . '" type="text/babel"></script>' . "\n";
   }


   function checkhandle($handle){
     if($handle == "index" || $handle == "header" || $handle == "contact-form" || $handle == "menu" || $handle == "projects" || $handle == "projects-description" ){
       return true;
     } else {
       return false;
     }
   }

  //add supports, menus, thumbnails
  function register_my_menus(){
    register_nav_menus(array('primary-menu' => __( 'Primary Menu' ),'secondary-menu' => __( 'Secondary Menu' ),'sub-cat-menu' => __( 'SubCategory Menu' )));
    add_theme_support('post-thumbnails');
  }

 ?>
