<?php get_header();?>

	<!-- info card -->
	<?php require_once('template-parts/front-page/info-card.php'); ?>

	<div id="content" class="clear-both">

		<!-- Listing posts -->
		<div id="tab-switcher" class="clear-both">
			<div id="posts" class="tab-button opened">Příspěvky</div>
			<div id="agenda" class="tab-button">Nadcházející akce</div>
			<div class="tab-divider"></div>
		</div>

		<div id="posts-wrap" class="size-medium">

		<?php 
		define('__ROOT__', dirname(__FILE__) ); 
		require_once( __ROOT__ . "/inc/time-since-posted.php" );
		$currentTime = time();
		?>

		<!-- Start the loop -->
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part('template-parts/post/content', get_post_format()); ?>
				
		<?php endwhile; ?>

		<div id="pagination-wrap">
			<?php echo paginate_links(); ?>
		</div>
		</div>
		
		<?php else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<!-- Stop the loop -->
		<?php endif; ?>

		<!-- List agenda -->
		<?php require_once('template-parts/front-page/agenda-list.php') ?>

<div id="founder-partner-tags" class="clear-both">
	<img class="logo-partner-school" src="<?php bloginfo('template_directory'); ?>/assets/images/logo-partner-school.jpg">
</div>

<?php get_footer();?>
