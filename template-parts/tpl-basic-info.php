<?php /* Template Name: Základní informace */ ?>

<?php get_header();?>
<!-- get specified CSS -->
<link  rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/tpl-basic-info.css">
<!-- modal template -->

<div id="content" class="tpl-basic-info">

  <div class="header-basic-info clear-both">
    <div class="school-picture"></div>
    <div class="open-map-notification">
      <a href="https://www.google.cz/maps/place/Z%C3%A1kladn%C3%AD+%C5%A1kola+Brno,+Hroznov%C3%A1+1,+p%C5%99%C3%ADsp%C4%9Bvkov%C3%A1+organizace/@49.1938391,16.5707481,19z/data=!4m13!1m7!3m6!1s0x4712942d8048d0eb:0x5009e29bfbce85!2zSHJvem5vdsOhIDY1LzEsIDYwMyAwMCBCcm5vLXN0xZllZC1QaXPDoXJreQ!3b1!8m2!3d49.1939583!4d16.5711638!3m4!1s0x0:0x9db2cad388ef8fe7!8m2!3d49.1939002!4d16.5711587" target="_blank">Zobrazit na mapě</a>
    </div>
  </div>

  <div id="content-single-page">

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

<?php

get_footer();

?>