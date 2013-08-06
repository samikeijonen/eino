<article <?php hybrid_post_attributes(); ?>>

	<?php if ( is_singular( get_post_type() ) ) { ?>

		<header class="entry-header">
			<h1 class="entry-title"><?php single_post_title(); ?></h1>
			<?php echo apply_atomic_shortcode( 'entry_byline', '<div class="entry-byline">' . __( 'Price:', 'eino' ) . ' ' . eino_edd_the_price( get_the_ID() ) . '</div>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'eino' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-terms before="Posted in " taxonomy="category"] [entry-terms before="| Tagged "]', 'eino' ) . '</div>' ); ?>
		</footer><!-- .entry-footer -->

	<?php } else { ?>

		<header class="entry-header">
			<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'eino-thumbnail-download', 'image_class' => 'eino-download', 'width' => 330, 'height' => 330, 'default_image' => trailingslashit( get_template_directory_uri() ) . 'images/archive_default.png' ) ); ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
			<?php the_excerpt(); ?>     
			<?php if ( function_exists( 'edd_download_info_purchase_demo_link' ) ) { ?>
				<div class="eino-purchase-demo-link"><?php edd_download_info_purchase_demo_link(); ?></div>
			<?php } else { ?>
				<p class="eino-download"><?php  echo __( 'Price:', 'eino' ) . ' ' . eino_edd_the_price( get_the_ID() ) ?></p>
			<?php } ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'eino' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-summary -->

	<?php } ?>

</article><!-- .hentry -->