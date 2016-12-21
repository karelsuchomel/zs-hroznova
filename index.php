<?php get_header();?>

<?php require_once('layout/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">

  <?php require_once('layout/menu-side-list.php') ?>

  <div id="content">
    <!-- card with most udeful informations -->
    <div id="info-card-wrap" class="clear-both">
      <img src="<?php bloginfo('template_directory'); ?>/img/zs-drawned.jpg">
      <div class="basic-info-wrap">
        <h1>Výtejte na stránkách základní&nbsp;školy, Hroznová&nbsp;1,&nbsp;Brno</h1>
        <hr>
        <p>
        </p>
      </div>
    </div>

    <!-- listing posts -->
    <div id="posts-wrap">

    <!-- Start the Loop. -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <div class="post-wrap clear-both">
        <h2>
          <?php the_post_thumbnail('small-thumbnail'); ?>
          <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
            <?php the_title(); ?>
          </a>
        </h2>

        <!-- if there is a features image -->
        <?php the_post_thumbnail('small-thumbnail'); ?>

        <div class="basic-info-wrap">
          <p>
            <?php echo wp_trim_words( get_the_content(), 15, '...' ); ?>
            <br />
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

</div>

<?php

get_footer();

?>
