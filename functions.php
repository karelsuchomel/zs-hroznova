<?php
//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

// import stylesheet
function zshroznova_resources () 
{
	// main
	wp_enqueue_style('style', get_stylesheet_uri());

	wp_register_style('main.css', get_template_directory_uri() . '/assets/css/main.css', false, NULL, 'all' );
	wp_enqueue_style('main.css');

	wp_register_script( 'main.js', get_template_directory_uri() . '/assets/js/main.js', array(), NULL, true );
	wp_enqueue_script( 'main.js' );

	// Photo swipe - incorporated gallery viewer
	wp_register_style('photoswipe.css', get_template_directory_uri() . '/inc/photoswipe/photoswipe.css', false, NULL, 'all' );
	wp_enqueue_style('photoswipe.css');

	wp_register_style('default-skin.css', get_template_directory_uri() . '/inc/photoswipe/default-skin/default-skin.css', false, NULL, 'all' );
	wp_enqueue_style('default-skin.css');

	wp_register_script( 'photoswipe.min.js', get_template_directory_uri() . '/inc/photoswipe/photoswipe.min.js', array(), NULL, true );
	wp_enqueue_script( 'photoswipe.min.js' );
	
	wp_register_script( 'photoswipe-ui-default.min.js', get_template_directory_uri() . '/inc/photoswipe/photoswipe-ui-default.min.js', array(), NULL, true );
	wp_enqueue_script( 'photoswipe-ui-default.min.js' );

		wp_register_script( 'photoswipe-init.js', get_template_directory_uri() . '/inc/photoswipe/photoswipe-init.js', array(), NULL, true );
	wp_enqueue_script( 'photoswipe-init.js' );
	

	wp_localize_script( 'main.js', 'magicalData', array(
		"nonce" => wp_create_nonce("wp_rest"),
		"siteURL" => get_site_url()
	));
}
add_action('wp_enqueue_scripts', 'zshroznova_resources');

// theme setup
function zshroznova_theme_setup()
{
	// navigation menus
	register_nav_menus(array(
	  'menu-top-bar' => __('Horní lišta'),
	  'menu-side-list' => __('Boční seznam'),
	));

	// remove "auto paragraph feature"
		// remove_filter( 'the_content', 'wpautop' );
		// remove_filter( 'the_excerpt', 'wpautop' );

	// add featured image support
	add_theme_support('post-thumbnails');
	// define image sizes
	set_post_thumbnail_size( 300, 225, true );
	// add post format support
	add_theme_support('post-formats', array('aside', 'image'));

	// add image size for post headers
	// https://codex.wordpress.org/Option_Reference#Media
	update_option( 'thumbnail_size_w', 200 );
	update_option( 'thumbnail_size_h', 150 );
	update_option( 'medium_size_w', 400 );
	update_option( 'medium_size_h', 400 );
	update_option( 'large_size_w', 720 );
	update_option( 'large_size_h', 720 );
}
add_action('after_setup_theme', 'zshroznova_theme_setup');

// use post's front-end styles in TinyMCE text editor
function zshroznova_theme_add_editor_styles() {
	add_editor_style( 'assets/css/editor-styles.css' );
}
add_action( 'admin_init', 'zshroznova_theme_add_editor_styles' );

// remove WordPress emojis
require_once( get_template_directory() . '/inc/remove_wp_emoji.php');

// handle gallery shortcode to work with PSW gallery
require_once( get_template_directory() . '/inc/handle-gallery-shortcode-psw.php');
add_filter( 'post_gallery', 'tfs_render_gallery_shortcode_PSW', 10, 2 );