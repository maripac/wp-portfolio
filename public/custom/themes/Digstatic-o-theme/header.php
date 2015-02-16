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





<?php if  (is_page('About') ) { ?>
<script>

function uniformRandomSampler(width, height, numSamplesMax) {
  var numSamples = 0;
  return function() {
    if (++numSamples > numSamplesMax) return;
    return [Math.random() * width, Math.random() * height];
  };
}

function bestCandidateSampler(width, height, numCandidates, numSamplesMax) {
  var numSamples = 0;

  var quadtree = d3.geom.quadtree()
      .extent([[0, 0], [width, height]])
      ([[Math.random() * width, Math.random() * height]]);

  return function() {
    if (++numSamples > numSamplesMax) return;
    var bestCandidate, bestDistance = 0;
    for (var i = 0; i < numCandidates; ++i) {
      var c = [Math.random() * width, Math.random() * height],
          d = distance(quadtree.find(c[0], c[1]), c);
      if (d > bestDistance) {
        bestDistance = d;
        bestCandidate = c;
      }
    }
    quadtree.add(bestCandidate);
    return bestCandidate;
  };

  function distance(a, b) {
    var dx = a[0] - b[0],
        dy = a[1] - b[1];
    return dx * dx + dy * dy;
  }
}

// Based on http://www.jasondavies.com/poisson-disc/
function poissonDiscSampler(width, height, radius) {
  var k = 30, // maximum number of samples before rejection
      radius2 = radius * radius,
      R = 3 * radius2,
      cellSize = radius * Math.SQRT1_2,
      gridWidth = Math.ceil(width / cellSize),
      gridHeight = Math.ceil(height / cellSize),
      grid = new Array(gridWidth * gridHeight),
      queue = [],
      queueSize = 0,
      sampleSize = 0;

  return function() {
    if (!sampleSize) return sample(Math.random() * width, Math.random() * height);

    // Pick a random existing sample and remove it from the queue.
    while (queueSize) {
      var i = Math.random() * queueSize | 0,
          s = queue[i];

      // Make a new candidate between [radius, 2 * radius] from the existing sample.
      for (var j = 0; j < k; ++j) {
        var a = 2 * Math.PI * Math.random(),
            r = Math.sqrt(Math.random() * R + radius2),
            x = s[0] + r * Math.cos(a),
            y = s[1] + r * Math.sin(a);

        // Reject candidates that are outside the allowed extent,
        // or closer than 2 * radius to any existing sample.
        if (0 <= x && x < width && 0 <= y && y < height && far(x, y)) return sample(x, y);
      }

      queue[i] = queue[--queueSize];
      queue.length = queueSize;
    }
  };

  function far(x, y) {
    var i = x / cellSize | 0,
        j = y / cellSize | 0,
        i0 = Math.max(i - 2, 0),
        j0 = Math.max(j - 2, 0),
        i1 = Math.min(i + 3, gridWidth),
        j1 = Math.min(j + 3, gridHeight);

    for (j = j0; j < j1; ++j) {
      var o = j * gridWidth;
      for (i = i0; i < i1; ++i) {
        if (s = grid[o + i]) {
          var s,
              dx = s[0] - x,
              dy = s[1] - y;
          if (dx * dx + dy * dy < radius2) return false;
        }
      }
    }

    return true;
  }

  function sample(x, y) {
    var s = [x, y];
    queue.push(s);
    grid[gridWidth * (y / cellSize | 0) + (x / cellSize | 0)] = s;
    ++sampleSize;
    ++queueSize;
    return s;
  }
}

function minHeap(compare) {
  var heap = {},
      array = [],
      size = 0;

  heap.empty = function() {
    return !size;
  };

  heap.push = function(value) {
    up(array[size] = value, size++);
    return size;
  };

  heap.pop = function() {
    if (size <= 0) return;
    var removed = array[0], value;
    if (--size > 0) value = array[size], down(array[0] = value, 0);
    return removed;
  };

  function up(value, i) {
    while (i > 0) {
      var j = ((i + 1) >> 1) - 1,
          parent = array[j];
      if (compare(value, parent) >= 0) break;
      array[i] = parent;
      array[i = j] = value;
    }
  }

  function down(value, i) {
    while (true) {
      var r = (i + 1) << 1,
          l = r - 1,
          j = i,
          child = array[j];
      if (l < size && compare(array[l], child) < 0) child = array[j = l];
      if (r < size && compare(array[r], child) < 0) child = array[j = r];
      if (j === i) break;
      array[i] = child;
      array[i = j] = value;
    }
  }

  return heap;
}

// queue
!function(){function n(n){function e(){for(;i=a<c.length&&n>p;){var u=a++,e=c[u],o=t.call(e,1);o.push(l(u)),++p,e[0].apply(null,o)}}function l(n){return function(u,t){--p,null==s&&(null!=u?(s=u,a=d=0/0,o()):(c[n]=t,--d?i||e():o()))}}function o(){null!=s?m(s):f?m(s,c):m.apply(null,[s].concat(c))}var r,i,f,c=[],a=0,p=0,d=0,s=null,m=u;return n||(n=1/0),r={defer:function(){return s||(c.push(arguments),++d,e()),r},await:function(n){return m=n,f=!1,d||o(),r},awaitAll:function(n){return m=n,f=!0,d||o(),r}}}function u(){}var t=[].slice;n.version="1.0.7","function"==typeof define&&define.amd?define(function(){return n}):"object"==typeof module&&module.exports?module.exports=n:this.queue=n}();

// cubehelix
!function(){function t(t){return function(e,i){e=d3.hsl(e),i=d3.hsl(i);var r=(e.h+120)*a,h=(i.h+120)*a-r,s=e.s,l=i.s-s,o=e.l,u=i.l-o;return isNaN(l)&&(l=0,s=isNaN(s)?i.s:s),isNaN(h)&&(h=0,r=isNaN(r)?i.h:r),function(a){var e=r+h*a,i=Math.pow(o+u*a,t),c=(s+l*a)*i*(1-i);return"#"+n(i+c*(-.14861*Math.cos(e)+1.78277*Math.sin(e)))+n(i+c*(-.29227*Math.cos(e)-.90649*Math.sin(e)))+n(i+c*1.97294*Math.cos(e))}}}function n(t){var n=(t=0>=t?0:t>=1?255:0|255*t).toString(16);return 16>t?"0"+n:n}var a=Math.PI/180;d3.scale.cubehelix=function(){return d3.scale.linear().range([d3.hsl(300,.5,0),d3.hsl(-240,.5,1)]).interpolate(d3.interpolateCubehelix)},d3.interpolateCubehelix=t(1),d3.interpolateCubehelix.gamma=t}();

(function() {
  var color = d3.scale.cubehelix()
      .domain([0, 180, 360])
      .range([
        d3.hsl(-100, 0.75, 0.35),
        d3.hsl(  80, 1.50, 0.80),
        d3.hsl( 260, 0.75, 0.35)
      ]);

  floodColor = function(distance) {
    return color(distance % 360);
  };
})();

(function() {
  var count = 0,
      overshoot = 300;

  function whenBoundsVisible(computeBounds, callback) {
    var id = ".visible-" + ++count,
        self = d3.select(window),
        bounds;

    if (document.readyState === "loading") self.on("load" + id, loaded);
    else loaded();

    function loaded() {
      self
          .on("resize" + id, resized)
          .on("scroll" + id, scrolled)
          .each(resized);
    }

    function resized() {
      bounds = computeBounds();
      if (bounds[1] < bounds[0]) bounds.reverse();
      scrolled();
    }

    function scrolled() {
      if (bounds[0] <= pageYOffset && pageYOffset <= bounds[1]) {
        callback(null);
        self.on(id, null);
      }
    }
  }

  beforeVisible = function(element, callback) {
    return whenBoundsVisible(function() {
      var rect = element.getBoundingClientRect();
      return [
        rect.top + pageYOffset - innerHeight - overshoot,
        rect.bottom + pageYOffset + overshoot
      ];
    }, callback);
  };

  whenFullyVisible = function(element, callback) {
    return whenBoundsVisible(function() {
      var rect = element.getBoundingClientRect();
      return [
        rect.bottom + pageYOffset - innerHeight,
        rect.top + pageYOffset
      ];
    }, callback);
  };
})();
</script>
<?php } ;?>

</head>
<body <?php body_class(); ?>>

<div class="grid_control">
<label class="label-switch switch-x">
	<!--<span>X-SWITCH</span>-->
 	<input id="switch-x" type="checkbox" />
  	<div class="checkbox"></div>
</label>
<label class="label-switch switch-y">
	<!--<span>Y-SWITCH</span>-->
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
					<img class="portada about" src="<?php echo $img_assets; ?>/head-009390.jpg" />
					
				<?php } else { ?>
					<img class="portada portfolio" src="<?php echo $img_assets; ?>/head-009390.jpg" />
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
						      <path class="path" fill="none" stroke="#322de8" stroke-miterlimit="10" stroke-width="4" d="M 34 2 C 16.3 2 2 16.3 2 34 s 14.3 32 32 32 s 32 -14.3 32 -32 S 51.7 2 34 2" />
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
		 		 'menu_class' => 'navigation-menu',
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
