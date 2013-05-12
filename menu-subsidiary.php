<?php if ( has_nav_menu( 'subsidiary' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'subsidiary',
			'container'       => 'nav',
			'container_id'    => 'menu-subsidiary',
			'container_class' => 'menu',
			'menu_id'         => 'menu-subsidiary-items',
			'depth'           => 1,
			'menu_class'      => 'menu-items',
			'fallback_cb'     => ''
		)
	);

} ?>