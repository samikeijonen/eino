<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters.  If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).  Friends don't let 
 * friends modify parent theme files. ;)
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to
 * override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    Eino
 * @subpackage Functions
 * @version    0.1.0
 * @since      0.1.0
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @copyright  Copyright (c) 2013, Sami Keijonen
 * @link       https://foxnet-themes.fi/downloads/eino
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Load the core theme framework. */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'eino_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function eino_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();
	
	/* Include theme customize. */
	require_once( trailingslashit( get_template_directory() ) . 'includes/theme-customize.php' );
	
	/* Include custom background functions. */
	require_once( trailingslashit( get_template_directory() ) . 'includes/custom-background.php' );
	
	/* Include Easy Digital Download functions. */
	require_once( trailingslashit( get_template_directory() ) . 'includes/edd-functions.php' );

	/* Register menus. */
	add_theme_support( 
		'hybrid-core-menus', 
		array( 'primary', 'secondary', 'subsidiary' ) 
	);

	/* Register sidebars. */
	add_theme_support( 
		'hybrid-core-sidebars', 
		array( 'header', 'primary', 'secondary', 'subsidiary' ) 
	);

	/* Load scripts. */
	add_theme_support( 
		'hybrid-core-scripts', 
		array( 'comment-reply' ) 
	);

	/* Load styles. */
	add_theme_support( 
		'hybrid-core-styles', 
		array( 'eino-color-scheme', 'parent', 'style' )
	); 
	
	/* Add custom color scheme styles. */
	add_filter( "{$prefix}_styles", 'eino_color_scheme_styles' );
	
	/* Add color scheme body class. */
	add_filter( 'body_class','eino_color_scheme_body_class' );

	/* Load widgets. */
	add_theme_support( 'hybrid-core-widgets' );

	/* Load shortcodes. */
	add_theme_support( 'hybrid-core-shortcodes' );
	
	/* Add footer info and theme settings page. */
	add_theme_support( 
		'hybrid-core-theme-settings', 
		array( 'about', 'footer' ) 
	);

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* Enable theme layouts (need to add stylesheet support). */
	add_theme_support( 
		'theme-layouts', 
		array( '1c', '2c-l', '2c-r', '3c-l', '3c-r', '3c-c' ), 
		array( 'default' => '1c', 'customizer' => true ) 
	);

	/* Allow per-post stylesheets. */
	add_theme_support( 'post-stylesheets' );

	/* Support pagination instead of prev/next links. */
	add_theme_support( 'loop-pagination' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Use breadcrumbs. */
	add_theme_support( 'breadcrumb-trail' );

	/* Nicer [gallery] shortcode implementation. */
	add_theme_support( 'cleaner-gallery' );

	/* Better captions for themes to style. */
	add_theme_support( 'cleaner-caption' );
	
	/* Support for featured header. */
	add_theme_support( 'featured-header' );
	
	/* Add theme support for theme fonts. */
	add_theme_support( 'theme-fonts',   array( 'callback' => 'eino_register_headlines_fonts', 'customizer' => true ) );
	
	/* Add theme support for theme color palette. */
	add_theme_support( 'color-palette', array( 'callback' => 'eino_register_colors' ) );

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );

	/* Post formats. */
	add_theme_support( 
		'post-formats',
		array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) 
	);

	/* Add support for a custom header image. */
	
	if ( 'full-width' == get_theme_mod( 'header_image_width' ) ) {
		$eino_header_height = 379;
		$eino_header_width = 1920;
	}
	else {
		$eino_header_height = 379;
		$eino_header_width = 1520;
	}
	
	$eino_header_args = array(
		'flex-height' => true,
		'height' => absint( apply_filters( 'eino_header_height', $eino_header_height ) ),
		'flex-width' => true,
		'width' => absint( apply_filters( 'eino_header_width', $eino_header_width ) ),
		'default-image' => '',
		'header-text' => false,
		//'admin-head-callback' => 'eino_admin_header_style',
		//'admin-preview-callback' => 'eino_admin_header_image',
	);
	
	add_theme_support( 'custom-header', $eino_header_args );

	/* Handle content width for embeds and images. */
	hybrid_set_content_width( 770 );
	
	/* Add respond.js and  html5shiv.js for unsupported browsers. */
	add_action( 'wp_head', 'eino_respond_html5shiv' );
	
	/* Add custom image sizes. */
	add_action( 'init', 'eino_add_image_sizes' );
	
	/* Enqueue styles and scripts. */
	add_action( 'wp_enqueue_scripts', 'eino_enqueue_scripts' );

	/* Disable primary sidebar widgets when layout is one column. */
	add_filter( 'sidebars_widgets', 'eino_disable_sidebars' );
	add_action( 'template_redirect', 'eino_one_column' );
	
	/* Add number of subsidiary and front page widgets to body_class. */
	add_filter( 'body_class', 'eino_subsidiary_classes' );
	add_filter( 'body_class', 'eino_front_page_classes' );
	
	/* Excerpt ending to ... */
	add_filter( 'excerpt_more', 'eino_excerpt_more' );
	
	/* Excerpt length to download and portfolio archives. */
	add_filter( 'excerpt_length', 'eino_excerpt_length', 11 );
	
	/* Set customizer transport. */
	add_action( 'customize_register', 'eino_customize_register' );
	
	/* Add js to customize. */
	add_action( 'customize_preview_init', 'eino_customize_preview_js' );
	
	/* Add css to customize. */
	add_action( 'wp_enqueue_scripts', 'eino_customize_preview_css' );
	
	/* Add additional contact methods. */
	add_filter( 'user_contactmethods', 'eino_contact_methods' );
	
	/* Add menu-item-parent class to parent menu items.  */
	add_filter( 'wp_nav_menu_objects', 'eino_add_menu_parent_class' );
	
	/* Register additional sidebar to 'front page' page template. */
	add_action( 'widgets_init', 'eino_register_sidebars' );
	
	/* Remove the "Theme Settings" submenu. */
	add_action( 'admin_menu', 'eino_remove_theme_settings_submenu', 11 );
	
	/* Filter no_id string in soliloquy slider. */
	add_filter( 'tgmsp_strings', 'eino_soliloquy_no_id_string' );
	
	/* Disable bbPress breadcrumb. */
	add_filter( 'bbp_no_breadcrumb', '__return_true' );
	
	/* Add Woocommerce support. @link http://docs.woothemes.com/document/third-party-custom-theme-compatibility/ */
	add_theme_support( 'woocommerce' );
	
	/* Remove not needed action hooks. */
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_sidebar' , 'woocommerce_get_sidebar', 10 );
	
	/* Add right wrappers for the theme. */
	add_action( 'woocommerce_before_main_content', 'eino_wrapper_start', 10 );
	add_action( 'woocommerce_after_main_content', 'eino_wrapper_end', 10 );
	
	/* Add article wrapper. */
	add_action( 'woocommerce_before_main_content', 'eino_article_wrapper_start', 30 );
	add_action( 'woocommerce_after_main_content', 'eino_article_wrapper_end', 9 );
	
	/* Use Hybrid Core Pagination. */
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
	add_action( 'woocommerce_after_shop_loop', 'eino_woocommerce_pagination', 11 );

}

/**
 * Add Custom Color Scheme Styles.
 *
 * @since 0.1.0
 */
function eino_color_scheme_styles( $styles ) {

	/* Use .min styles if SCRIPT_DEBUG is turned off. */
	$eino_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	$eino_color_scheme = get_theme_mod( 'color_scheme', '0' );
	
	$styles['eino-color-scheme'] = array( 'src' => trailingslashit( get_template_directory_uri() ) . 'css/color-schemes/' . $eino_color_scheme . $eino_suffix . '.css', 'version' => '20130430', 'media' => 'all' );

	return $styles;
}

/**
 * Add Custom Color Scheme body class.
 *
 * @since 0.1.0
 */
function eino_color_scheme_body_class( $classes ) {

	$eino_color_scheme = get_theme_mod( 'color_scheme', '0' );

	$classes[] = 'eino-color-scheme-' . $eino_color_scheme;

	return $classes;
}

/**
 * Function for help to unsupported browsers understand mediaqueries and html5.
 * @link: https://github.com/scottjehl/Respond
 * @link: http://code.google.com/p/html5shiv/
 * @since 0.1.0
 */
function eino_respond_html5shiv() {
	?>
	
	<!-- Enables media queries and html5 in some unsupported browsers. -->
	<!--[if (lt IE 9) & (!IEMobile)]>
	<script type="text/javascript" src="<?php echo trailingslashit( get_template_directory_uri() ); ?>js/respond/respond.min.js"></script>
	<script type="text/javascript" src="<?php echo trailingslashit( get_template_directory_uri() ); ?>js/html5shiv/html5shiv.js"></script>
	<![endif]-->
	
	<?php
}

/**
 *  Adds custom image sizes for thumbnail images.
 * 
 * @since 0.1.0
 */
function eino_add_image_sizes() {

	add_image_size( 'eino-thumbnail-download', 330, 330, true );
	
}

/**
 * Enqueue styles and scripts
 *
 * @since 1.0
 */
function eino_enqueue_scripts() {

	/* Enqueue FitVids. */
	wp_enqueue_script( 'eino-fitvids', trailingslashit( get_template_directory_uri() ) . 'js/fitvids/jquery.fitvids.min.js', array( 'jquery' ), '20130313', true );
	
	/* Enqueue settings. */
	wp_enqueue_script( 'eino-settings', trailingslashit( get_template_directory_uri() ) . 'js/settings/eino-settings.js', array( 'jquery', 'eino-fitvids' ), '20130313', true );

}

/**
 * Disables sidebars if viewing a one-column page.
 *
 * @since  0.1.0
 */
function eino_disable_sidebars( $sidebars_widgets ) {
	global $wp_customize;

	$customize = ( is_object( $wp_customize ) && $wp_customize->is_preview() ) ? true : false;

	if ( !is_admin() && !$customize && '1c' == get_theme_mod( 'theme_layout', '1c' ) ) {
	
		$sidebars_widgets['primary'] = false;
		$sidebars_widgets['secondary'] = false;
		
	}
	
	return $sidebars_widgets;
}

/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since  0.1.0
 */
function eino_one_column() {

	if ( !is_active_sidebar( 'primary' ) && !is_active_sidebar( 'secondary' ) )
		add_filter( 'theme_mod_theme_layout', 'eino_theme_layout_one_column' );
	
	elseif ( is_post_type_archive( array( 'download', 'portfolio_item' ) ) )
		add_filter( 'theme_mod_theme_layout', 'eino_theme_layout_one_column' );
		
	elseif ( is_tax( array( 'portfolio', 'download_category', 'download_tag' ) ) )
		add_filter( 'theme_mod_theme_layout', 'eino_theme_layout_one_column' );

	elseif ( is_attachment() && wp_attachment_is_image() && 'default' == get_post_layout( get_queried_object_id() ) )
		add_filter( 'theme_mod_theme_layout', 'eino_theme_layout_one_column' );
		
	elseif ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/portfolio-page.php' ) || is_page_template( 'page-templates/slider.php' ) || is_page_template( 'page-templates/download-page.php' ) )
		add_filter( 'theme_mod_theme_layout', 'eino_theme_layout_one_column' );
		
	elseif ( function_exists( 'woocommerce_list_pages' ) && ( is_shop() || is_product_category() || is_product_tag() ) )
		add_filter( 'theme_mod_theme_layout', 'eino_theme_layout_one_column' );

}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 *
 * @since 0.1.0
 * @param string $layout The layout of the current page.
 * @return string
 */
function eino_theme_layout_one_column( $layout ) {
	return '1c';
}

/**
 * Counts widgets number in subsidiary sidebar and ads css class (.sidebar-subsidiary-$number) to body_class.
 * Used to increase / decrease widget size according to number of widgets.
 * Example: if there's one widget in subsidiary sidebar - widget width is 100%, if two widgets, 50% each...
 * @author Sinisa Nikolic
 * @copyright Copyright (c) 2012
 * @link http://themehybrid.com/themes/sukelius-magazine
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.1.0
 */
function eino_subsidiary_classes( $classes ) {
    
	if ( is_active_sidebar( 'subsidiary' ) ) {
		
		$the_sidebars = wp_get_sidebars_widgets();
		$num = count( $the_sidebars['subsidiary'] );
		$classes[] = 'sidebar-subsidiary-' . $num;
		
    }
    
    return $classes;
	
}

/**
 * Counts widgets number in front-page sidebar and ads css class (.sidebar-front-page-$number) to body_class.
 * @author Sinisa Nikolic
 * @copyright Copyright (c) 2012
 * @link http://themehybrid.com/themes/sukelius-magazine
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.1.0
 */
function eino_front_page_classes( $classes ) {
	
	if ( is_active_sidebar( 'front-page' ) && ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/portfolio-page.php') || is_page_template( 'page-templates/slider.php' ) || is_page_template( 'page-templates/download-page.php' ) ) ) {
		
		$the_sidebars = wp_get_sidebars_widgets();
		$num = count( $the_sidebars['front-page'] );
		$classes[] = 'sidebar-front-page-' . $num;
		
    }
    
    return $classes;
	
}

/**
 * Excerpt ending to '...'.
 *
 * @since  0.1.0
 */
function eino_excerpt_more( $more ) {

	return '...';
	
}

/**
 *  Excerpt_length.
 * 
 * @since 0.1.0
 */
function eino_excerpt_length( $length ) {
	
	if ( is_post_type_archive( array( 'download', 'portfolio_item' ) ) || is_tax( array( 'portfolio', 'download_category', 'download_tag' ) ) || is_page_template( 'page-templates/portfolio-page.php' ) || is_page_template( 'page-templates/download-page.php' ) )
		return 20;
	else
		return 55;
		
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * @since 0.1.0
 * @note: credit goes to TwentyTwelwe theme.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function eino_customize_register( $wp_customize ) {
	
	if ( ! get_theme_mod( 'logo_upload' ) )
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
}

/**
 * This make Theme Customizer live preview reload changes asynchronously.
 * Used with blogname and blogdescription.
 * @note: credit goes to TwentyTwelwe theme.
 * @since 0.1.0
 */
function eino_customize_preview_js() {

	wp_enqueue_script( 'eino-customizer', trailingslashit( get_template_directory_uri() ) . 'js/customize/eino-customizer.js', array( 'customize-preview' ), '20130316', true );
	
}

/**
 * This make Theme Customizer live preview work with 1 column layout.
 * Used with Primary and Secondary sidebars.
 * 
 * @since 0.1.0
 */
function eino_customize_preview_css() {

	global $wp_customize;

	if ( is_object( $wp_customize ) )
		wp_enqueue_style( 'eino-customizer-stylesheet', trailingslashit( get_template_directory_uri() ) . 'css/customize/eino-customizer.css', false, '20130330', 'all' );

}

/**
 * Adds new contact methods to the user profile screen.
 *
 * @since 0.1.0
 */
function eino_contact_methods( $meta ) {

	/* Twitter contact method. */
	$meta['twitter'] = __( 'Twitter Username', 'eino' );

	/* Google+ contact method. */
	$meta['google_plus'] = __( 'Google+ URL', 'eino' );

	/* Facebook contact method. */
	$meta['facebook'] = __( 'Facebook URL', 'eino' );

	/* Return the array of contact methods. */
	return $meta;
	
}

/**
 * Add menu-item-parent class to parent menu items. Thanks to Chip Bennett.
 *
 * @since 0.1.0
 */
function eino_add_menu_parent_class( $items ) {

	$parents = array();

	foreach ( $items as $item ) {

		if ( $item->menu_item_parent && $item->menu_item_parent > 0 )
			$parents[] = $item->menu_item_parent;
		
	}

	foreach ( $items as $item ) {

		if ( in_array( $item->ID, $parents ) )
			$item->classes[] = 'menu-item-parent';

	}

	return $items;    

}

/**
 * Registers custom fonts for the Theme Fonts extension.
 *
 * @author    Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright (c) 2013, Justin Tadlock
 * @since  0.1.0
 * @access public
 * @param  object  $theme_fonts
 * @return void
 */
function eino_register_headlines_fonts( $theme_fonts ) {

	/* Add the 'body' font setting. */
	$theme_fonts->add_setting(
		array(
			'id'        => 'body',
			'label'     => __( 'Body Font', 'eino' ),
			'default'   => 'arial',
			'selectors' => 'body',
		)
	);
	
	/* Add the 'headlines' font setting. */
	$theme_fonts->add_setting(
		array(
			'id'        => 'headlines',
			'label'     => __( 'Headline Font', 'eino' ),
			'default'   => 'open-sans-condensed-700',
			'selectors' => 'h1, h2, h3, h4, h5, h6',
		)
	);

	/* Add fonts that users can select for this theme. */

	$theme_fonts->add_font(
		array(
			'handle' => 'trebuchet-font-stack',
			'label'  => __( 'Trebuchet (font stack)', 'eino' ),
			'stack'  => '"Segoe UI", Candara, "Bitstream Vera Sans", "DejaVu Sans", "Bitstream Vera Sans", "Trebuchet MS", Verdana, "Verdana Ref", sans-serif'
		)
	);
	
	$theme_fonts->add_font(
		array(
			'handle' => 'arial',
			'label'  => __( 'Arial (font stack)', 'eino' ),
			'stack'  => 'Arial, Helvetica, sans-serif'
		)
	);
	
	$theme_fonts->add_font(
		array(
			'handle' => 'lucida-sans-unicode',
			'label'  => __( 'Lucida Sans Unicode (font stack)', 'eino' ),
			'stack'  => '"Lucida Sans Unicode", "Lucida Grande", sans-serif'
		)
	);
	
	$theme_fonts->add_font(
		array(
			'handle' => 'georgia-font-stack',
			'label'  => __( 'Georgia (font stack)', 'eino' ),
			'stack'  => 'Georgia, Palatino, "Palatino Linotype", "Book Antiqua", serif',
		)
	);
	
	$theme_fonts->add_font(
		array(
			'handle' => 'helvetica-font-stack',
			'label'  => __( 'Helvetica (font stack)', 'eino' ),
			'stack'  => '"Helvetica Neue", Helvetica, Arial, sans-serif',
		)
	);
	
	$theme_fonts->add_font(
		array(
			'handle' => 'merriweather-sans',
			'label'  => __( 'Merriweather Sans', 'eino' ),
			'family' => 'Merriweather Sans',
			'stack'  => "'Merriweather Sans', sans-serif",
			'type'   => 'google'
		)
	);
	
	$theme_fonts->add_font(
		array(
			'handle' => 'roboto-condensed',
			'label'  => __( 'Roboto Condensed', 'eino' ),
			'family' => 'Roboto Condensed',
			'stack'  => "'Roboto Condensed', sans-serif",
			'type'   => 'google'
		)
	);

	$theme_fonts->add_font(
		array(
			'handle' => 'arvo',
			'label'  => __( 'Arvo', 'eino' ),
			'family' => 'Arvo',
			'stack'  => 'Arvo, serif',
			'type'   => 'google'
		)
	);
	
	$theme_fonts->add_font(
		array(
			'handle' => 'muli',
			'label'  => __( 'Muli', 'eino' ),
			'family' => 'Muli',
			'stack'  => "Muli, sans-serif",
			'type'   => 'google'
		)
	);
	
	$theme_fonts->add_font(
		array(
			'handle' => 'open-sans',
			'label'  => __( 'Open Sans', 'eino' ),
			'family' => 'Open Sans',
			'stack'  => "'Open Sans', sans-serif",
			'type'   => 'google'
		)
	);
	
	$theme_fonts->add_font(
		array(
			'handle' => 'open-sans-condensed-700',
			'label'  => __( 'Open Sans Condensed (700)', 'eino' ),
			'family' => 'Open Sans Condensed',
			'weight' => '700',
			'stack'  => "'Open Sans Condensed', sans-serif",
			'type'   => 'google'
		)
	);
	
}

/**
 * Registers colors for the Color Palette extension.
 *
 * @since  0.1.0
 * @access public
 * @param  object  $color_palette
 * @return void
 */
function eino_register_colors( $color_palette ) {

	/* Add custom colors. */
	
	$color_palette->add_color(
		array( 'id' => 'body', 'label' => __( 'Body Color', 'eino' ), 'default' => 'd5d5d5' )
	);
	$color_palette->add_color(
		array( 'id' => 'entry', 'label' => __( 'Entry Color', 'eino' ), 'default' => '090d0e' )
	);
	$color_palette->add_color(
		array( 'id' => 'link', 'label' => __( 'Link Color', 'eino' ), 'default' => 'c09626' )
	);
	$color_palette->add_color(
		array( 'id' => 'link_hover', 'label' => __( 'Link Color Hover', 'eino' ), 'default' => 'aa831b' )
	);
	$color_palette->add_color(
		array( 'id' => 'color_light', 'label' => __( 'Light Color', 'eino' ), 'default' => 'fff' )
	);
	$color_palette->add_color(
		array( 'id' => 'color_dark', 'label' => __( 'Dark Color', 'eino' ), 'default' => '999' )
	);
	$color_palette->add_color(
		array( 'id' => 'color_dark_1', 'label' => __( 'Dark Color 1', 'eino' ), 'default' => '161616' )
	);
	

	/* Add rule sets for colors only if they are set in customize. */
	
	if ( 'custom' == get_theme_mod( 'use_premade_colors' ) ) {

		$color_palette->add_rule_set(
			'body',
			array(
				'color'               => 'body, .sidebar .widget-title'
			)
		);
	
		$color_palette->add_rule_set(
			'entry',
			array(
				'background-color'    => '.breadcrumb-trail, .loop-meta, .hentry, .comment-wrap, #respond, #menu-primary, #sidebar-primary .widget, #sidebar-secondary .widget, #sidebar-front-page .widget-inside, #sidebar-subsidiary, .loop-nav a, .pagination .page-numbers, .page-links a, a.more-link'
			)
		);

		$color_palette->add_rule_set(
			'link',
			array(
				'color'               => 'a, a:visited',
				'background-color'    => '.menu-toggle, input[type="submit"], #respond #submit, a.eino-button, #bbpress-forums button, .bbp-pagination-links a, a.eino-portfolio-item-link, .edd-submit.button.eino-theme-color, body .gform_wrapper .gform_body .gform_page_footer .gform_next_button, body .gform_wrapper .gform_body .gform_page_footer .gform_previous_button, #menu-primary ul a:hover, #menu-primary ul li:hover a, #menu-primary li.current-menu-item a, #menu-primary ul li.iehover a, #menu-primary ul.sub-menu li.current-menu-item a, #menu-primary ul li.iehover li.current-menu-item a, #menu-primary ul li:hover li a:hover, #menu-primary ul li:hover li:hover a, #menu-primary ul li.iehover li a:hover, #menu-primary ul li.iehover li.iehover a, #menu-primary ul li:hover li:hover li.current-menu-item a, #menu-primary ul li.iehover li.iehover li.current-menu-item a, #menu-primary ul li:hover li:hover li a:hover, #menu-primary ul li:hover li:hover li:hover a, #menu-primary ul li.iehover li.iehover li a:hover, #menu-primary ul li.iehover li.iehover li.iehover a, #menu-primary ul li:hover li:hover li:hover li.current-menu-item a, #menu-primary ul li.iehover li.iehover li.iehover li.current-menu-item a, #menu-primary ul li:hover li:hover li:hover li a:hover, #menu-primary ul li.iehover li.iehover li.iehover li a:hover',
				'border-color'        => 'input[type="email"]:focus, input[type="password"]:focus, input[type="reset"]:focus, input[type="search"]:focus, input[type="text"]:focus,input[type="url"]:focus,#respond input[type="text"]:focus,#respond input[type="url"]:focus,#respond input[type="email"]:focus, textarea:focus, #respond textarea:focus, body .gform_wrapper .gform_body .gform_fields .gfield input[type=text]:focus, body .gform_wrapper .gform_body .gform_fields .gfield input[type=email]:focus, body .gform_wrapper .gform_body .gform_fields .gfield input[type=tel]:focus, body .gform_wrapper .gform_body .gform_fields .gfield input[type=url]:focus, body .gform_wrapper .gform_body .gform_fields .gfield input[type=number]:focus, body .gform_wrapper .gform_body .gform_fields .gfield input[type=password]:focus, body .gform_wrapper .gform_body .gform_fields .gfield input[type=file]:focus, body .gform_wrapper .gform_body .gform_fields .gfield textarea:focus, #bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content:focus'
			)
		);

		$color_palette->add_rule_set(
			'link_hover',
			array(
				'color'               => 'a:focus, a:active, a:hover ',
				'background-color'    => '.menu-toggle:hover, input[type="submit"]:hover, #respond #submit:hover, a.eino-button:hover, #bbpress-forums button:hover, .bbp-pagination-links a:hover, .bbp-pagination-links .page-numbers.current, .edd-submit.button.eino-theme-color:hover, .menu-toggle:active, .menu-toggle.toggled-on, input[type="submit"]:active, input[type="submit"].toggled-on, .loop-nav a:hover, .page-links a:hover, .pagination  a.page-numbers:hover, a.more-link:hover, a.eino-portfolio-item-link:hover, .page-numbers.current, body .gform_wrapper .gform_body .gform_page_footer .gform_next_button:hover, body .gform_wrapper .gform_body .gform_page_footer .gform_previous_button:hover'
			)
		);

		$color_palette->add_rule_set(
			'color_light',
			array(
				'color'               => '.menu-toggle, input[type="submit"], #respond #submit, body .edd-submit.button, body #edd_purchase_form input.edd-input.required,  body #edd_purchase_form select.edd-select.required, #menu-primary li a, .loop-nav a, .pagination .page-numbers, .page-links a, a.more-link, a.eino-portfolio-item-link, a.eino-button, .page-numbers.current, body .gform_wrapper .gform_body .gform_page_footer .gform_next_button, body .gform_wrapper .gform_body .gform_page_footer .gform_previous_button, body .gform_wrapper .gfield_required, body .gform_wrapper .top_label span.ginput_total, #bbpress-forums button, .bbp-pagination-links a'
			)
		);
	
		$color_palette->add_rule_set(
			'color_dark',
			array(
				'color'               => 'blockquote, dl dd, input[type="email"], input[type="password"], input[type="reset"], input[type="search"], input[type="text"],input[type="url"], .breadcrumb-trail, .loop-meta, .entry-byline, .entry-meta, #respond input[type="text"], #respond input[type="url"], #respond input[type="email"] ,textarea, #respond textarea, #sidebar-primary .widget, #sidebar-secondary .widget,#sidebar-subsidiary .widget, .wp-caption-text, body .gform_wrapper .gform_body .gform_fields .gfield input[type=text], body .gform_wrapper .gform_body .gform_fields .gfield input[type=email], body .gform_wrapper .gform_body .gform_fields .gfield input[type=tel], body .gform_wrapper .gform_body .gform_fields .gfield input[type=url], body .gform_wrapper .gform_body .gform_fields .gfield input[type=number], body .gform_wrapper .gform_body .gform_fields .gfield input[type=password], body .gform_wrapper .gform_body .gform_fields .gfield textarea, body .gform_wrapper .gform_body .gform_fields .gfield input.medium, body .gform_wrapper .gform_body .gform_fields .gfield .gfield_description, body .gform_wrapper .gform_body .gform_fields .gsection .gsection_description, body .gform_wrapper .gform_body .gform_fields .gfield .ginput_complex label, body .gform_wrapper .instruction, body .gform_wrapper.gf_browser_gecko ul.gform_fields li.gfield div.ginput_complex span.ginput_left select, body .gform_wrapper.gf_browser_gecko ul.gform_fields li.gfield div.ginput_complex span.ginput_right select, body .gform_wrapper.gf_browser_gecko ul.gform_fields li.gfield select,body #edd_purchase_form span.edd-description,#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content',
				'border-color'        => 'th, td, input[type="email"], input[type="password"], input[type="reset"], input[type="search"], input[type="text"],input[type="url"], #respond input[type="text"],#respond input[type="url"],#respond input[type="email"], textarea, #respond textarea, body .gform_wrapper .gform_body .gform_fields .gfield input[type=text],body .gform_wrapper .gform_body .gform_fields .gfield input[type=email],body .gform_wrapper .gform_body .gform_fields .gfield input[type=tel], body .gform_wrapper .gform_body .gform_fields .gfield input[type=url], body .gform_wrapper .gform_body .gform_fields .gfield input[type=number], body .gform_wrapper .gform_body .gform_fields .gfield input[type=password],body .gform_wrapper .gform_body .gform_fields .gfield input[type=file],body .gform_wrapper .gform_body .gform_fields .gfield textarea,body .gform_wrapper .gform_body .gform_fields .gfield input.medium , body .gform_wrapper.gf_browser_gecko ul.gform_fields li.gfield div.ginput_complex span.ginput_left select, body .gform_wrapper.gf_browser_gecko ul.gform_fields li.gfield div.ginput_complex span.ginput_right select, body .gform_wrapper.gf_browser_gecko ul.gform_fields li.gfield select, body #gforms_confirmation_message, #bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content, #bbpress-forums fieldset.bbp-form, .bbp-topics-front ul.super-sticky, .bbp-topics ul.super-sticky, .bbp-topics ul.sticky, .bbp-forum-content ul.sticky, .bbp-topic-pagination a',
				'border-bottom-color' => '.entry-byline, .page-template-members .author-profile, body .gform_wrapper .gsection',
				'border-left-color'   => 'blockquote'
			)
		);
		
		$color_palette->add_rule_set(
			'color_dark_1',
			array(
				'background-color'    => 'code, pre, table, body #edd_checkout_cart th, input[type="email"],  input[type="password"],  input[type="reset"],  input[type="search"],  input[type="text"], input[type="url"], #respond input[type="text"], #respond input[type="url"], #respond input[type="email"], textarea, #respond textarea, body .gform_wrapper .gform_body .gform_fields .gfield input[type=text], body .gform_wrapper .gform_body .gform_fields .gfield input[type=email], body .gform_wrapper .gform_body .gform_fields .gfield input[type=tel], body .gform_wrapper .gform_body .gform_fields .gfield input[type=url], body .gform_wrapper .gform_body .gform_fields .gfield input[type=number], body .gform_wrapper .gform_body .gform_fields .gfield input[type=password], body .gform_wrapper .gform_body .gform_fields .gfield input[type=file], body .gform_wrapper .gform_body .gform_fields .gfield textarea, body .gform_wrapper .gform_body .gform_fields .gfield input.medium, body .gform_wrapper.gf_browser_gecko ul.gform_fields li.gfield div.ginput_complex span.ginput_left select,  body .gform_wrapper.gf_browser_gecko ul.gform_fields li.gfield div.ginput_complex span.ginput_right select,  body .gform_wrapper.gf_browser_gecko ul.gform_fields li.gfield select, body #gforms_confirmation_message, #bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content, #menu-primary ul li:hover li a, #menu-primary ul li.iehover li a, #menu-primary ul li:hover li:hover li a, #menu-primary ul li.iehover li.iehover li a,#menu-primary ul li:hover li:hover li:hover li a, #menu-primary ul li.iehover li.iehover li.iehover li a'
				)
		);
		
	}

}

/**
 * Register additional sidebar to 'front page' page template.
 * 
 * @since 0.1.0
 */
function eino_register_sidebars() {

	/* Register the 'front-page' sidebar. */
	register_sidebar(
		array(
			'id' => 'front-page',
			'name' => __( 'Front Page', 'eino' ),
			'description' => __( 'Front Page widget area.', 'eino' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-wrap widget-inside">',
			'after_widget' => '</div></section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);

}

/**
 * Add start wrapper for Woocommerce.
 *
 * @since  0.1.0
 */
function eino_wrapper_start() {
	echo '<div id="content" class="hfeed" role="main">';
}

/**
 * Add end wrapper for Woocommerce.
 *
 * @since  0.1.0
 */
function eino_wrapper_end() {
	echo '</div>';
}

/**
 * Add article start wrapper for Woocommerce.
 *
 * @since  0.1.0
 */
function eino_article_wrapper_start() { 

	if( is_shop() || is_product_category() || is_product_tag() ) { ?>
		<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
	<?php }
	
}

/**
 * Add article end wrapper for Woocommerce.
 *
 * @since  0.1.0
 */
function eino_article_wrapper_end() { 

	if( is_shop() || is_product_category() || is_product_tag() ) { ?>
		</article><!-- .hentry --> 
	<?php }
	
}

/**
 * Loads pagination.
 *
 * @since  0.1.0
 */
function eino_woocommerce_pagination() {
	
	get_template_part( 'loop-nav' ); // Loads the loop-nav.php template.

}

/**
 * Remove the "Theme Settings" submenu.
 *
 * @since 0.1.0
 */
function eino_remove_theme_settings_submenu() {

	/* Remove the Theme Settings settings page. */
	remove_submenu_page( 'themes.php', 'theme-settings' );
}

/**
 * Change no_id text in Soliloquy Slider.
 *
 * @since  0.1.0
 */
function eino_soliloquy_no_id_string( $strings ) {

	$strings['no_id'] = sprintf( __( 'No slider was selected. Please enter a slider ID or select a Slider under <a href="%s"> Appearance &gt; Customize &gt; Layout</a>.', 'eino' ), admin_url( 'customize.php' ) );
		
	return $strings;
}

/**
 * Returns the URL from the post.
 *
 * @uses get_the_post_format_url() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 * @note This idea is taken from Twenty Thirteen theme.
 * @author wordpressdotorg
 * @copyright Copyright (c) 2011, wordpressdotorg
 *
 * @since 0.1.0
 */
function eino_get_link_url() {

	$eino_content = get_the_content();

	$eino_url = get_content_url( $eino_content );

	return ( $eino_url ) ? $eino_url : apply_filters( 'the_permalink', get_permalink() );

}

/**
* Returns a link to the porfolio item URL if it has been set.
*
* @since  0.1.0
*/
function eino_get_portfolio_item_link() {

	$eino_portfolio_url = get_post_meta( get_the_ID(), 'portfolio_item_url', true );

	if ( !empty( $eino_portfolio_url ) )
		return '<span class="eino-project-url"><a class="eino-portfolio-item-link" href="' . esc_url( $eino_portfolio_url ) . '" title="' . the_title( '','', false ) . '">' . __( 'Visit site', 'eino' ) . '</a></span>';
	
}

?>