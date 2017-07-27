<?php get_header();?>

<!-- modal template -->
<?php require_once('template-parts/modals/modal-picture-view.php');?>

<div id="content">
<div id="content-single-page">

<!-- Start the Loop. -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <div class="post-wrap clear-both">
    <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

    <div class="basic-info-wrap">
      <p>
        <?php the_content(); ?>
        <a href="<?php echo get_home_url(); ?>" class="home-link">Hlavní strana</a>
      </p>
    </div>
  </div>
<?php endwhile; else : ?>
<p><?php _e( 'Obsah se nepodařilo získat 😟, o nedostatku kontaktujte ✍ správu školy.' ); ?></p>
<!-- REALLY stop The Loop. -->
<?php endif; ?>
  
</div>

<!-- modal picture view script -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/modal-view.js"></script>

<?php get_footer();?>