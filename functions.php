<?php

// import stylesheet
function learningWordPress_resources () {
  wp_enqueue_style('style', get_stylesheet_uri());
  wp_enqueue_script('page-behave', get_template_directory_uri() . '/js/main.js', array(), 1.1, true );
}

// so the previous code actualy runs
add_action('wp_enqueue_scripts', 'learningWordPress_resources');




// Filter wp_nav_menu() to add additional links and other output
function new_nav_menu_items($items) {
	$items = $items;
	return $items;
}
add_filter( 'wp_nav_menu_items', 'new_nav_menu_items' );

// theme setup
function zshroznova_theme_setup(){

	// navigation menus
	register_nav_menus(array(
	  'menu-top-bar' => __('Horní lišta'),
	  'menu-side-list' => __('Boční seznam'),
	));

	// add featured image support
	add_theme_support('post-thumbnails');
	// define image sizes
	add_image_size('small-thumbnail', 250, 187, true);


}

add_action('after_setup_theme', 'zshroznova_theme_setup');

?>
