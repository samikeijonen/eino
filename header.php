<!DOCTYPE html>
<!--[if IE 7 ]> <html class="ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]> <html class="ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>

<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php hybrid_document_title(); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); // wp_head ?>

</head>

<body class="<?php hybrid_body_class(); ?>">

	<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>

	<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>
	
	<?php echo eino_social_links(); // Echo social icons. ?>

	<div id="container">

		<header id="header"<?php if ( is_active_sidebar( 'header' ) ) echo ' class="eino-header-active"'; ?>>
		
			<div class="wrap">

				<hgroup id="branding">
					
					<?php if ( get_theme_mod( 'logo_upload') && 'logo' == get_theme_mod( 'show_logo_avatar' ) ) { // Use logo or avatar if is set. Else use bloginfo name. ?>	
						<h1 id="site-title">
							<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
								<img class="eino-logo" src="<?php echo esc_url( get_theme_mod( 'logo_upload' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
							</a>
						</h1>
					<?php } else {
							if ( 'avatar' == get_theme_mod( 'show_logo_avatar' ) ) { // show avatar only if it's chosen.
								/* Get avatar email. */
								$eino_avatar_email = get_theme_mod( 'avatar_email', get_option( 'admin_email' ) );
								echo get_avatar( esc_attr( $eino_avatar_email ), 90, 'mystery', get_bloginfo( 'name' ) );
							} ?>
						<h1 id="site-title"><a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<?php } ?>
					
					<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
					
				</hgroup><!-- #branding -->
				
			<?php get_sidebar( 'header' ); // Loads the sidebar-header.php template. ?>
				
			</div><!-- .wrap -->

		</header><!-- #header -->
		
		<?php if ( get_header_image() && 'full-width' == get_theme_mod( 'header_image_width' ) ) echo '<div id="eino-header-image"><img class="header-image" src="' . esc_url( get_header_image() ) . '" alt="" /></div>'; ?>

		<div id="main">
			
			<div class="wrap">
			
				<?php if ( get_header_image() && 'content-width' == get_theme_mod( 'header_image_width' ) ) echo '<div id="eino-header-image"><img class="header-image" src="' . esc_url( get_header_image() ) . '" alt="" /></div>'; ?>

				<?php if ( current_theme_supports( 'breadcrumb-trail' ) ) breadcrumb_trail( array( 'container' => 'nav', 'separator' => __( '&#8764;', 'eino' ) ) ); ?>
				
				<?php if ( get_header_image() && 'content-inside' == get_theme_mod( 'header_image_width' ) ) echo '<div id="eino-header-image"><img class="header-image" src="' . esc_url( get_header_image() ) . '" alt="" /></div>'; ?>