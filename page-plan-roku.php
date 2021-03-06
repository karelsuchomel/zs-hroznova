<?php get_header();?>

<div id="content">
<div id="content-single-page">

<!-- Start the Loop. -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <div class="post-wrap clear-both">
    <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

    <small>
      autor: <?php the_author_posts_link(); ?>, <?php the_time('F jS, Y'); ?>
    </small>

    <div class="basic-info-wrap">
      <p>
        <?php the_content(); ?>
        <br>
        <br>
      </p>
    </div>
  </div>
    
<?php endwhile; else : ?>
<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<!-- REALLY stop The Loop. -->
<?php endif; ?>
</div>

<?php get_footer();?>