<?php get_header();?>

<?php require_once('layout/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">

  <?php require_once('layout/menu-side-list.php') ?>

  <div id="content">
    <!-- card with most udeful informations -->
    <?php require_once('layout/info-card.php') ?>

    <!-- listing posts -->
    <div id="tab-switcher" class="clear-both">
      <div id="posts" class="tab-button opened">Příspěvky</div>
      <div id="agenda" class="tab-button">Nadcházející akce</div>
    </div>
    <div id="posts-wrap" class="size-medium">

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
