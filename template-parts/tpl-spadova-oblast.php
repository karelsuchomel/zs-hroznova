<?php /* Template Name: Spádová oblast */ ?>

<?php get_header();?>
<!-- get specified CSS -->
<link  rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/tpl-spadova-oblast.css">
<!-- modal template -->

<div id="content" class="tpl-spadova-oblast">

  <div id="content-single-page">

  <!-- Start the Loop. -->
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="post-wrap clear-both">
      <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

      <div class="basic-info-wrap">
        <p>
          <?php the_content(); ?>
          <br>
        </p>
      </div>
    </div>
  <?php endwhile; else : ?>
  <p><?php _e( 'Obsah se nepodařilo získat 😟, o chybě kontaktujte ✍ správu školy.' ); ?></p>
  <!-- REALLY stop The Loop. -->
  <?php endif; ?>

  <div class="district-area-link">
  	<a class="district-area-button" href="http://gis.brno.cz/mapa/spadovost-skol/?lb=zm-brno&lbo=1&lyo=&ly=sps_1%2Csps_2&c=-600674.95%3A-1160655.65&z=8&i=-600843.99%3A-1160592.12" target="_blank">
  		Aplikace<br>spádovost základních škol
  	</a>
  </div>

  </div>

<?php

get_footer();

?>