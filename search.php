<?php get_header();?>

<div id="content">
  
<!-- listing posts -->
<div id="search-wrap">

<!-- Start the Loop. -->
<?php if ( have_posts() ) { 

	while ( have_posts() ) { the_post(); ?>

  <div class="post-wrap clear-both">
    <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

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
    
<?php } }else{ ?>
<p>
	<h3>Nic jsme nenašli</h3>
	<img id="nothing-found-image" src="<?php bloginfo('template_directory'); ?>/assets/images/nothing_found.png">
</p>
<!-- REALLY stop The Loop. -->
<?php } ?>
</div>

<?php

get_footer();

?>