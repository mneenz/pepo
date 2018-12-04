<?php

//Register menus
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}

//Add thumbnail image support
add_theme_support( 'post-thumbnails' );

//Add staff pictures image size
add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
    add_image_size( 'staff-image', 400, 400, true ); //400,400 cropped
}
//Register menus
add_action( 'init', 'register_my_menus' );

//Add class 'background-image' to body class
add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {

  $classes[] = 'background-image';
  return $classes;
}

// custom excerpt length
add_filter('excerpt_length', 'my_excerpt_length');
function my_excerpt_length($length) {
    if(in_category(17)) { //News category excerpt length
        return 50;
    } else {
        return 13;
    }
}

// Add 'see entire project' link to excerpt
function themify_custom_excerpt_more($more) {
   global $post;
   if(in_category(6)) { //Project category excerpt ending
       return '...<a class="read-more" href="'. get_permalink($post->ID) . '">'. __(' See entire project') .'</a>';
   } else {
       return '...<a class="read-more" href="'. get_permalink($post->ID) . '">'. __(' Read more') .'</a>';
   }
}
add_filter('excerpt_more', 'themify_custom_excerpt_more');

remove_filter('term_description','wpautop');


//Load more projects on scroll script
function pepo_my_load_more_script() {

	global $wp_query;

	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');

	// register our main script but do not enqueue it yet
	wp_register_script( 'loadMoreProjects', get_stylesheet_directory_uri() . '/assets/js/loadMoreProjects.js', array('jquery') );

	// now the most interesting part
	// we have to pass parameters to loadMoreProjects.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'loadMoreProjects', 'pepo_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => serialize( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );

 	wp_enqueue_script( 'loadMoreProjects' );
}

add_action( 'wp_enqueue_scripts', 'pepo_my_load_more_script' );

//Load more projects on scroll ajax handler
function pepo_loadmore_ajax_handler(){

	// prepare our arguments for the query
	$args = unserialize( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';

	// it is always better to use WP_Query but not here
	query_posts( $args );

  if ( have_posts() ) {

    while( have_posts() ) {
        the_post();
        get_template_part( '/template-parts/post-content', get_post_format() );
    }//endwhile
  }//endif

	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_loadmore', 'pepo_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'pepo_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

//Add custom posts type with categories
function custom_post_type() {

register_post_type( 'news', array(
  'labels' => array(
    'name' => 'News',
    'singular_name' => 'News item',
    'all_items' => 'All news items',
  ),
  'public' => true,
  'menu_position' => 20,
  'supports' => array( 'title', 'editor', 'thumbnail'),
  'taxonomies' => array('category')
));

register_post_type( 'projects', array(
  'labels' => array(
    'name' => 'Projects',
    'singular_name' => 'Project',
	   'all_items' => 'All projects',
   ),
  'public' => true,
  'menu_position' => 21,
  'supports' => array( 'title', 'editor', 'thumbnail'),
  'taxonomies' => array('category','post_tag')
));

}
add_action( 'init', 'custom_post_type' );

//Set 'Projects' as the default category for post type 'Projects'
add_filter( 'default_content', function ( $content, $post ) {
    if ( ! is_admin() ) {
        return $content;
    }

    $screen = get_current_screen();

    if ( 'post' === $screen->base && 'add' === $screen->action && 'projects' === $screen->post_type ) {
        wp_set_object_terms( $post->ID, 'Projects', 'category' ); // 'News' is the custom taxonomy(category) and 'category' is the taxonomy term
    }

    if ( 'post' === $screen->base && 'add' === $screen->action && 'news' === $screen->post_type ) {
        wp_set_object_terms( $post->ID, 'News', 'category' ); // 'Blog posts' is the custom taxonomy(category) and 'category' is the taxonomy term
    }

    return $content;
}, 10, 2 );

//Add Custom Post Types to Tags and Categories Archives page
function add_custom_types_to_tax( $query ) {
	if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {

		// Get all your post types
		$post_types = get_post_types();

		$query->set( 'post_type', $post_types );
		return $query;
	}
}

add_filter( 'pre_get_posts', 'add_custom_types_to_tax' );


//Add Google API Key so that we can use it for the custom fields on the about page
function my_acf_init() {

	acf_update_setting('google_api_key', 'AIzaSyAteV_t1zG5Vqr1Jkhi1pgAyMJ2ypKl-8M');
}

add_action('acf/init', 'my_acf_init');

//Change the sorting order of the projects and news
add_action( 'pre_get_posts', 'my_change_sort_order');
  function my_change_sort_order($query){
    if(is_archive()):
     //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
       //Set the order ASC or DESC
       $query->set( 'order', 'DESC' );
       //Set the orderby
       $query->set( 'orderby', 'date' );
    endif;
};


add_filter( 'get_the_archive_title', function ($title) {
  if ( is_category() ) {
      $title = sprintf( __( '%s' ), single_cat_title( '', false ) );
    } elseif ( is_tag() ) {
      $title = sprintf( __( '%s' ), 'Tagged with: <span>' . single_tag_title( '', false ) . '</span>') ;
    } elseif ( is_author() ) {
      $title = sprintf( __( '%s' ), '<span class="vcard">' . get_the_author() . '</span>' );
    } elseif ( is_year() ) {
      $title = sprintf( __( '%s' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
    } elseif ( is_month() ) {
      $title = sprintf( __( '%s' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
    } elseif ( is_day() ) {
      $title = sprintf( __( '%s' ), get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) );
    } elseif ( is_post_type_archive() ) {
      $title = sprintf( __( '%s' ), post_type_archive_title( '', false ) );
    } elseif ( is_tax() ) {
      $tax = get_taxonomy( get_queried_object()->taxonomy );
      $title = sprintf( __( '%1$s: %2$s' ), $tax->labels->singular_name, single_term_title( '', false ) );
    } else {
      $title = __( '' );
    }
  return $title;
});
?>
