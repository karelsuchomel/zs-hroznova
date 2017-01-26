<?php
if (!(isset($_COOKIE["info-card-closed"]))) {
  setcookie("info-card-closed", "FALSE", time()+(31536000));
}
?>
<?php get_header();?>

<?php require_once('layout/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">

  <?php require_once('layout/menu-side-list.php') ?>

  <div id="content">

    <!-- card with most searched information -->
    <?php
    if ($_COOKIE["info-card-closed"] == "FALSE") {
      require_once('layout/info-card.php');
    }
    ?>

    <!-- listing posts -->
    <div id="tab-switcher" class="clear-both">
      <div id="posts" class="tab-button opened">Příspěvky</div>
      <div id="agenda" class="tab-button">Nadcházející akce</div>
      <hr class="tab-divider">
    </div>
    <div id="posts-wrap" class="size-medium">

    <!-- Start the Loop. -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <?php get_template_part('content', get_post_format()); ?>
        
    <?php endwhile; ?>

    </div>
    <div id="pagination-wrap">
      <?php echo paginate_links(); ?>
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
