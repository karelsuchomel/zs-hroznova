<?php get_header();?>

<?php require_once('template-parts/navigation/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">

  <?php require_once('template-parts/navigation/menu-side-list.php') ?>

  <div id="content">
    
    <!-- listing posts -->
    <div id="search-wrap">
    	<form role="search" method="get" id="searchform" class="searchform search-again" action="<?php echo get_home_url(); ?>">
				<div id="searchform-container">
					<input name="s" class="search-field" type="text" placeholder="hledat znovu" value="<?php the_search_query(); ?>">
					<input id="searchsubmit" type="submit">
					<div class="underline-animated"></div>
				</div>
			</form>
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
    	<!-- <script>
    		var host = document.location.origin + document.location.pathname;
    		document.getElementById("nothing-found-image").src= host + "/wp-content/themes/zs-hroznova/img/nothing_found.png";
    	</script> -->
    </p>
    <!-- REALLY stop The Loop. -->
    <?php } ?>
      
    </div>

  </div>

</div>

<?php

get_footer();

?>