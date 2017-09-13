<?php /* Template Name: Výpis galerií */ ?>

<?php get_header();?>
<!-- get specified CSS -->
<link  rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/tpl-all-galleries.css">
<!-- modal template -->

<div id="content" class="tpl-all-galleries">

<div id="gallery-header">
  <h1>Galerie</h1>

  <div id="button-wrapper-gradient-holder">
    <div id="school-year-buttons-wrapper">
    <?php

    $years = array();
    query_posts( array(
    'category_name'  => 'all-galleries',
    'posts_per_page' => -1,
    'date_query' => array(
        array(
          'after' => '2012-09-01',
        ),
        'inclusive' => true,
      ),
    ) );

    // Start the Loop
    if ( have_posts() ) : while ( have_posts() ) : the_post();

    // Create "year" subcategories
    $originalDate = the_date( 'Ynd', '', '', FALSE );
    // If got blank "", it means the date is the same as previous one
    if ( $originalDate == "" ) {
      continue;
    }
    // Parse date data
    $date_added_year = substr( $originalDate, 0, 4);
    $date_added_month_day = substr( $originalDate, 4 );
    $post_school_year;

    // Get the post's school year
    // 831 hence 31. 8. [year]
    if ( $date_added_month_day > 831 ) {
      $post_school_year = $date_added_year . "/" . ($date_added_year + 1);
    } else {
      $post_school_year = ($date_added_year - 1) . "/" . $date_added_year;
    }

    if ( !(in_array( $post_school_year , $years )) ) {
      array_push( $years , $post_school_year );
    }
    
    endwhile; else : 

      echo "<p>Obsah se nepodařilo získat 😟, o chybě kontaktujte ✍ správu školy.</p>";

    endif;

    wp_reset_postdata();

    // Print year bubttons
    rsort( $years );

    for ($i=0; $i < count($years); $i++)
    {
      if ( isset($_GET['selected_year_fs'])) 
      {
        $selected_year_fs = intval( htmlspecialchars( $_GET['selected_year_fs'] ));
        if ( $selected_year_fs === intval( substr($years[$i], 0, 4) ) )
        {
          echo "<div class='button-school-year selected' ";
          echo "data='" . $years[$i] . "'>" . $years[$i] . "</div>";
          continue;
        }
      } else {
        if ( $i === 0)
        {
          echo "<div class='button-school-year selected' ";
        }
      }
      echo "<div class='button-school-year' ";
      echo "data='" . $years[$i] . "'>" . $years[$i] . "</div>";

    }
    ?>

    </div>
  </div>
</div>

<div id="content-single-page" class="clear-both">
  <?php
  // start loop for most recent school year
  // The Query

  // 'fs' stands for 'first semestr'
  if ( isset($_GET['selected_year_fs']) ) 
  {
    $firstSemestr = intval( htmlspecialchars( $_GET['selected_year_fs'] ));
  } else 
  {
    $firstSemestr = intval( substr($years[0], 0, 4) );
  }

  $secondSemestr = $firstSemestr + 1;

  $the_query = new WP_Query( array(
    'category_name' => 'all-galleries',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'date_query' => array(
      'after' => array(
        'year' => $firstSemestr,
        'month' => 8,
        'day' => 31
        ),
      'before' => array(
        'year' => $secondSemestr,
        'month' => 9,
        'day' => 1
        )
      )
    ) );

  // Printing galleries
  echo '<ul id="listing-found-galleries-container">';
  if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      ?>
      <li>
        <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
            <?php the_post_thumbnail(); ?>
          </a>
        <?php endif; ?>
        <div class="title-overlay-container">
          <a class="title" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
            <?php the_title(); ?>
          </a>
          <span class="gallery-date"><?php the_time('j. F, Y'); ?></span>
        </div>
      </li>
      <?php
    }
    echo '</ul>';
    /* Restore original Post Data */
    wp_reset_postdata();
  } else {
    echo "<p class='error-message'>Galerie z roku <strong>" . htmlspecialchars($_GET['selected_year_fs']) . "</strong> tu bohužel nemáme.</p>";
  }
  ?>

</div>

<!-- gallery REST API load -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/gallery-REST-API-loader.js"></script>

<?php get_footer();?>