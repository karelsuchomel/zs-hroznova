<input type="checkbox" name="toggle-menu" id="toggle-menu-checkbox">
<nav id="side-list">
	<?php

  $args = array('theme_location' => 'menu-side-list');

  wp_nav_menu( $args );

  ?>
</nav>