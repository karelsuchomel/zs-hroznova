<?php /* Template Name: Výpis galerií */ ?>

<?php get_header();?>
<!-- get specified CSS -->
<link  rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/tpl-all-galleries.css">
<!-- modal template -->
<?php require_once('template-parts/modals/modal-picture-view.php') ?>

<?php require_once('template-parts/navigation/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">

  <?php require_once('template-parts/navigation/menu-side-list.php') ?>

  <div id="content" class="tpl-all-galleries">

    <h1>Galerie</h1>

    <div id="button-wrapper-gradient-holder">
      <div id="chool-year-buttons-wrapper">
      <?php

      $years = array();
      query_posts( 'category_name=all-galleries' );

      // Start the Loop
      if ( have_posts() ) : while ( have_posts() ) : the_post();

      // Create "year" subcategories
      $date_added_year = the_date( 'Y', '', '', FALSE );
      $date_added_month_day = the_date( 'nd', '', '', FALSE );
      $post_school_year;

      // Get the post's school year
      if ( $date_added_month_day > 831 ) {
        $post_school_year = $date_added_year . "/" . ($date_added_year + 1);
      } else {
        $post_school_year = ($date_added_year - 1) . "/" . $date_added_year;
      }

      if ( !(in_array( $post_school_year , $years )) ) {
        array_push( $years , $post_school_year );
        echo "<div class='button-school-year' data='" . $post_school_year . "'>" . $post_school_year . "</div>";
      }
      ?>

      <?php endwhile; else : ?>
      <p><?php _e( 'Obsah se nepodařilo získat 😟, o chybě kontaktujte ✍ správu školy.' ); ?></p>
      <!-- REALLY stop The Loop. -->
      <?php endif; ?>
      </div>
    </div>

    <div id="content-single-page">
      lorem ipsum sit dolor amet
    </div>
  </div>

</div>

<!-- modal picture view script -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/modal-view.js"></script>
<!-- gallery REST API load -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/gallery-REST-API-loader.js"></script>

<?php

get_footer();

?>