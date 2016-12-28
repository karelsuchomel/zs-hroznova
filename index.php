<?php get_header();?>

<?php require_once('layout/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">

  <?php require_once('layout/menu-side-list.php') ?>

  <div id="content">
    <!-- card with most udeful informations -->
    <div id="info-card-wrap" class="clear-both">
      <img src="<?php bloginfo('template_directory'); ?>/img/zs-drawned.jpg">
      <div class="basic-info-wrap">
        <h1>Vítejte na stránkách základní&nbsp;školy, Hroznová&nbsp;1,&nbsp;Brno</h1>
        <hr>
        <p>
        </p>
      </div>
    </div>

    <!-- listing posts -->
    <div id="posts-wrap">

    <!-- Start the Loop. -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <?php get_template_part('content', get_post_format()); ?>
        
    <?php endwhile; else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <!-- REALLY stop The Loop. -->
    <?php endif; ?>
      
    </div>

    <?php require_once('layout/agenda-list.php') ?>

  </div>

</div>

<?php

get_footer();

?>
