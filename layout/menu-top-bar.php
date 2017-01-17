<input type="checkbox" name="toggle-menu" id="toggle-menu-checkbox">
<nav id="top-bar">
  <div id="menu-top-bar" class="clear-both">

  	<a id="logo-wrapper" href="<?php echo get_home_url(); ?>">
  		<img src="<?php bloginfo('template_directory'); ?>/img/logo-light.svg" alt="logo">
  	</a>

  	<label for="toggle-menu-checkbox" class="icon-hamburger-menu">
  		<div id="hamburger-line-1" class="line"></div>
  		<div id="hamburger-line-2" class="line"></div>
  		<div id="hamburger-line-3" class="line"></div>
  	</label>

    <?php

    $args = array('theme_location' => 'menu-top-bar');

    wp_nav_menu( $args );

    ?>

  </div>
</nav>
