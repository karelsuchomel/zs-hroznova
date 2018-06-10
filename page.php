<?php get_header();?>

<div id="content">
<div id="content-single-page">

<!-- Start the Loop. -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php require_once('template-parts/singular/singular-title-without-date.php');?>

	<?php the_content(); ?>

	<?php include_once('template-parts/go-back-link.php'); ?>

<?php endwhile; else : ?>
<p><?php _e( 'Obsah se nepodařilo získat 😟, o nedostatku kontaktujte ✍ správu školy.' ); ?></p>
<!-- REALLY stop The Loop. -->
<?php endif; ?>
	
</div>

<?php get_footer();?>