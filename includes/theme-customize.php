<?php
/**
 * Add logo upload, color schemes, fonts and social links in theme customizer screen.
 *
 * @package Eino
 * @subpackage Includes
 * @since 0.1.0
 */

/* Add logo upload, color schemes, fonts and social links in theme customizer screen. */
add_action( 'customize_register', 'eino_customize_register_stuff' );

/* Print font size in header. */
add_action( 'wp_head', 'eino_print_font_size' );

/* Delete the cached data for font size feature. */
add_action( 'update_option_theme_mods_' . get_stylesheet(), 'eino_font_size_cache_delete' );

/**
 * Add logo upload, portfolio layout and social links in theme customizer screen
 *
 * @since 0.1.0
 */
function eino_customize_register_stuff( $wp_customize ) {

	/* == Logo upload == */

	/* Add the logo upload section. */
	$wp_customize->add_section(
		'logo-upload',
		array(
			'title'      => esc_html__( 'Logo Upload', 'eino' ),
			'priority'   => 60,
			'capability' => 'edit_theme_options'
		)
	);
	
	/* Add the 'logo' setting. */
	$wp_customize->add_setting(
		'logo_upload',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add custom logo control. */
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'logo_image',
				array(
					'label'    => esc_html__( 'Upload custom logo. Recommended max width is 300px.', 'eino' ),
					'section'  => 'logo-upload',
					'settings' => 'logo_upload',
					'priority' => 20,
			) 
		) 
	);
	
	/* == Show logo or avatar == */
	
	/* Add setting do you want to show avatar or logo. */
	$wp_customize->add_setting(
		'show_logo_avatar',
		array(
			'default'           => 'logo',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_html_class',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add logo/avatar control. */
	$wp_customize->add_control(
		'show-logo-avatar',
		array(
			'label'    => esc_html__( 'Choose whether to show Logo or Avatar in Header?', 'eino' ),
			'section'  => 'logo-upload',
			'settings' => 'show_logo_avatar',
			'type'     => 'radio',
			'priority' => 10,
			'choices'  => array(
				'logo'     => esc_html__( 'Show Logo', 'eino' ),
				'avatar'   => esc_html__( 'Show Avatar', 'eino' ),
				'not'      => esc_html__( 'Do not show Logo nor Avatar', 'eino' ),
			)
		)
	);
	
	/* Add avatar email setting. */
	$wp_customize->add_setting(
		'avatar_email',
		array(
			'default'           => get_option( 'admin_email' ),
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_email',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add avatar email control. */
	$wp_customize->add_control(
		'avatar-email',
		array(
			'label'    => esc_html__( 'Avatar Email', 'eino' ),
			'section'  => 'logo-upload',
			'settings' => 'avatar_email',
			'priority' => 30,
			'type'     => 'text'
		)
	);
	
	/* == Color schemes == */
	
	/* Add color scheme setting. */
	$wp_customize->add_setting(
		'color_scheme',
		array(
			'default'           => '0',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add color scheme control. */
	$wp_customize->add_control(
		'color-scheme-control',
		array(
			'label'    => esc_html__( 'Choose Color Scheme', 'eino' ),
			'section'  => 'colors',
			'settings' => 'color_scheme',
			'type'     => 'select',
			'priority' => 1,
			'choices'  => array(
				'0'       => esc_html__( 'Default', 'eino' ),
				'1'       => esc_html__( 'Color Scheme 1', 'eino' ),
				'2'       => esc_html__( 'Color Scheme 2', 'eino' ),
				'3'       => esc_html__( 'Color Scheme 3', 'eino' ),
				'4'       => esc_html__( 'Color Scheme 4', 'eino' ),
				'5'       => esc_html__( 'Color Scheme 5', 'eino' ),
				'6'       => esc_html__( 'Color Scheme 6', 'eino' )
			)
		)
	);
	
	/* == Use premade color scheme or not == */
	
	/* Add setting do you want to use premade color scheme or not. */
	$wp_customize->add_setting(
		'use_premade_colors',
		array(
			'default'           => 'premade',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_html_class',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add color scheme control. */
	$wp_customize->add_control(
		'show-color-scheme',
		array(
			'label'    => esc_html__( 'Choose whether to use premade color schemes or custom ones. If you choose Custom Colors pick Default Color Scheme above. Then click Save/Publish and refresh this page to see live preview.', 'eino' ),
			'section'  => 'colors',
			'settings' => 'use_premade_colors',
			'type'     => 'radio',
			'priority' => 2,
			'choices'  => array(
				'premade'  => esc_html__( 'Use premade color scheme', 'eino' ),
				'custom'   => esc_html__( 'Use Custom Colors', 'eino' )
			)
		)
	);
	
	/* == Use premade full screen background or not == */
	
	/* Add setting do you want to use full screen background or not. */
	$wp_customize->add_setting(
		'use_full_screen_bg',
		array(
			'default'           => 'fullscreen',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_html_class',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add full screen background control. */
	$wp_customize->add_control(
		'use-full-bg',
		array(
			'label'    => esc_html__( 'Choose whether to use full screen background or not.', 'eino' ),
			'section'  => 'background_image',
			'settings' => 'use_full_screen_bg',
			'type'     => 'radio',
			'priority' => 2,
			'choices'  => array(
				'fullscreen'  => esc_html__( 'Use full screen background', 'eino' ),
				'no-fullscreen'   => esc_html__( 'Do not use full screen background', 'eino' )
			)
		)
	);
	
	/* == Use random background or not == */
	
	/* Add setting do you want to use random background or not. */
	$wp_customize->add_setting(
		'use_random_bg',
		array(
			'default'           => 'not-random',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_html_class',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add random background control. */
	$wp_customize->add_control(
		'use-random-bg',
		array(
			'label'    => esc_html__( 'Choose whether to use random background or not.', 'eino' ),
			'section'  => 'background_image',
			'settings' => 'use_random_bg',
			'type'     => 'radio',
			'priority' => 3,
			'choices'  => array(
				'not-random'  => esc_html__( 'Do not use random background', 'eino' ),
				'random'      => esc_html__( 'Use random background', 'eino' )
			)
		)
	);
	
	/* == Font size == */
	
	/* Add font size setting. */
	$wp_customize->add_setting(
		'font_size',
		array(
			'default'           => '16',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add font size control. */
	$wp_customize->add_control(
		'font-size-control',
		array(
			'label'    => esc_html__( 'Choose Body Font Size (pixels)', 'eino' ),
			'section'  => 'fonts',
			'settings' => 'font_size',
			'type'     => 'select',
			'choices'  => array(
				'13'       => esc_html__( '13', 'eino' ),
				'14'       => esc_html__( '14', 'eino' ),
				'15'       => esc_html__( '15', 'eino' ),
				'16'       => esc_html__( '16', 'eino' ),
				'17'       => esc_html__( '17', 'eino' ),
				'18'       => esc_html__( '18', 'eino' ),
				'19'       => esc_html__( '19', 'eino' ),
			)
		)
	);
	
	/* == Social links == */
		
	/* Add the social links section. */
	$wp_customize->add_section(
		'social-links',
		array(
			'title'      => esc_html__( 'Social Links', 'eino' ),
			'priority'   => 200,
			'capability' => 'edit_theme_options'
		)
	);
	
	/* Add the twitter link setting. */
	$wp_customize->add_setting(
		'twitter_link',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add the twitter link control. */
	$wp_customize->add_control(
		'twitter-link',
		array(
			'label'    => esc_html__( 'Twitter URL', 'eino' ),
			'section'  => 'social-links',
			'settings' => 'twitter_link',
			'priority' => 10,
			'type'     => 'text'
		)
	);
	
	/* Add the facebook link setting. */
	$wp_customize->add_setting(
		'facebook_link',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add the facebook link control. */
	$wp_customize->add_control(
		'facebook-link',
		array(
			'label'    => esc_html__( 'Facebook URL', 'eino' ),
			'section'  => 'social-links',
			'settings' => 'facebook_link',
			'priority' => 20,
			'type'     => 'text'
		)
	);
	
	/* Add the rss link setting. */
	$wp_customize->add_setting(
		'rss_link',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add the rss link control. */
	$wp_customize->add_control(
		'rss-link',
		array(
			'label'    => esc_html__( 'RSS URL', 'eino' ),
			'section'  => 'social-links',
			'settings' => 'rss_link',
			'priority' => 30,
			'type'     => 'text'
		)
	);
	
	/* Add the linkedin link setting. */
	$wp_customize->add_setting(
		'linkedin_link',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add the linkedin link control. */
	$wp_customize->add_control(
		'linkedin-link',
		array(
			'label'    => esc_html__( 'Linkedin URL', 'eino' ),
			'section'  => 'social-links',
			'settings' => 'linkedin_link',
			'priority' => 40,
			'type'     => 'text'
		)
	);
	
	/* Add the google plus link setting. */
	$wp_customize->add_setting(
		'google_plus_link',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add the google plus link control. */
	$wp_customize->add_control(
		'google-plus-link',
		array(
			'label'    => esc_html__( 'Google Plus URL', 'eino' ),
			'section'  => 'social-links',
			'settings' => 'google_plus_link',
			'priority' => 50,
			'type'     => 'text'
		)
	);
	
	/* Add the github link setting. */
	$wp_customize->add_setting(
		'github_link',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add the github link control. */
	$wp_customize->add_control(
		'github-link',
		array(
			'label'    => esc_html__( 'Github URL', 'eino' ),
			'section'  => 'social-links',
			'settings' => 'github_link',
			'priority' => 60,
			'type'     => 'text'
		)
	);
	
	/* Add the pinterest link setting. */
	$wp_customize->add_setting(
		'pinterest_link',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add the pinterest link control. */
	$wp_customize->add_control(
		'pinterest-link',
		array(
			'label'    => esc_html__( 'Pinterest URL', 'eino' ),
			'section'  => 'social-links',
			'settings' => 'pinterest_link',
			'priority' => 70,
			'type'     => 'text'
		)
	);
	
	/* Add icon size setting. */
	$wp_customize->add_setting(
		'icon_size',
		array(
			'default'           => 'icon-large',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_html_class',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add icon size control. */
	$wp_customize->add_control(
		'icon-size-control',
		array(
			'label'    => esc_html__( 'Choose icon size', 'eino' ),
			'section'  => 'social-links',
			'settings' => 'icon_size',
			'type'     => 'radio',
			'priority' => 80,
			'choices'  => array(
				'normal'     => esc_html__( 'Normal', 'eino' ),
				'icon-large' => esc_html__( 'Icon large', 'eino' ),
				'icon-2x'    => esc_html__( 'Icon 2x', 'eino' ),
				'icon-3x'    => esc_html__( 'Icon 3x', 'eino' ),
				'icon-4x'    => esc_html__( 'Icon 4x', 'eino' )
			)
		)
	);
	
	/* == Use full width header image or not. == */
	
	/* Add setting for do you want to use full width header image or not. */
	$wp_customize->add_setting(
		'header_image_width',
		array(
			'default'           => 'content-width',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_html_class',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add header image control. */
	$wp_customize->add_control(
		'header-image-width',
		array(
			'label'    => esc_html__( 'Choose whether to use full width header image or not. Or use header image below breadcrumb trail.', 'eino' ),
			'section'  => 'layout',
			'settings' => 'header_image_width',
			'type'     => 'radio',
			'priority' => 2,
			'choices'  => array(
				'content-width'   => esc_html__( 'Use Content width header image.', 'eino' ),
				'full-width'      => esc_html__( 'Use full width header image.', 'eino' ),
				'content-inside'  => esc_html__( 'Use header below breadcrumb trail.', 'eino' )
			)
		)
	);
	
	/* == Add the Soliloque Slider setting. == */
	
	/* Get Slider choices. */
	$eino_soliloquy_slider_choices = eino_get_soliloquy_slider_choices();
	
	$wp_customize->add_setting(
		'soliloquy_slider',
		array(
			'default'           => 'default',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add the Soliloque Slider control. */
	$wp_customize->add_control(
		'soliloquy-slider-control',
		array(
			'label'    => esc_html__( 'Select Soliloquy Slider', 'eino' ),
			'section'  => 'layout',
			'settings' => 'soliloquy_slider',
			'type'     => 'select',
			'choices'  => $eino_soliloquy_slider_choices
		)
	);
	
	/* == Front Page Callout == */
	
	/* Add front page callout section. */
	$wp_customize->add_section(
		'front-page-callout',
		array(
			'title'      => esc_html__( 'Front Page Callout', 'eino' ),
			'priority'   => 210,
			'capability' => 'edit_theme_options'
		)
	);
	
	/* Add the callout link setting. */
	$wp_customize->add_setting(
		'callout_url',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add the callout link control. */
	$wp_customize->add_control(
		'callout-url',
		array(
			'label'    => esc_html__( 'Callout URL', 'eino' ),
			'section'  => 'front-page-callout',
			'settings' => 'callout_url',
			'priority' => 20,
			'type'     => 'text'
		)
	);
	
	/* Add the callout url text setting. */
	$wp_customize->add_setting(
		'callout_url_text',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add the callout url text control. */
	$wp_customize->add_control(
		'callout-url-text',
		array(
			'label'    => esc_html__( 'Callout URL text', 'eino' ),
			'section'  => 'front-page-callout',
			'settings' => 'callout_url_text',
			'priority' => 30,
			'type'     => 'text'
		)
	);
	
	/* Add the 'callout image' setting. */
	$wp_customize->add_setting(
		'callout_image',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url',
			//'transport'         => 'postMessage'
		)
	);
	
	/* Add custom logo control. */
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'callout_image',
				array(
					'label'    => esc_html__( 'Upload image for Callout. Recommended max width is 770px.', 'eino' ),
					'section'  => 'front-page-callout',
					'settings' => 'callout_image',
					'priority' => 40,
			) 
		) 
	);

}

/**
* Print font size in header.
*
* @since 0.1.0
*/
function eino_print_font_size() {

	if ( get_theme_mod( 'font_size' ) ) {
	
		/* Get the cached font size. */
		$eino_cached_font_size = wp_cache_get( 'eino_font_size_cache' );

		/* If the style is available, output it and return. */
		if ( !empty( $eino_cached_font_size ) ) {
			echo $eino_cached_font_size;
			return;
		}
		
		/* Get font size. */
		$eino_font_size_px = absint( get_theme_mod( 'font_size', 16 ) );
		
		/* Calculate as % value. Base is 16px. Round in 8 decimals. */
		$eino_font_size_procent = round( $eino_font_size_px / 16 * 100, 8 );
		
		$eino_font_size = " html { font-size: {$eino_font_size_procent}%; } ";
		
		/* Add some extra for large screens. */
		$eino_font_size_procent_4 = $eino_font_size_procent + 4;
		$eino_font_size_procent_8 = $eino_font_size_procent + 10;
		
		/* Minimum width of 1512 pixels. */
		$eino_font_size .= " @media screen and (min-width: 108em) { html { font-size: {$eino_font_size_procent_4}%; } } ";
		
		/* Minimum width of 1952 pixels. */
		$eino_font_size .= " @media screen and (min-width: 122em) { html { font-size: {$eino_font_size_procent_8}%; } } ";
		
		$eino_font_size_echo = "\n" . '<style type="text/css" id="font-size-css">' . trim( $eino_font_size ) . '</style>' . "\n";
		
		/* Cache the font size, so we don't have to process this on each page load. */
		wp_cache_set( 'eino_font_size_cache', $eino_font_size_echo );

		/* Output the custom style. */
		echo $eino_font_size_echo;
	
	}

}

/**
* Delete cache for font size.
*
* @since 0.1.0
*/
function eino_font_size_cache_delete() {

	wp_cache_delete( 'eino_font_size_cache' );
	
}

/**
* Return Soliloque Slider choices.
*
* @since 0.1.0
*/
function eino_get_soliloquy_slider_choices() {
	
	/* Set an array. */
	$eino_slider_data = array(
		'default' => __( 'Select Slider', 'eino' )
	);
	
	/* Get Soliloquy Sliders. */
	$eino_soliloquy_args = array(
		'post_type' 		=> 'soliloquy',
		'posts_per_page' 	=> -1
	);
	
	$eino_sliders = get_posts( $eino_soliloquy_args );
	
	/* Loop sliders data. */
	foreach ( $eino_sliders as $eino_slider ) {
		$eino_slider_data[$eino_slider->ID] = $eino_slider->post_title;
	}
	
	/* Return array. */
	return $eino_slider_data;
	
}

/**
* Return social links
*
* @since 0.1.0
*/
function eino_social_links() {

	/* Return if there is social links. */
	
	if ( get_theme_mod( 'twitter_link' ) || get_theme_mod( 'facebook_link' ) || get_theme_mod( 'rss_link' ) || get_theme_mod( 'linkedin_link' ) || get_theme_mod( 'google_plus_link' ) || get_theme_mod( 'github_link' ) || get_theme_mod( 'pinterest_link' ) ) {

		$eino_output_links = '';
		
		$eino_output_links .= '<div id="eino-social-links">';
		
		$eino_output_links .= '<ul id="eino-social-link-list">';

		if ( get_theme_mod( 'twitter_link' ) )
			$eino_output_links .= '<li class="eino-social-links"><a class="eino-social-link" href="' . esc_url( get_theme_mod( 'twitter_link' ) ) . '"><i class="' . esc_attr( apply_filters( 'eino_link_twitter', 'icon-twitter' ) ) . ' ' . get_theme_mod( 'icon_size' ) . '"></i></a></li>';
		
		if ( get_theme_mod( 'facebook_link' ) )
			$eino_output_links .= '<li class="eino-social-links"><a class="eino-social-link" href="' . esc_url( get_theme_mod( 'facebook_link' ) ) . '"><i class="' . esc_attr( apply_filters( 'eino_link_facebook', 'icon-facebook' ) ) . ' ' . get_theme_mod( 'icon_size' ) . '"></i></a></li>';
			
		if ( get_theme_mod( 'rss_link' ) )
			$eino_output_links .= '<li class="eino-social-links"><a class="eino-social-link" href="' . esc_url( get_theme_mod( 'rss_link' ) ) . '"><i class="' . esc_attr( apply_filters( 'eino_link_rss', 'icon-rss' ) ) . ' ' . get_theme_mod( 'icon_size' ) . '"></i></a></li>';
		
		if ( get_theme_mod( 'linkedin_link' ) )
			$eino_output_links .= '<li class="eino-social-links"><a class="eino-social-link" href="' . esc_url( get_theme_mod( 'linkedin_link' ) ) . '"><i class="' . esc_attr( apply_filters( 'eino_link_linkedin', 'icon-linkedin' ) ) . ' ' . get_theme_mod( 'icon_size' ) . '"></i></a></li>';

		if ( get_theme_mod( 'google_plus_link' ) )
			$eino_output_links .= '<li class="eino-social-links"><a class="eino-social-link" href="' . esc_url( get_theme_mod( 'google_plus_link' ) ) . '"><i class="' . esc_attr( apply_filters( 'eino_link_google_plus', 'icon-google-plus' ) ) . ' ' . get_theme_mod( 'icon_size' ) . '"></i></a></li>';

		if ( get_theme_mod( 'github_link' ) )
			$eino_output_links .= '<li class="eino-social-links"><a class="eino-social-link" href="' . esc_url( get_theme_mod( 'github_link' ) ) . '"><i class="' . esc_attr( apply_filters( 'eino_link_github', 'icon-github' ) ) . ' ' . get_theme_mod( 'icon_size' ) . '"></i></a></li>';
	
		if ( get_theme_mod( 'pinterest_link' ) )
			$eino_output_links .= '<li class="eino-social-links"><a class="eino-social-link" href="' . esc_url( get_theme_mod( 'pinterest_link' ) ) . '"><i class="' . esc_attr( apply_filters( 'eino_link_pinterest', 'icon-pinterest' ) ) . ' ' . get_theme_mod( 'icon_size' ) . '"></i></a></li>';
		
		$eino_output_links .= '</ul></div>';
		
	return $eino_output_links;
	
	}
	
}

?>