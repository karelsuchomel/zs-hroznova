<?php /* Template Name: Rozvrhy */ ?>

<?php get_header();?>
<!-- get specified CSS -->
<link  rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/rozvrhy.css">
<!-- modal template -->
<?php require_once('modals/modal-picture-view.php') ?>

<?php require_once('navigation/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">

  <?php require_once('navigation/menu-side-list.php') ?>

  <div id="content">
    <div id="content-single-page" class="tpl-rozvrhy">

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
      
    </div>
  </div>

</div>

<!-- modal picture view script -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/modal-view.js"></script>

<?php

get_footer();

?>