<?php /* Template Name: Obědy-šablona */ ?>

<?php get_header();?>
<!-- get specified CSS -->
<link  rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/tpl-lunches.css">
<!-- modal template -->
<?php require_once('modals/modal-picture-view.php') ?>

<?php require_once('navigation/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">

  <?php require_once('navigation/menu-side-list.php') ?>

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

    </div>
  </div>

</div>

<!-- modal picture view script -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/modal-view.js"></script>
<!-- pdf.js -->
<script src="<?php bloginfo('template_directory'); ?>/assets/pdf.js/pdf.js"></script>
<!-- setup pdf.js -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/pdf-viewer.js"></script>

<?php

get_footer();

?>