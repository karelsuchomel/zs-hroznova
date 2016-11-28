<?php get_header();?>

<?php require_once('layout/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">

  <?php require_once('layout/menu-side-list.php') ?>

  <div id="content">


    <!-- Start the Loop. -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <div class="post-wrap clear-both">
        <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

        <div class="basic-info-wrap">
          <p>
            <?php the_content(); ?>
            <br>
            <br>
            <small>
            <?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?>
            </small>
          </p>
        </div>
      </div>
        
    <?php endwhile; else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <!-- REALLY stop The Loop. -->
    <?php endif; ?>
      

  </div>

</div>

<?php

get_footer();

?>