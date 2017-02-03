<?php get_header();?>

<?php require_once('template-parts/navigation/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">

  <?php require_once('template-parts/navigation/menu-side-list.php') ?>

  <div id="content">
    <div id="content-single-page">

    <!-- Start the Loop. -->
    <h1>Well, there is no page like that...</h1>
    <img src="<?php bloginfo('template_directory'); ?>/assets/images/404-reaction.gif">

    </div>
  </div>

</div>

<?php

get_footer();

?>