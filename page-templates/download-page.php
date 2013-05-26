<?php
/**
 * Template Name: Download Page
 *
 * @package Eino
 * @subpackage Template
 * @since 0.1.0
 */

get_header(); // Loads the header.php template. ?>

	<div id="content" class="hfeed" role="main">
	
	<?php get_sidebar( 'front-page' ); // Loads the sidebar-front-page.php template. ?>
	
		<?php
	
		/* Set custom query to show download items. */
		$eino_download_args = apply_filters( 'eino_front_page_download_arguments', array(
			'post_type' => 'download',
			'posts_per_page' => 3
		) );
			
		$eino_downloads = new WP_Query( $eino_download_args );
	
		?>

		<?php $eino_latest_download = esc_attr( apply_filters( 'eino_front_page_latest_download', __( 'Latest Downloads', 'eino' ) ) ); ?>
			
		<h3 id="eino-latest-download"><?php printf( __( '%1$s', 'eino' ), $eino_latest_download ); ?></h3>
	
		<?php if ( $eino_downloads->have_posts() ) : ?>

			<?php while ( $eino_downloads->have_posts() ) : $eino_downloads->the_post(); ?>

				<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
				
					<header class="entry-header">
						<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'eino-thumbnail-download', 'image_class' => 'eino-download', 'width' => 330, 'height' => 330, 'default_image' => trailingslashit( get_template_directory_uri() ) . 'images/archive_default.png' ) ); ?>
					</header><!-- .entry-header -->

					<div class="entry-summary">
						<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
						<?php the_excerpt(); ?>
						<p class="eino-download"><?php echo __( 'Price:', 'eino' ) . ' ' . eino_edd_the_price( get_the_ID() ) ?></p>
						<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'eino' ) . '</span>', 'after' => '</p>' ) ); ?>
					</div><!-- .entry-summary -->

				</article><!-- .hentry -->

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

		<?php endif; wp_reset_query(); // reset query ?>

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>