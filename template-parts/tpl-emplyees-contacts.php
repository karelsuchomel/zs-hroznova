<?php /* Template Name: Zaměstnanci a kontakty */ ?>

<?php get_header();?>
<!-- get specified CSS -->
<link  rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/tpl-employees-contacts.css">
<!-- modal template -->

<div id="content" class="employees-contacts">
<div id="content-single-page">

<!-- Start the Loop. -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php require_once('singular/singular-title-without-date.php');?>

	<?php the_content(); ?>

	<p><a href="<?php echo get_home_url(); ?>" class="home-link">Hlavní strana</a></p>

<?php endwhile; else : ?>
<p><?php _e( 'Obsah se nepodařilo získat 😟, o chybě kontaktujte ✍ správu školy.' ); ?></p>
<!-- REALLY stop The Loop. -->
<?php endif; ?>

</div>

<?php get_footer();?>