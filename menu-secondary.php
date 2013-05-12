<?php if ( has_nav_menu( 'secondary' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'secondary',
			'container'       => 'nav',
			'container_id'    => 'menu-secondary',
			'container_class' => 'menu',
			'menu_id'         => 'menu-secondary-items',
			'depth'           => 1,
			'menu_class'      => 'menu-items',
			'fallback_cb'     => '',
			'items_wrap'      => '<div class="assistive-text skip-link"><a href="#content" title="' . esc_attr__( 'Skip to content', 'eino' ) . '">' . __( 'Skip to content', 'eino' ) . '</a></div><div class="wrap"><ul id="%1$s" class="%2$s">%3$s</ul></div>'
		)
	);

} ?>