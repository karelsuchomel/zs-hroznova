<?php /* Template Name: Projekty */ ?>

<?php get_header();?>
<!-- get specified CSS -->
<link  rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/tpl-spadova-oblast.css">
<!-- modal template -->

<div id="content" class="tpl-spadova-oblast">

<div id="content-single-page">

<!-- Start the Loop. -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php require_once('singular/singular-title-without-date.php');?>

	<?php the_content(); ?>

	<a href="<?php echo get_home_url(); ?>" class="home-link">Hlavní strana</a>

<?php endwhile; else : ?>
<p><?php _e( 'Obsah se nepodařilo získat 😟, o chybě kontaktujte ✍ správu školy.' ); ?></p>
<!-- REALLY stop The Loop. -->
<?php endif; ?>

<p>
<a href="<?php echo get_home_url(); ?>" class="home-link">Hlavní strana</a>
</p>

</div>

<?php

get_footer();

?>