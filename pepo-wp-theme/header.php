<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php body_class(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<!--Viewport-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
		<!--Title-->
		<title><?php wp_title(' | ', true, 'right'); ?></title>
		<!--Favicon-->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" />

		<!--Stylesheet-->
    <link rel="stylesheet/css" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css" />

		<!-- typekit -->
		<script src="https://use.typekit.net/uoe4bqk.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
		<!-- end typekit -->

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<!-- Spinner (loader)-->
		<object type="image/svg+xml" class="spinner" data="<?php echo get_template_directory_uri(); ?>/assets/images/PepoLoader.svg" width="64" height="64" id="Loading spinner">
			<img class="spinner" src="<?php echo get_template_directory_uri(); ?>/assets/images/PepoLoader.gif" width="64" height="64" alt="Loading spinner">
		</object>

		<header id="header" role="banner" class="closed loading">
			<div id="header_space">

				<!--Menu Button-->
        <a href="#" aria-haspopup="true" tabindex="0" class="menu_btn slicknav_btn">
          <span class="menu_icon slicknav">
            <span class="menu_icon-bar"></span>
            <span class="menu_icon-bar"></span>
            <span class="menu_icon-bar"></span>
          </span>
        </a>

				<!--Branding-->
				<section id="branding" <?php if ( is_home()) { echo 'class="home-animation"'; } ?>>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Pepo Botanic Design Home Page">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/pepo-logo.svg" alt="Logo" width="100%" height="auto"/>
					</a>
				</section>

				<!--Menu-->
				<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>

				<!--Social Media Icons-->
				<section class="social-media-icons">
	        <a href="https://www.instagram.com/pepo_botanic_design/" title="Pepo Instagram"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram-icon.svg" alt="Pepo Instagram" width="25px" height="auto"/></a>
	        <a href="https://au.pinterest.com/pepobotanic/" title="Pepo Pinterest"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/pinterest-icon.svg" alt="Pepo Pinterest" width="25px" height="auto"/></a>
	        <a href="https://www.facebook.com/Pepobotanicdesign/" title="Pepo Facebook"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-icon.svg" alt="Pepo Facebook" width="25px" height="auto"/></a>
	      </section>

				<!--Search form-->
				<section id="search-form" class="form search">
					<form role="search" method="get" id="header-searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input placeholder="Search & press enter" type="text" value="<?php echo get_search_query(); ?>" name="s" id="search-input" class="search-input" autofocus="autofocus"/>
					</form>
					<a href="#" aria-haspopup="true" tabindex="0" class="menu_btn nav_btn open">
						<span class="menu_icon slicknav">
							<span class="menu_icon-bar"></span>
							<span class="menu_icon-bar"></span>
							<span class="menu_icon-bar"></span>
						</span>
					</a>
				</section>
			</div>

			<!--Contact form-->
			<section id="contact-form">
				<h4 id="contact-title">Contact</h4>
				<section id="contact-content">
					<?php if ( function_exists( 'ccf_output_form' ) ) { ccf_output_form( 86 ); } ?>
					<?php $contactPage   = get_post( 93 );?>
					<ul class="contact-info">
						<li class="address"><?php the_field('address',$contactPage);?></li>
						<li><a class="phone" href="#"><?php the_field('phone_number',$contactPage);?></a></li>
					</ul>
				</section>
			</section>
		</header>

		<div id="container" class="loading">
