<?php get_header(); // Loads the header.php template. ?>

	<div id="content" class="hfeed" role="main">
		
		<?php if ( get_header_image() && 'content-inside' == get_theme_mod( 'header_image_width' ) ) echo '<div id="eino-header-image"><img class="header-image" src="' . esc_url( get_header_image() ) . '" alt="" /></div>'; ?>

		<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

		<?php get_template_part( 'loop' ); // Loads the loop.php template. ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>