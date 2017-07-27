<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <title><?php bloginfo('name');?></title>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="description" content="Základní škola Brno, Hroznová 1">
    <meta name="keywords" content="Základní škola Brno, Hroznová 1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Links-->
    <!-- Fonts-->
    <!-- Open Sans Light 300, Light Italic, Normal 400, Semi-bold 600, Bold 700-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600,700&amp;subset=latin-ext" rel="stylesheet">
    <!-- JS  -->
    <!-- Include google RECAPTCHA API -->
    <script type="text/javascript"  src='https://www.google.com/recaptcha/api.js'></script>
    <!-- jQuery -->
    <script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <?php wp_head(); ?>
  </head>
<body <?php body_class(); ?> >

<?php require_once('template-parts/navigation/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">
<div id="side-panel-bg-fix"></div>

<?php require_once('template-parts/navigation/menu-side-list.php') ?>
