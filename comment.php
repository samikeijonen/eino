<li <?php hybrid_comment_attributes(); ?>>

	<div class="comment-wrap">

		<?php echo hybrid_avatar(); ?>

		<?php echo apply_atomic_shortcode( 'comment_meta', '<div class="comment-meta">[comment-author] [comment-published] [comment-permalink before="&middot; "] [comment-edit-link before="&middot; "] [comment-reply-link before="&middot; "]</div>' ); ?>

		<div class="comment-content">
			<?php comment_text(); ?>
		</div><!-- .comment-content -->
	
	</div><!-- .comment-wrap -->
	
<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>