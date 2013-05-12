<?php if ( is_active_sidebar( 'front-page' ) ) { ?>

	<aside id="sidebar-front-page" class="sidebar">
		<div class="wrap-inside">

		<?php dynamic_sidebar( 'front-page' ); ?>
		
		</div><!-- .wrap-inside -->	
	</aside><!-- #sidebar-front-page .aside -->

<?php } ?>