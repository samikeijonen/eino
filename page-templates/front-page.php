<?php
/**
 * Template Name: Front Page
 *
 * @package Eino
 * @subpackage Template
 * @since 0.1.0
 */
 
  /* For translating page template name. */
__( 'Front Page', 'eino' ); 

get_header(); // Loads the header.php template. ?>

	<div id="content" class="hfeed" role="main">
	
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

					<header class="entry-header">
						<h1 class="entry-title"><?php single_post_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content<?php if( get_theme_mod( 'callout_image' ) ) echo ' eino-callout-image-true'; ?>">
						
						<?php
							
						/* Wrapper for text and url. */
						if ( get_theme_mod( 'callout_text' ) || get_theme_mod( 'callout_url' ) )
							echo '<div id="eino-callout-text-url">';
							
						/* Callout text. */ ?>
						<div id="eino-callout-text">
							<?php the_content(); ?>
						</div> 
						
						<?php
							
						/* Callout link. */
						if ( get_theme_mod( 'callout_url' ) && get_theme_mod( 'callout_url_text' ) )
							echo '<div id="eino-callout-url"><a class="eino-button" href="' . esc_url( get_theme_mod( 'callout_url' ) ) . '">' . esc_attr( get_theme_mod( 'callout_url_text' ) ) . '</a></div>';
							
						/* Wrapper closed. */
						if ( get_theme_mod( 'callout_text' ) || get_theme_mod( 'callout_url' ) )
							echo '</div>';
							
						/* Callout image. */
						if ( get_theme_mod( 'callout_image' ) )
							echo '<div id="eino-callout-image"><a href="' . esc_url( get_theme_mod( 'callout_url' ) ) . '"><img class="eino-callout-image" src="' .  esc_url( get_theme_mod( 'callout_image' ) ) . '" /></a></div>';
							
						?>
							
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>
					</footer><!-- .entry-footer -->

				</article><!-- .hentry -->

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

		<?php endif; ?>
			
		<?php get_sidebar( 'front-page' ); // Loads the sidebar-front-page.php template. ?>

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>