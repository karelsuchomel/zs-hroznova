<nav id="side-list">
	<?php

  $args = array('theme_location' => 'menu-side-list','container_id' => 'menu-side-bar-list-container');

  wp_nav_menu( $args );
	
  ?>
</nav>
<div id="side-list-fixed-background-mobile"></div>
<!-- dimmer -->
<div id="dimmer-content"></div>