<?php
/**
 * 404 Template
 *
 * 404 template is used when an invalid url is visited.
 *
 * @package    Eino
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */

@header( 'HTTP/1.1 404 Not found', true, 404 );

get_header(); // Loads the header.php template. ?>

	<div id="content" class="hfeed" role="main">

		<article id="post-0" class="<?php hybrid_entry_class(); ?>">

			<header class="entry-header">
				<h1 class="error-404-title entry-title"><?php _e( 'What happened!?', 'eino' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
					
				<p>
					<?php printf( __( "You tried going to %s, which doesn't exist. You can try navigate or search.", 'eino' ), '<code>' . home_url( esc_url( $_SERVER['REQUEST_URI'] ) ) . '</code>' ); ?>
				</p>
			
				<?php get_search_form(); // Loads the searchform.php template. ?>

			</div><!-- .entry-content -->

		</article><!-- .hentry -->

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>