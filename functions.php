<?php
//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

// import stylesheet
function zshroznova_resources () 
{
	wp_enqueue_style('style', get_stylesheet_uri());

	wp_register_style('main.css', get_template_directory_uri() . '/assets/css/main.css', false, NULL, 'all' );
	wp_enqueue_style('main.css');

	wp_register_script( 'main.js', get_template_directory_uri() . '/assets/js/main.js', array(), NULL, true );
	wp_enqueue_script( 'main.js' );

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
	add_editor_style( 'assets/css/admin/editor-styles.css' );
}
add_action( 'admin_init', 'zshroznova_theme_add_editor_styles' );

// remove WordPress emojis
require_once( get_template_directory() . '/inc/remove_wp_emoji.php');

// WordPress Customize feature fot this theme
require_once( get_template_directory() . '/inc/theme_customize_features.php');