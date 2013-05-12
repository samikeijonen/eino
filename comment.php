<li id="comment-<?php comment_ID(); ?>" class="<?php hybrid_comment_class(); ?>">

	<div class="comment-wrap">

		<?php echo hybrid_avatar(); ?>

		<?php echo apply_atomic_shortcode( 'comment_meta', '<div class="comment-meta"><span class="comment-author vcard">[comment-author]</span> <span class="published">[comment-published]</span> [comment-permalink before="&middot; "] [comment-edit-link before="&middot; "] [comment-reply-link before="&middot; "]</div>' ); ?>

		<div class="comment-content">
			<?php comment_text(); ?>
		</div><!-- .comment-content -->
	
	</div><!-- .comment-wrap -->
	
<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>