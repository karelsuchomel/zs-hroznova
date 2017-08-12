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
    <!-- Open Sans Light 300, Normal 400, Semi-bold 600-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&amp;subset=latin-ext" rel="stylesheet">
    <?php wp_head(); ?>
  </head>
<body <?php body_class(); ?> >

<?php include_once('inc/analyticstracking.php') ?>

<?php require_once('template-parts/navigation/menu-top-bar.php') ?>

<div id="content-wrap" class="clear-both">
<div id="side-panel-bg-fix"></div>

<?php require_once('template-parts/navigation/menu-side-list.php') ?>
