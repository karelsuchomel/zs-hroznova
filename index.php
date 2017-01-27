<?php
if (!(isset($_COOKIE["info-card-closed"]))) {
  setcookie("info-card-closed", "FALSE", time()+(31536000));
}
?>
<?php get_header();?>

<?php require_once('layout/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">

  <div id="show-info-card"
  <?php if((isset($_COOKIE["info-card-closed"])) && $_COOKIE["info-card-closed"] == "TRUE" ) { ?>
    style="display: block;"
  <?php } ?>
  >
    Zobrazit kartu s informacemi
    <img src="<?php bloginfo('template_directory'); ?>/img/arrow-down-icon.svg">
  </div>


  <?php require_once('layout/menu-side-list.php') ?>

  <div id="content" class="clear-both">

    <!-- card with most searched information -->
    <?php require_once('layout/info-card.php'); ?>

    <!-- listing posts -->
    <div id="tab-switcher" class="clear-both">
      <div id="posts" class="tab-button opened">Příspěvky</div>
      <div id="agenda" class="tab-button">Nadcházející akce</div>
      <div class="tab-divider"></div>
    </div>
    <div id="posts-wrap" class="size-medium">

    <!-- Start the Loop. -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <?php get_template_part('content', get_post_format()); ?>
        
    <?php endwhile; ?>

    <div id="pagination-wrap">
      <?php echo paginate_links(); ?>
    </div>
    </div>
    
    <?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <!-- REALLY stop The Loop. -->
    <?php endif; ?>

    <?php require_once('layout/agenda-list.php') ?>

  </div>

</div>

<?php

get_footer();

?>
