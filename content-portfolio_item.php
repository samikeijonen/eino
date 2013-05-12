<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php if ( is_singular( get_post_type() ) ) { ?>

		<header class="entry-header">
			<h1 class="entry-title"><?php single_post_title(); ?></h1>
			<?php echo apply_atomic_shortcode( 
				'entry_byline', 
				'<div class="entry-byline">' . 
					hybrid_entry_terms_shortcode( array( 'taxonomy' => 'portfolio', 'before' => __( 'Work:', 'eino' ) . ' ' ) ) . 
				'</div>'
			); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'eino' ) . '</span>', 'after' => '</p>' ) ); ?>
			<?php echo eino_get_portfolio_item_link(); // echo portfolio link ?>
		</div><!-- .entry-content -->

	<?php } else { ?>

		<header class="entry-header">
			<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'eino-thumbnail-download', 'image_class' => 'eino-download', 'width' => 330, 'height' => 330, 'default_image' => trailingslashit( get_template_directory_uri() ) . 'images/archive_default.png' ) ); ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
			<?php the_excerpt(); ?>
			<p class="eino-portfolio-item"><?php echo hybrid_entry_terms_shortcode( array( 'taxonomy' => 'portfolio', 'before' => __( 'Work:', 'eino' ) . ' ' ) ); ?></p>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'eino' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-summary -->

	<?php } ?>

</article><!-- .hentry -->