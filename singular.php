<?php get_header();?>

<!-- modal template -->
<?php require_once('template-parts/modals/modal-picture-view.php');?>

<div id="content">
<div id="content-single-page">

<!-- Start the Loop. -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php require_once('template-parts/singular/singular-title.php');?>

	<?php the_content(); ?>
	
	<?php include_once('template-parts/go-back-link.php'); ?>

<?php endwhile; else : ?>
<p><?php _e( 'Obsah se nepodařilo získat 😟, o nedostatku kontaktujte ✍ správu školy.' ); ?></p>
<!-- REALLY stop The Loop. -->
<?php endif; ?>
	
</div>

<!-- modal picture view script -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/modal-view.js"></script>

<?php get_footer();?>