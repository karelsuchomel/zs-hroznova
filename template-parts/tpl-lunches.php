<?php /* Template Name: Obědy-šablona */ ?>

<?php get_header();?>
<!-- get specified CSS -->
<link  rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/tpl-lunches.css">
<!-- modal template -->
<div id="content">
<div id="content-single-page" class="tpl-lunches">

<h2>Obědy</h2>
<!-- Start the Loop. -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php the_content(); ?>
<?php endwhile; else : ?>
<p><?php _e( 'Obsah se nepodařilo získat 😟, o chybě kontaktujte ✍ správu školy.' ); ?></p>
<!-- REALLY stop The Loop. -->
<?php endif; ?>

<p>
<a href="<?php echo get_home_url(); ?>" class="home-link">Hlavní strana</a>
</p>

</div>

<!-- pdf.js -->
<script src="<?php bloginfo('template_directory'); ?>/assets/pdf.js/pdf.js"></script>
<!-- setup pdf.js -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/pdf-viewer.js"></script>

<?php get_footer();?>