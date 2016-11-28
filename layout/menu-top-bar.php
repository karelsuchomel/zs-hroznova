<nav id="top-bar">
  <div id="menu-top-bar" class="clear-both">

  	<a id="logo-wrapper" href="<?php echo get_home_url(); ?>">
  		<img src="<?php bloginfo('template_directory'); ?>/img/logo-dark-green.png" alt="logo">
  	</a>

    <?php

    $args = array('theme_location' => 'menu-top-bar');

    wp_nav_menu( $args );

    ?>

  </div>
</nav>
