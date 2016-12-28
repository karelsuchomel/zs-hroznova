<nav id="side-list">
	<?php

  $args = array('theme_location' => 'menu-side-list');

  wp_nav_menu( $args );

	get_search_form();
	
  ?>
</nav>
<div id="side-list-fixed-background"></div>
<!-- dimmer -->
<div id="dimmer-content"></div>