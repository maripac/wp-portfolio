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

<div class="grid_control">
<label class="label-switch switch-x">
	<span>X-SWITCH</span>
 	<input id="switch-x" type="checkbox" />
  	<div class="checkbox"></div>
</label>
<label class="label-switch switch-y">
	<span>Y-SWITCH</span>
 	<input id="switch-y" type="checkbox" />
  	<div class="checkbox"></div>
</label>
</div><!-- End .grid_control--> 

<!-- WRAPPER AND VIEWPORT FOR OFFCANVAS NAV -->
<?php if( ! is_page_template( 'template-grid-images.php' ) && ! is_front_page() ): ?>
<div id="site-wrapper">
  <div id="site-canvas">
	<div id="site-menu">
		<?php get_sidebar('navget'); ?>		
	</div>
<?php endif; ?>

	
<?php 
// article: https://raygun.io/blog/2014/07/making-svg-html-burger-button/
if ( ! is_page_template( 'template-grid-images.php' ) && ! is_front_page() ) {	?>

<?php if(function_exists('wp_nav_menu')) : // Checks if this version of WP supports menus ?>

	<div class="site-header" role="banner">
		<div class="container header-contents">
			<?php if  (is_page('About') ) { ?>
					<!--<img class="portada portfolio" src="<?php echo $img_assets; ?>/comet-mcnaught-001.jpg" />-->
					<img class="portada about" src="<?php echo $img_assets; ?>/004-head.jpg" />
					
				<?php } else { ?>
					<img class="portada portfolio" src="<?php echo $img_assets; ?>/004-head.jpg" />
			<?php } ?>
			<header class="navigation navigation-fixed" role="banner">
		    	<div class="navigation-wrapper">
		       		<a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">MENU</a>
		       		<nav role="navigation">
				    

			
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
					    <!-- path-burger-->

					    <div class="path-burger">
					      <div class="animate-path">
					        <div class="path-rotation"></div>
					      </div>
					    </div><!-- end path-burger-->
					      
					 </div><!-- end hamburglar-->

					</a>
				<?php		 	
		 		wp_nav_menu( array(
		 		 'theme_location'		=> 'top_header_menu',
		 		 'container' 			=>FALSE,
		 		 'container_class'		=> FALSE,
		 		 'menu_class' => 'navigation-menu show',
		 		 'menu_id' => 'js-navigation-menu',
		 		 'echo' => true,
		 		 'before' => '',
		 		 'after' => '',
		 		 'link_before' => '',
		 		 'link_after' => '',
		 		 'depth' => 0,
		 		 'walker' => new portfolio_walker())
		 		 );
			    ?>
				</nav>
			  </div>
			</header>
			<!--<div class="row top-nav-row">-->

				<?php wp_nav_menu( array( 
				    'container' => 'none', 
				    'theme_location' => 'top_header_crum',
				    'walker'=> new SH_BreadCrumbWalker, 
				    'items_wrap' => '<div id="breadcrumb-%1$s" class="%2$s">%3$s</div>'
				) ); ?>
			<!--</div>-->

		</div> <!-- end container -->
	</div> <!-- end site-header -->

	<!--<div class="container-frame">


	</div>-->

	<?php else: // If custom menus not support then the following code will be executed instead ?>
		<div class="menu">
	    	<ul>
		   		<?php wp_list_pages('title_li='); ?>
	       </ul>
		</div>
	<?php endif; // ends the conditional argument ?>


	
	<?php if( is_page('About') ) { ?>
		<!--<div class="copy-alma">Milky Way over the Chajnantor Plain &copy; ALMA </div>-->
		<!--<div class="wrapper-quote-img">
			<div class="cuerpo-quote-img"><blockquote>Lo que distingue al hombre de los animales es que el primero se esfuerza en aferrar el orden implícito del mundo que le rodea. <em>Conocer el orden</em> es una cualidad esencial del humano [...]. Escoger entre la inconmensurable multitud de estrellas determinados agrupamientos y designarlos con nombres de demonios o de animales no es un juego, sino el intento humano de entender, de orientarse en el caos, de adquirir una representación mental <em>coherente</em>. </blockquote></div>

			<div class="pie-quote-img"><p>Por Aby Warburg. <cite>Texto de presentación de la Exposición de Astrología y Astronomía que organizó para el Planetario de Hamburgo, en torno al año 1930</cite>. Warburg Institute, Londres.</p></div>
		</div>--><!-- /.wrapper-quote -->
		
	
	<?php } ?>	 
<?php  } ?>


	<!-- MAIN CONTENT AREA -->
	<div class="container-frame main">
		<div class="row">
