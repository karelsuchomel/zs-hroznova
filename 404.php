<?php get_header();?>

<!-- get specified CSS -->
<link  rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/404.css">

<div id="content">
  <div id="content-single-page" class="clear-both">

  <!-- Start the Loop. -->
  <div id="error-code-container">404</div>
  <div id="error-tip-container">
  	je nám to trapné...<br>
 		stránka s tímto odkazem neexistuje.
  </div>
  <div id="buttons-container">
  	<?php include_once('template-parts/go-back-link.php'); ?>
  	<a href="<?php echo get_home_url(); ?>" class="home-link">Hlavní strana</a>
  </div>
  </div>
</div>

<?php get_footer();?>