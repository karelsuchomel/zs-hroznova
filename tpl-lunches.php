<?php /* Template Name: Obědy */ ?>

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

    <h1>Obědy</h1>
    <canvas id="the-canvas" style="border:1px solid #CCC;"/>

<script src="<?php bloginfo('template_directory'); ?>/assets/pdf.js/pdf.js"></script>
<script>
PDFJS.getDocument('../../wp-content/uploads/2017/03/2703_03_17.pdf').then(function(pdf) {
  pdf.getPage(1).then(function(page) {
    var scale = 1;
    var viewport = page.getViewport(scale);

    var canvas = document.getElementById('the-canvas');
    var context = canvas.getContext('2d');
    canvas.height = viewport.height;
    canvas.width = 652;

    var renderContext = {
      canvasContext: context,
      viewport: viewport
    };
    page.render(renderContext);
  });
});
</script>
      
    </div>
  </div>

</div>

<!-- modal picture view script -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/modal-view.js"></script>

<?php

get_footer();

?>