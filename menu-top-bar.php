<nav>
  <div id="menu-top-bar" class="clear-both">

  	<a href="' . home_url( '/' ) . '"><img src="logo-light-green.svg"></a>

    <?php

    $args = array('theme_location' => 'primary');

    wp_nav_menu( $args );

    ?>

  </div>
</nav>
