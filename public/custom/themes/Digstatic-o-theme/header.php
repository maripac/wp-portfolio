<?php 
/**
 * header.php
 *
 * The header for the theme.
 */
?>

<?php 
	// IMAGES is Themeroot slash assets slash images
	$favicon = IMAGES . '/icons/icon_32x32@2x.png';
	$touch_icon = IMAGES . '/icons/icon_128x128@2x.png';

	$offcanvas_icon	= IMAGES . '/icons/offcanvas-icon.png';
	$styles = THEMEROOT . '/style.css';
	$js = THEMEROOT . '/assets/js';
	
	
	$vendor = THEMEROOT . '/assets/vendor-theme';
	$vendor_styles = THEMEROOT . '/assets/vendor-theme/css';
	$js_vendor = THEMEROOT . '/assets/vendor-theme/js';
	$img_vendor = THEMEROOT . '/assets/vendor-theme/img';
	$img_assets = THEMEROOT . '/assets/images';
?>


<!doctype html>
<!--
          _           _     _       _   _                            _        _   ___  
         | |         | |   (_)     | | | |                          | |      | | |__ \ 
__      _| |__   __ _| |_   _ ___  | |_| |__   ___    __ _  ___  ___| |_ __ _| | __ ) |
\ \ /\ / / '_ \ / _` | __| | / __| | __| '_ \ / _ \  / _` |/ _ \/ __| __/ _` | |/ // / 
 \ V  V /| | | | (_| | |_  | \__ \ | |_| | | |  __/ | (_| | (_) \__ \ || (_| |   <|_|  
  \_/\_/ |_| |_|\__,_|\__| |_|___/  \__|_| |_|\___|  \__, |\___/|___/\__\__,_|_|\_(_)  
                                                      __/ |                            
                                                     |___/                             
-->

<!--[if lt IE 7]><html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7" <?php language_attributes() ?>> <![endif]-->
<!--[if IE 7]><html class="no-js ie ie7 lt-ie9 lt-ie8" <?php language_attributes() ?>> <![endif]-->
<!--[if IE 8]><html class="no-js ie ie8 lt-ie9" <?php language_attributes() ?>> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes() ?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--<link rel="apple-touch-icon" href="apple-touch-icon.png">-->
        <!-- Place favicon.ico in the root directory -->

        <!--<link rel="stylesheet" href="/assets/css/normalize.css">-->
        
        <link rel="stylesheet" href="<?php echo $styles; ?>">
        <link rel="stylesheet" href="<?php echo $vendor_styles; ?>/animation.css">
        <!--<script src="/assets/js/vendor/modernizr-2.8.3.min.js"></script>-->
        <!-- Favicon and Apple Icons -->
		<link rel="shortcut icon" href="<?php echo $favicon; ?>">
		<link rel="apple-touch-icon-precomposed" sizes="128x128" href="<?php echo $touch_icon; ?>">



        <?php wp_head(); ?>



</head>
<body <?php body_class(); ?>>
<!-- WRAPPER AND VIEWPORT FOR OFFCANVAS NAV -->
<div id="site-wrapper">
	<div id="site-canvas">

		<div id="site-menu">

			<?php get_sidebar( 'footer' ); ?>
			<?php  if(function_exists('wp_nav_menu')) : // Checks if this version of WP supports menus ?>

			<?php wp_nav_menu(
				array(
					'theme_location'		=> 'bottom_header_menu',	// Link this menu to a registered location
					'container'       		=> FALSE,				// specify div as container wrapper
					'container_id'    		=> FALSE,				// ID for container wrapper div
					'depth'          		=> 2,					
					'menu_class'      		=> 'bottom_header_menu'		// class on UL
				));
			?>
			<?php endif; // ends the conditional argument ?>

		</div>
		<!--<a href="#" class="toggle-nav"><span class="none">Toggle Nav</span><span class="back-forth"><img src="<?php echo $offcanvas_icon; ?>"></span></a>-->

<!--
article: https://raygun.io/blog/2014/07/making-svg-html-burger-button/
-->
<!--<a href="#" class="toggle-nav">-->
<!--<iframe height='350' scrolling='no' src='//codepen.io/kyleHenwood/embed/Alayb/' frameborder='no' allowtransparency='true' allowfullscreen='true' style='width: 100%;'>See the Pen <a href='http://codepen.io/kyleHenwood/pen/Alayb/'>SVG CSS3 Menu / Burger Button</a> by Kyle Henwood (<a href='http://codepen.io/kyleHenwood'>@kyleHenwood</a>) on <a href='http://codepen.io'>CodePen</a>.
</iframe>-->



<a href="#" class="toggle-nav">
<div id="hamburger" class="hamburglar">

    <div class="burger-icon">
      <div class="burger-container">
        <span class="burger-bun-top"></span>
        <span class="burger-filling"></span>
        <span class="burger-bun-bot"></span>
      </div>
    </div>
    
    <!-- svg ring containter -->
    <div class="burger-ring">
      <svg class="svg-ring">
	      <path class="path" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="4" d="M 34 2 C 16.3 2 2 16.3 2 34 s 14.3 32 32 32 s 32 -14.3 32 -32 S 51.7 2 34 2" />
      </svg>
    </div>
    <!-- the masked path that animates the fill to the ring -->
    
 		<svg width="0" height="0">
       <mask id="mask" class="icon-mask">
    <path xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ff0000" stroke-miterlimit="10" stroke-width="4" d="M 34 2 c 11.6 0 21.8 6.2 27.4 15.5 c 2.9 4.8 5 16.5 -9.4 16.5 h -4" />
       </mask>
     </svg>
    <div class="path-burger">
      <div class="animate-path">
        <div class="path-rotation"></div>
      </div>
    </div>
      
  </div>






</a>



	<!-- HEADER -->
	<header class="site-header" role="banner">
		<div class="container header-contents">
		  <div class="row">
			
				<?php if (is_post_type_archive( 'portfolio') || is_singular( 'portfolio') || is_singular( 'snippets') ||is_post_type_archive( 'snippets') ) { ?> 
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img class="portada" src="<?php echo $img_assets; ?>\002-head.jpg" />
					</a>

				<?php } else { ?>
				<div class="banner-portada">
					<div class="site-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"></a>
					</div> <!-- end site-logo -->
				</div> <!-- end portada --> 
				<?php } //endif; 
				?>
			
				
		   </div> <!-- end row -->
		</div> <!-- end container -->
	</header> <!-- end site-header -->


	<div class="container-frame">
		<div class="row top-nav-row">
			<div class="nav-portada">
				<nav class="site-navigation" role="navigation">


					<?php  if(function_exists('wp_nav_menu')) : // Checks if this version of WP supports menus ?>
	
						<?php wp_nav_menu(
							array(
								'theme_location'		=> 'top_header_menu',	// Link this menu to a registered location
								'container'       		=> FALSE,				// specify div as container wrapper
								'container_id'    		=> FALSE,				// ID for container wrapper div
								'depth'          		=> 2,					
								'menu_class'      		=> 'top-menu-list'		// class on UL
							));
						?>
	
					<?php else: // If custom menus not support then the following code will be executed instead ?>
						<div class="menu">
				        	<ul>
						   		<?php wp_list_pages('title_li='); ?>
				           </ul>
						</div>
					<?php endif; // ends the conditional argument ?>

				</nav>
			</div> <!-- end nav-portada -->
		</div><!--end menu row-->
	</div><!--end menu container-frame-->
	

	<!-- MAIN CONTENT AREA -->
	<div class="container-frame">
		<div class="row">