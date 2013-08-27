<?php
/**
 * Add support for custom background.
 *
 * @package Eino
 * @subpackage Includes
 * @since 0.1.0
 */

/* Custom background. */
add_theme_support( 
	'custom-background',
	array( 
		'default-color' => apply_filters( 'eino_default_bg', '232323' ),
		'default-image' => trailingslashit( get_template_directory_uri() ) . 'images/eino_bg_default.jpg', // Background image default
		'wp-head-callback' => 'eino_custom_background_callback'
		)
);

/**
 * This is a fix for when a user sets a custom background color with no custom background image.
 * And it takes over pretty much everything what it comes to custom backgrounds.
 *
 * @since  0.1.0
 * @access public
 * @link   http://core.trac.wordpress.org/ticket/16919
 * @return void
 */
function eino_custom_background_callback() {

	/* Get the background image. */
	$image = set_url_scheme( get_background_image() );
	
	/* Get the random background image if user wants it. */
	if ( 'random' == get_theme_mod( 'use_random_bg', 'not-random' ) )
		$image = eino_get_random_image();
	
	/* If there's an image, set default and background image only for larger screens. */
	if ( !empty( $image ) ) {
		$color = get_background_color();

	/* Set color scheme background colors. Remove filter if you want to use WordPress custom background color.
	*
	* Code in child theme setup function: add_filter( 'eino_use_color_scheme_bg', '__return_false' );
	*/
	
	$eino_use_color_scheme_bg = apply_filters( 'eino_use_color_scheme_bg', true );
	
	if( $eino_use_color_scheme_bg ) {
	
		if( '1' == get_theme_mod( 'color_scheme') )
			$color = '232323';
	
		if( '2' == get_theme_mod( 'color_scheme') )
			$color = 'f2f2f2';
			
		if( '3' == get_theme_mod( 'color_scheme') )
			$color = 'f9e4de';
			
		if( '4' == get_theme_mod( 'color_scheme') )
			$color = 'e6eff7';
			
		if( '5' == get_theme_mod( 'color_scheme') )
			$color = 'eaf9cd';
			
		if( '6' == get_theme_mod( 'color_scheme') )
			$color = 'fff';
			
		if( '7' == get_theme_mod( 'color_scheme') )
			$color = 'fff';
		
	}

		$style = $color ? "background-color: #$color;" : '';

		if ( $image ) {
			$image = " background-image: url('$image');";

			$repeat = get_theme_mod( 'background_repeat', 'no-repeat' );
			if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
				$repeat = 'repeat';
			$repeat = " background-repeat: $repeat;";

			$position = get_theme_mod( 'background_position_x', 'center' );
			if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
				$position = 'left';
				
			$eino_bg_position = esc_attr( apply_filters( 'eino_bg_position', 'top' ) );
			$position = " background-position: $eino_bg_position $position;";

			$attachment = get_theme_mod( 'background_attachment', 'fixed' );
			if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
				$attachment = 'scroll';
			$attachment = " background-attachment: $attachment;";

			$style_with_image = $image . $repeat . $position . $attachment;
		}
		
		$eino_use_custom_bg_media = apply_filters( 'eino_use_custom_bg_media', true );
		
		/* If $eino_use_custom_bg_media is set to true, use background image inside @media. Else use without @media. 
		 *
		 * Code in child theme setup function: add_filter( 'eino_use_custom_bg_media', '__return_false' );
		 */
		if( $eino_use_custom_bg_media ) {
		?>
			<style type="text/css">
			body.custom-background { <?php echo trim( $style ); ?> }
			@media only screen and (min-width: <?php echo esc_attr( apply_filters( 'eino_bg_min_width', '37.5' ) ); ?>em) {
			body.custom-background { <?php echo trim( $style_with_image ); ?> }
			<?php if ( 'fullscreen' == get_theme_mod( 'use_full_screen_bg', 'fullscreen' ) ) { ?>
				body.custom-background {
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;	
				}
			<?php } ?>
			}
			.ie7 body.custom-background, .ie8 body.custom-background { <?php echo trim( $style_with_image ); ?> }
			</style>
		<?php
		}
		else {
		?>
			<style type="text/css">
			body.custom-background { <?php echo trim( $style ); ?> }
			body.custom-background { <?php echo trim( $style_with_image ); ?> }
			<?php if ( 'fullscreen' == get_theme_mod( 'use_full_screen_bg', 'fullscreen' ) ) { ?>
				body.custom-background {
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;	
				}
			<?php } ?>
			</style>
		<?php
		}
			return;
		}

	/* Get the background color. */
	$color = get_background_color();

	/* If no background color, return. */
	if ( empty( $color ) )
		return;

	/* Use 'background' instead of 'background-color'. */
	$style = "background: #{$color};";
	
	/* Set color scheme background colors. Remove filter if you want to use WordPress custom background color.
	*
	* Code in child theme setup function: add_filter( 'eino_use_color_scheme_bg', '__return_false' );
	*/
	
	$eino_use_color_scheme_bg = apply_filters( 'eino_use_color_scheme_bg', true );
	
	if( $eino_use_color_scheme_bg ) {
	
		if( '1' == get_theme_mod( 'color_scheme') )
			$style = "background: #232323;";
	
		if( '2' == get_theme_mod( 'color_scheme') )
			$style = "background: #f2f2f2;";
			
		if( '3' == get_theme_mod( 'color_scheme') )
			$style = "background: #f9e4de;";
			
		if( '4' == get_theme_mod( 'color_scheme') )
			$style = "background: #e6eff7;";
			
		if( '5' == get_theme_mod( 'color_scheme') )
			$style = "background: #eaf9cd;";
			
		if( '6' == get_theme_mod( 'color_scheme') )
			$style = "background: #fff;";
			
		if( '7' == get_theme_mod( 'color_scheme') )
			$style = "background: #fff;";
	
	}
	
?>
<style type="text/css">body.custom-background { <?php echo trim( $style ); ?> }</style>
<?php

}

/**
 * Get random background image.
 *
 * @since  0.1.0
 */
function eino_get_random_image() {

	$eino_random_images = get_posts( array( 'numberposts' => 1, 'post_type' => 'attachment', 'meta_key' => '_wp_attachment_is_custom_background', 'meta_value' => get_option( 'stylesheet' ), 'orderby' => 'rand', 'nopaging' => true ) );
	
	foreach ( (array) $eino_random_images as $eino_random_image ) {
		$eino_random_image = esc_url_raw( $eino_random_image->guid );
	}
	
	return $eino_random_image;
	
}

?>