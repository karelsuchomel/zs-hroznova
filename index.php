<?php
if (!(isset($_COOKIE["info-card-closed"]))) {
  setcookie("info-card-closed", "FALSE", time()+(31536000), '/');
}
?>
<?php get_header();?>

<?php require_once('template-parts/navigation/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">

  <div id="show-info-card"
  <?php if((isset($_COOKIE["info-card-closed"])) && $_COOKIE["info-card-closed"] == "TRUE" ) { ?>
    style="display: block;"
  <?php } ?>
  >
    Zobrazit kartu s informacemi
    <img src="<?php bloginfo('template_directory'); ?>/assets/images/arrow-down-icon.svg">
  </div>


  <?php require_once('template-parts/navigation/menu-side-list.php') ?>

  <div id="content" class="clear-both">

    <!-- Card with most searched information -->
    <?php require_once('template-parts/front-page/info-card.php'); ?>

    <!-- Listing posts -->
    <div id="tab-switcher" class="clear-both">
      <div id="posts" class="tab-button opened">Příspěvky</div>
      <div id="agenda" class="tab-button">Nadcházející akce</div>
      <div class="tab-divider"></div>
    </div>
    <div id="posts-wrap" class="size-medium">

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

    <?php require_once('template-parts/front-page/agenda-list.php') ?>

    <div id="founder-partner-tags" class="clear-both">
      <img class="logo-partner-school" src="<?php bloginfo('template_directory'); ?>/assets/images/logo-partner-school.jpg">
      <span class="founder-container">
        <img class="founder-shield" src="<?php bloginfo('template_directory'); ?>/assets/images/znak-mc-brno-stred-small.jpg">
        Zřizovatel: Městská část<br> Brno-střed
      </span>
    </div>

  </div>

</div>

<?php

get_footer();

?>
