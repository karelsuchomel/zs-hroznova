<nav id="side-list">
	<?php

  $args = array('theme_location' => 'menu-side-list');

  wp_nav_menu( $args );

	get_search_form();
	
  ?>
</nav>
<!-- dimmer -->
<div id="dimmer-content"></div>