<input type="checkbox" name="toggle-menu" id="toggle-menu-checkbox">
<nav id="top-bar-container">
	<div id="top-bar-menu-container" class="clear-both">

		<label for="toggle-menu-checkbox" class="icon-hamburger-menu">
			<div class="menu-icon-container">
				<div id="hamburger-line-1" class="line"></div>
				<div id="hamburger-line-2" class="line"></div>
				<div id="hamburger-line-3" class="line"></div>
			</div>
			<span>
				Navigace
			</span>
		</label>

		<a id="logo-wrapper" href="<?php echo get_home_url(); ?>">
			<img src="<?php bloginfo('template_directory'); ?>/assets/images/logo-light.svg" alt="logo - Základní škola Brno, Hrnoznová 1">
		</a>

		<!-- search -->

		<input type="checkbox" id="search-box-toggle"
		<?php
		// if there was a query already, show input field

		if (get_search_query()) {
			echo " checked";
		}
		?>
		>

		<form role="search" method="get" id="searchform" class="search-container" action="<?php echo get_home_url(); ?>">
			<div class="mobile-centering-wrapper clear-both">
				<div class="search-field-wrapper">
					<input name="s" id="search-field" type="text" placeholder="Hledat"
					<?php
					// if there was a query already, show input field with it's value

					if (get_search_query()) {
						echo " value=\"" . get_search_query() . "\"";
					}
					?>
					>
					<label id="hide-search-toggle" for="search-box-toggle">
						<svg version="1.1" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
						<metadata>
						<rdf:RDF>
						<cc:Work rdf:about="">
						<dc:format>image/svg+xml</dc:format>
						<dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/>
						<dc:title/>
						</cc:Work>
						</rdf:RDF>
						</metadata>
						<g transform="translate(0 -1032.4)">
						<path d="m10 1036.4a6 6 0 0 0 -6 6 6 6 0 0 0 6 6 6 6 0 0 0 6 -6 6 6 0 0 0 -6 -6zm-2.175 2.9673 2.1773 2.1866 2.1867-2.1773 0.8461 0.8508-2.1867 2.175 2.1773 2.1867-0.85078 0.846-2.1773-2.1866-2.1867 2.1773-0.84609-0.8508 2.1867-2.175-2.1773-2.1867 0.85078-0.846z" fill="#7d7d7d"/>
						</g>
						</svg>
					</label>
				</div>
				<label id="show-search-toggle" for="search-box-toggle"></label>
				<button type="submit" id="searchsubmit">Hledat</button>
			</div>
		</form>

		<?php

		$args = array('theme_location' => 'menu-top-bar','container_id' => 'menu-top-bar-list-container');

		wp_nav_menu( $args );

		?>

	</div>
</nav>
