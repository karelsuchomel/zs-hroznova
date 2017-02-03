<?php

// custom meta boxes for administration
require_once('custom-meta-box-setup.php');

// import stylesheet
function learningWordPress_resources () {
  wp_enqueue_style('style', get_stylesheet_uri());
  wp_enqueue_script('page-behave', get_template_directory_uri() . '/assets/js/main.js', array(), 1.1, true );
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
	set_post_thumbnail_size( 252, 189, true );
	// add post format support
	add_theme_support('post-formats', array('aside', 'gallery', 'image'));

}

add_action('after_setup_theme', 'zshroznova_theme_setup');

// Customize Appearance Options
// Controls (UI in appearance -> customize)
// Settings (save to Database)
// Sections (Groups)
function zsh_theme_customize_register($wp_customize) {

	$wp_customize->add_setting('zsh_base_color', array(
		'default' => '#27b240',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('zsh_light_base_color', array(
		'default' => '#39c64e',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('zsh_dark_base_color', array(
		'default' => '#383838',
		'transport' => 'refresh',
	));

	$wp_customize->add_section('zsh_standard_colors', array(
		'title' => __('Standartní barvy', 'zs-hroznova'), // on screen label
		'priority' => 30,
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'zsh_base_color_control', array(
			'label' => __('Základní barva', 'zs-hroznova'),
			'section' => 'zsh_standard_colors',
			'settings' => 'zsh_base_color',
	)) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'zsh_light_base_color_control', array(
			'label' => __('Základní barva - světlá', 'zs-hroznova'),
			'section' => 'zsh_standard_colors',
			'settings' => 'zsh_light_base_color',
	)) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'zsh_dark_base_color_control', array(
			'label' => __('Základní barva - tmavá', 'zs-hroznova'),
			'section' => 'zsh_standard_colors',
			'settings' => 'zsh_dark_base_color',
	)) );

}

add_action('customize_register', 'zsh_theme_customize_register');



// Output customize CSS
function zsh_customize_css() { ?>

	<style>
		/*zsh_base_color*/
		nav#top-bar {
		  background: <?php echo get_theme_mod('zsh_base_color') ?>;
		}
		#menu-top-bar #logo-wrapper {
		  background-color: <?php echo get_theme_mod('zsh_base_color') ?>;
		}
		.menu-horni-lista-container ul#menu-horni-lista li a {
		  background: <?php echo get_theme_mod('zsh_base_color') ?>;
		}
		nav#side-list #searchform-container .underline-animated {
		  background-color: <?php echo get_theme_mod('zsh_base_color') ?>;
		}
		nav#side-list ul#menu-bocni-seznam > li:before {
		  background: <?php echo get_theme_mod('zsh_base_color') ?>;
		}
		#agenda-list-wrap .day-segment .date-label .dot:before {
		  background: <?php echo get_theme_mod('zsh_base_color') ?>;
		}
		#search-wrap form.search-again #searchform-container .underline-animated {
		  background-color: <?php echo get_theme_mod('zsh_base_color') ?>;
		}
		#search-wrap .post-wrap h2:hover, #search-wrap .post-wrap h2:active {
		  color: <?php echo get_theme_mod('zsh_base_color') ?>;
		}
		/*zsh_light_base_color*/
		#menu-top-bar #logo-wrapper:hover {
		  background-color: <?php echo get_theme_mod('zsh_light_base_color') ?>;
		}
		.menu-horni-lista-container ul#menu-horni-lista li a:active {
		  background: <?php echo get_theme_mod('zsh_light_base_color') ?>;
		}
		.icon-hamburger-menu:active {
		  background: <?php echo get_theme_mod('zsh_light_base_color') ?>;
		}
		/*zsh_dark_base_color*/
		#content-single-page p > a {
		  color: <?php echo get_theme_mod('zsh_dark_base_color') ?>;
		}
		nav#side-list ul#menu-bocni-seznam > li a {
		  color: <?php echo get_theme_mod('zsh_dark_base_color') ?>;
		}
		#posts-wrap .post-wrap .basic-info-wrap > a {
		  color: <?php echo get_theme_mod('zsh_dark_base_color') ?>;
		}
		#search-wrap .post-wrap h2 {
		  color: <?php echo get_theme_mod('zsh_dark_base_color') ?>;
		}

	</style>

<?php }

add_action('wp_head', 'zsh_customize_css');

?>