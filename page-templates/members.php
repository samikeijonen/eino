<?php
/**
 * Template Name: Members
 *
 * @package Eino
 * @subpackage Template
 * @since 0.1.0
 */ 

get_header(); // Loads the header.php template. ?>

	<div id="content" class="hfeed" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

					<header class="entry-header">
						<h1 class="entry-title"><?php single_post_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						
						<?php the_content(); ?>

						<?php get_template_part( 'members-loop' ); // Loads the member-loop.php template. ?>

						<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'eino' ), 'after' => '</p>' ) ); ?>
							
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>
					</footer><!-- .entry-footer -->

				</article><!-- .hentry -->

				<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

		<?php endif; ?>

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>