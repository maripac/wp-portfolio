<?php
/**
 * functions.php
 *
 * The theme's functions and definitions.
 */

/**
 * 1.0 - Defining constants.
 *
 */
define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/assets/images' );
define( 'SCRIPTS', THEMEROOT . '/js' );
define( 'FRAMEWORK', get_template_directory() . '/framework' );

define( 'MUFRAMEWORK', WP_CONTENT_DIR . '/admin/views' );

/**
 * 2.0 - Load the framework.
 *
 */
require_once( FRAMEWORK . '/init.php' );


/**
 * 3.0 - Set up the content width value based on the theme's design. 
 *
 *
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1125;
}

/**
 * 4.0 - Set up the theme's defaults.
 *
 *
 */
if ( ! function_exists( 'digg_setup' ) ) {
	function digg_setup() {
		/**
		 * Make the theme available for translation.
		 */
		$lang_dir = THEMEROOT . '/languages';
		load_theme_textdomain( 'digg', $lang_dir );

		/**
		 * Add support for post formats.
		 *
		 */
		add_theme_support( 'post-formats',
			array(
				'gallery',
				'link',
				'image',
				'quote',
				'video',
				'audio'
			)
		);


		/**
		 * Add support for automatic feed links.
		 *
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add support for post thumbnails.
		 *
		 */
		add_theme_support( 'post-thumbnails' );

	}

	add_action( 'after_theme_setup', 'digg_setup' );
}

?>
<?php

		add_theme_support( 'post-thumbnails', array( 'post', 'portfolio' ) );
		/**
		 * Register nav menus.
		 * This adds a link to Appearance > Menus in the Dashboard. It must contain two 
		 * parameters at least as in: 
		 *
		 * register_nav_menu( $location, $description ); 
		 *
		 * Additionally you can register different menus to be displayed in diffrent views 
		 * as in:
		 *
		 * register_nav_menus(
    	 * 		array(
      	 *			'$location' => __( '$description' ),
      	 *			'$location' => __( '$description' )
    	 *		)
  		 * );
  		 *
  		 * The location will be the menu's identification name for use within the code, 
  		 * and the description will be a nice name used to display the menu's description 
  		 * in the Dashboard.
		 *
		 * register_nav_menus(
    	 *	array(
      	 *		'header-menu' => __( 'Header Menu' ),
      	 *		'extra-menu' => __( 'Extra Menu' )
    	 *	)
  		 *);
  		 */

 ?>
<?php if ( function_exists( 'register_nav_menus' ) ) : ?>

	<?php register_nav_menus(
		  array(
			'top_header_menu' => 'Menu at the very top of the page',
			'bottom_header_menu' => 'Menu Below header Banner',
			'front_grid_menu' => 'Front Page Sections',
			'top_header_crum' => 'Breadcrum Navigation for Portfolio Archive'
			//'navget' => 'Hardcoded Nav Menu'
			)); 
	?>

<?php endif; ?>



<?php
if ( ! function_exists( 'digg_post_meta' ) ) :
/**
 * ----------------------------------------------------------------------------------------
 * 5.0 - Display meta information for a specific post.
 * ----------------------------------------------------------------------------------------
 */
function digg_post_meta() {
	

	$tag_list = get_the_tag_list( '', __( ', ', 'digg' ) );

    // taxonomies (categories and other terms)
	$id = get_the_ID();
	  $taxonomy_terms_list = "";
	  foreach ( get_object_taxonomies( get_post_type($id) ) as $taxonomy ) {	  $terms_list = get_the_term_list( $id, $taxonomy, '', __( ', ', 'digg' ) );
      if ( $taxonomy_terms_list && $terms_list )
	    $taxonomy_terms_list .= __( ', ', 'digg' ).$terms_list;
	  else
		$taxonomy_terms_list .= $terms_list;
	}

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'digg' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is taxonmies terms, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'digg' );
	} elseif ( $taxonomy_terms_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'digg' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'digg' );
	}

    printf(
		$utility_text,
		$taxonomy_terms_list,
	  	$tag_list,
		$date,
		$author
	);

	$id = get_the_ID();
	$meta = get_post_meta($id, "_location", true);
	if ( $meta ) {
	   	echo '<h3 class="post-meta">' . $meta . '</h3>';
	  }
	$meta2 = get_post_meta($id, "_dresscode", true);
	if ( $meta2 ) {
	   	echo '<h3 class="post-meta">' . $meta2 . '</h3>';
	   }
}
endif;
?>
<?php
/**
 * 5.0 - Display meta information for a specific post.
 *
 *
 */
if ( ! function_exists( 'digg_post_meta_b' ) ) {
	function digg_post_meta_b() {
		echo '<div><ul class="list-inline entry-meta">';
		echo '<li class="meta-date"> ' . get_the_date() . ' </li>';

		if ( get_post_type() === 'post' || 'snippets' || 'events' || 'portfolio' ) {


			// If the post is sticky, mark it.
			if ( is_sticky() ) {

				echo '<li class="meta-featured-post"><i class="fa fa-thumb-tack"></i> ' . __( 'Sticky', 'digg' ) . ' </li>';
			}

			// Get the post author.
			printf(
				'<li class="meta-author"><a href="%1$s" rel="author">%2$s</a></li>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);


			// Get the date.
			//echo '<li class="meta-date"> ' . get_the_date() . ' </li>';

			// The categories.
			// $category_list = get_the_category_list( ', ' );
			// if ( $category_list ) {
			// 	echo '<li class="meta-categories"> ' . $category_list . ' </li>';
			// }

			// The tags.
			$tag_list = get_the_tag_list( '', ', ' );
			if ( $tag_list ) {
				echo '<li class="meta-tags"> ' . $tag_list . ' </li>';
			}
			// Custom Taxonomies.
			$id = get_the_ID();
			$terms_listed = get_the_term_list( $id, 'languages' , '', ', ' );
			if ( $terms_listed ) {
				echo '<li class="meta-tax">' . $terms_listed . ' </li>';
				
			}






			// Custom Taxonomies.
			/**
			 * 
			 * $id = get_the_ID();
			 * $terms_list = get_the_term_list( $id, 'languages' ,  ' ' );
			 * if ( $terms_list ) {
			 * 		echo '<li class="meta-tax">' . $terms_list . ' </li>';
			 * }
			 */

			// Custom Taxonomies.
			// Unlike custom taxonomies, custom metadata does not exist within this repo.
			// To make use of the code below activate the plugin Sample Metabox for Events
			
			$id = get_the_ID();
			$meta = get_post_meta($id, "_location", true);
			if ( $meta ) {
				echo '<li class="post-meta">' . $meta . '</li>';
			}
			$meta2 = get_post_meta($id, "_dresscode", true);
			if ( $meta2 ) {
				echo '<li class="post-meta">' . $meta2 . '</li>';
			}

			if ( is_user_logged_in() ) {
			echo '<li>';
			edit_post_link( __( 'Edit', 'digg' ), '<span class="meta-edit">', '</span>' );
			echo '</li>';
			}
			
			
			

			//Comments link.


			// Edit link.
			// if ( is_user_logged_in() ) {
			// 	echo '<li>';
			// 	edit_post_link( __( 'Edit', 'digg' ), '<span class="meta-edit">', '</span>' );
			// 	echo '</li>';
			// }
		}
		echo '</ul><!--entry-meta--></div>';

	}
}



/**
 * 5.0 - Display meta information for a specific post.
 *
 *
 */
if ( ! function_exists( 'digg_post_meta_c' ) ) {
	function digg_post_meta_c() {
		//echo '<ul class="list-inline entry-meta">';

		if ( get_post_type() === 'post' || 'snippets' || 'events' || 'portfolio' ) {


			// If the post is sticky, mark it.
			//if ( is_sticky() ) {
			//	echo '<li class="meta-featured-post"><i class="fa fa-thumb-tack"></i> ' . __( 'Sticky', 'digg' ) . ' </li>';
			//}

			// Get the post author.
			//printf(
			//	'<li class="meta-author"><a href="%1$s" rel="author">%2$s</a></li>',
			//	esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			//	get_the_author()
			//);


			// Get the date.
			echo '<span class="meta-date"> ' . get_the_date() . ' </span>';

			// The categories.
			// $category_list = get_the_category_list( ', ' );
			// if ( $category_list ) {
			// 	echo '<li class="meta-categories"> ' . $category_list . ' </li>';
			// }

			// The tags.
			//$tag_list = get_the_tag_list( '', ', ' );
			///if ( $tag_list ) {
			//	echo '<li class="meta-tags"> ' . $tag_list . ' </li>';
			//}
			// Custom Taxonomies.
			$id = get_the_ID();
			$terms_listed = get_the_term_list( $id, 'languages' , '<li class="meta-tax">', '</li>' );
			if ( $terms_listed ) {
				echo '<ul class="meta-lang">' . $terms_listed . ' </ul>';
				
			}
			$id = get_the_ID();
			$terms_listed = get_the_term_list( $id, 'fields' , '<li class="meta-tax">', '</li>' );
			if ( $terms_listed ) {
				echo '<ul class="meta-fields">' . $terms_listed . ' </ul>';
				
			}




			// Custom Taxonomies.
			/**
			 * 
			 * $id = get_the_ID();
			 * $terms_list = get_the_term_list( $id, 'languages' ,  ' ' );
			 * if ( $terms_list ) {
			 * 		echo '<li class="meta-tax">' . $terms_list . ' </li>';
			 * }
			 */

			// Custom Taxonomies.
			// Unlike custom taxonomies, custom metadata does not exist within this repo.
			// To make use of the code below activate the plugin Sample Metabox for Events
			
			// $id = get_the_ID();
			// $meta = get_post_meta($id, "_location", true);
			// if ( $meta ) {
			// 	echo '<li class="post-meta">' . $meta . '</li>';
			// }
			// $meta2 = get_post_meta($id, "_dresscode", true);
			// if ( $meta2 ) {
			// 	echo '<li class="post-meta">' . $meta2 . '</li>';
			// }

			// if ( is_user_logged_in() ) {
			// echo '<li>';
			// edit_post_link( __( 'Edit', 'digg' ), '<span class="meta-edit">', '</span>' );
			// echo '</li>';
			// }
			
			
			

			//Comments link.


			// Edit link.
			// if ( is_user_logged_in() ) {
			// 	echo '<li>';
			// 	edit_post_link( __( 'Edit', 'digg' ), '<span class="meta-edit">', '</span>' );
			// 	echo '</li>';
			// }
		}
	}
}
if ( ! function_exists( 'digg_post_meta_d' ) ) {
	function digg_post_meta_d() {
		echo '<ul class="list-inline entry-meta">';

		if ( get_post_type() === 'post' || 'snippets' || 'events' || 'portfolio' ) {

			$id = get_the_ID();
			$terms_listed = get_the_term_list( $id, 'languages' , '<li class="meta-tax">', '</li>' );
			if ( $terms_listed ) {
				echo '<ul class="meta-lang">' . $terms_listed . ' </ul>';
				
			}
			$id = get_the_ID();
			$terms_listed = get_the_term_list( $id, 'fields' , '<li class="meta-tax">', '</li>' );
			if ( $terms_listed ) {
				echo '<h5>Taxonomy:</h5><ul class="meta-fields">' . $terms_listed . ' </ul>';
				
			}

		}
		echo '</ul>';
	}
}

if ( ! function_exists( 'digg_post_meta_date' ) ) {
	function digg_post_meta_date() {

		if ( get_post_type() === 'post' || 'snippets' || 'events' || 'portfolio' ) {

echo '<span class="meta-date"> ' . get_the_date() . ' </span>';


		}
	}
}


if ( ! function_exists( 'digg_comments' ) ) {
	function digg_comments() {
		echo '<div class="digg_comments">';
		if ( get_post_type() === 'snippets' || 'events' || 'post' || 'portfolio' ) {

			$id = get_the_ID();
			if ( comments_open() ) :
				echo '<li>';
				echo '<span class="meta-reply">';
				comments_popup_link( __( 'Leave a comment', 'digg' ), __( 'One comment so far', 'digg' ), __( 'View all % comments', 'digg' ) );
				echo '</span>';
				echo '</li>';
			endif;
		}
		echo '</div><!-- end digg_comments -->';
	}
}

if ( ! function_exists( 'digg_snippets_meta' ) ) {
	function digg_snippets_meta() {
		echo '<div class="snippets-meta">';
		if ( get_post_type() === 'snippets' ) {

			$id = get_the_ID();
			$snippet_meta2 = get_post_meta($id, "_description", true);
			$snippet_meta1 = get_post_meta($id, "_referal", true);
			$snippet_meta3 = get_post_meta($id, "_alias", true);
			if ( $snippet_meta2 || $snippet_meta1 ) {
			echo '<h4 class="title-snippets-meta">Snippet metadata</h4>';	
			}
			if ( $snippet_meta2 ) {
			echo '<p class="snippets-meta">' . $snippet_meta2 . '</p>';
			}
			if ( $snippet_meta1 && $snippet_meta3 ) {
			echo '<h4 class="snippets-meta">Link to source:</h4> <a class="snippet-link" href="' . $snippet_meta1 . '">' . $snippet_meta3 . '</a>';
			}

		}
		echo '</div><!--End snippets-meta-->';
	}
}
if ( ! function_exists( 'digg_portfolio_meta_c' ) ) {
	function digg_portfolio_meta_c() {
	echo '<div class="snippets-meta">';
		if ( get_post_type() === 'portfolio' ) {
 
			
						$id = get_the_ID();
			$portfolio_meta43 = get_post_meta($id, "_portfolio_brief", true);
			
				if ( $portfolio_meta43 ) {
					echo '<p class="portfolio-meta">' . $portfolio_meta43 . '</p>';	

				}
			
			
			//$snippet_meta3 = get_post_meta($id, "_alias", true);
			$id = get_the_ID();
			$portfolio_meta1 = get_post_meta($id, "_portfolio_year", true);			
			if ( $portfolio_meta1 ) {
			echo '<h5 class="portfolio-meta">Año:</h5> <span class="year">' . $portfolio_meta1 . '</span>';
			}
			$id = get_the_ID();
			$portfolio_meta32 = get_post_meta($id, "_desc_portfolio", true);

			if ( $portfolio_meta32 ) {
			
			echo '<p class="portfolio-meta">' . $portfolio_meta32 . '</p>';	
			}

			
			
			

		
		
			


		}
		echo '</div><!--End portfolio-meta-->';
	}
}

if ( ! function_exists( 'digg_portfolio_meta_b' ) ) {
	function digg_portfolio_meta_b() {
	
		if ( get_post_type() === 'portfolio' ) {
 
			$id = get_the_ID();
			//$portfolio_meta3 = get_post_meta($id, "_portfolio_brief", true);
			$portfolio_meta1 = get_post_meta($id, "_portfolio_year", true);
			$portfolio_meta2 = get_post_meta($id, "_desc_portfolio", true);
			//$snippet_meta3 = get_post_meta($id, "_alias", true);
			
			if ( $portfolio_meta1 ) {
			echo '<h5 class="portfolio-meta">Año:</h5> <span class="year">' . $portfolio_meta1 . '</span>';
			}
			if ($portfolio_meta2 == '') {
			
			echo '<h3 class="title-portfolio-meta title-snippets-meta">Resumen breve:</h3><p class="portfolio-meta">' . $portfolio_meta2 . '</p>';	
			}

		
		
			


		}
		//echo '</div></div><!--End portfolio-meta-->';
	}
}

if ( ! function_exists( 'digg2_portfolio_meta_b2' ) ) {
	function digg2_portfolio_meta_b2() {
		echo '<span class="portfolio-meta_name" style="font-size:0.675em; float:right; text-transform:uppercase; color:#DD0033; text-align:center; position:relative; right:2em;">';
		if ( get_post_type() === 'portfolio' ) {
 
			$id = get_the_ID();
			
			$portfolio_metab2 = get_post_meta($id, "_portfolio_brief", true);
			//$snippet_meta3 = get_post_meta($id, "_alias", true);
			// if ( $portfolio_meta3 ) {
			// echo '<h3 class="title-portfolio-meta title-snippets-meta">ID/Nombre:</h3>';
			// echo '<p class="portfolio-meta">' . $portfolio_meta3 . '</p>';	
			// }
			// if ( $portfolio_meta1 ) {
			// echo '<h5 class="portfolio-meta">Año:</h5> <span class="year">' . $portfolio_meta1 . '</span>';
			// }
			if ( $portfolio_metab2 ) {
			echo $portfolio_metab2 ;	
			}

		
		
			


		}
		echo '</span><!--End portfolio-meta-->';
	}
}
/*	
 *	-------------------------------------------------------------------------------------
 *	http://wordpress.stackexchange.com/questions/84607/custom-taxonomy-and-tax-query?rq=1
 *  -------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'digg_query_args_a' ) ) {
	function digg_query_args_a() {

	    $diggTaxA = array(
	        'post_type' => array( 'post', 'snippets' ),
	        'posts_per_page' => 5,
	        'tax_query' => array(
	            array(
	                'taxonomy' => 'languages',
	                'field' => 'slug',
	                'terms' => array( 'javascript' )
	            )
	        )
	    );

	    return $diggTaxA;
	}
}

if ( ! function_exists( 'digg_query_args_b' ) ) {
	function digg_query_args_b() {

	    $diggTaxB = array(
	        'post_type' => 'snippets',
	        //'posts_per_page' => 5,
	        'tax_query' => array(
	            array(
	                'taxonomy' => 'languages',
	                'field' => 'slug',
	                'terms' => array( 'javascript' )
	            )
	        )
	    );

	    return $diggTaxB;
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * 6.0 - Display navigation to the next/previous set of posts.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'digg_paging_nav' ) ) {
	function digg_paging_nav() { ?>
		<ul>
			<?php 
				if ( get_previous_posts_link() ) : ?>
				<li class="next">
					<?php previous_posts_link( __( 'Newer Posts &rarr;', 'digg' ) ); ?>
				</li>
				<?php endif;
			 ?>
			<?php 
				if ( get_next_posts_link() ) : ?>
				<li class="previous">
					<?php next_posts_link( __( '&larr; Older Posts', 'digg' ) ); ?>
				</li>
				<?php endif;
			 ?>
		</ul> <?php
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * 7.0 - Register the widget areas.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'digg_widget_init' ) ) {
	function digg_widget_init() {
		if ( function_exists( 'register_sidebar' ) ) {
			register_sidebar(
				array(
					'name' => __( 'Main Widget Area', 'digg' ),
					'id' => 'sidebar-1',
					'description' => __( 'Appears on posts and pages.', 'digg' ),
					'before_widget' => '<div class="term index"><div class="chrome"><div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div> <!-- end widget --></div></div>',
					'before_title' => '<span class="widget-title">',
					'after_title' => '</span></div></div><div class="shell notover"><div class="workshopper">',
				)
			);

			register_sidebar(
				array(
					'name' => __( 'Footer Widget Area', 'digg' ),
					'id' => 'sidebar-2',
					'description' => __( 'Appears on the footer.', 'digg' ),
					'before_widget' => '<div id="%1$s" class="widget col-sm-3 %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h5 class="widget-title">',
					'after_title' => '</h5>',
				)
			);
		}
	}

	add_action( 'widgets_init', 'digg_widget_init' );
}



// /**
//  * Create HTML list of nav menu items.
//  * Replacement for the native Walker, using the description.
//  *
//  * @see    http://wordpress.stackexchange.com/q/14037/
//  * @author toscho, http://toscho.de
//  */
// class Description_Walker extends Walker_Nav_Menu
// {
//     /**
//      * Start the element output.
//      *
//      * @param  string $output Passed by reference. Used to append additional content.
//      * @param  object $item   Menu item data object.
//      * @param  int $depth     Depth of menu item. May be used for padding.
//      * @param  array $args    Additional strings.
//      * @return void
//      */
//     function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
//     {
//         $classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

//         $class_names = join(
//             ' '
//         ,   apply_filters(
//                 'nav_menu_css_class'
//             ,   array_filter( $classes ), $item
//             )
//         );

//         ! empty ( $class_names )
//             and $class_names = ' class="'. esc_attr( $class_names ) . '"';

//         $output .= "<li id='menu-item-$item->ID' $class_names>";

//         $attributes  = '';

//         ! empty( $item->attr_title )
//             and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
//         ! empty( $item->target )
//             and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
//         ! empty( $item->xfn )
//             and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
//         ! empty( $item->url )
//             and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

//         // insert description for top level elements only
//         // you may change this
//         $description = ( ! empty ( $item->description ) and 0 == $depth )
//             ? '<small class="nav_desc">' . esc_attr( $item->description ) . '</small>' : '';

//         $title = apply_filters( 'the_title', $item->title, $item->ID );

//         //$item_output = $args->before
//         //    . "<a $attributes>"
//         //    . $args->link_before
//         //    . $title
//         //    . '</a> '
//         //    . $args->link_after
//         //    . $description
//         //    . $args->after;

//         // Since $output is called by reference we don't need to return anything.
//         //$output .= apply_filters(
//         //    'walker_nav_menu_start_el'
//         //,   $item_output
//         //,   $item
//         //,   $depth
//         //,   $args
//         //);
//     }
// }



/**
 * ----------------------------------------------------------------------------------------
 * 8.0 - Function that validates a field's length.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'digg_validate_length' ) ) {
	function digg_validate_length( $fieldValue, $minLength ) {
		// First, remove trailing and leading whitespace
		return ( strlen( trim( $fieldValue ) ) > $minLength );
	}
}



/**
 * ----------------------------------------------------------------------------------------
 * 9.0 - Include the generated CSS in the page header.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'digg_load_wp_head' ) ) {
	function digg_load_wp_head() {
		// Get the logos
		$logo = IMAGES . '/icon_128x128@2x.png';
		$logo_retina = IMAGES . '/icon_128x128@2x.png';

		$logo_size = getimagesize( $logo );
		?>
		
		<!-- Logo CSS -->
		<style type="text/css">
			.site-logo a {
				background: transparent url( <?php echo $logo; ?> ) 0 0 no-repeat;
				width: <?php echo $logo_size[0] ?>px;
				height: <?php echo $logo_size[1] ?>px;
				display: inline-block;
			}

			@media only screen and (-webkit-min-device-pixel-ratio: 1.5),
			only screen and (-moz-min-device-pixel-ratio: 1.5),
			only screen and (-o-min-device-pixel-ratio: 3/2),
			only screen and (min-device-pixel-ratio: 1.5) {
				.site-logo a {
					background: transparent url( <?php echo $logo_retina; ?> ) 0 0 no-repeat;
					background-size: <?php echo $logo_size[0]; ?>px <?php echo $logo_size[1]; ?>px;
				}
			}
		</style>

		<?php
	}

	add_action( 'wp_head', 'digg_load_wp_head' );
}




add_action('admin_head-nav-menus.php', 'wpclean_add_metabox_menu_posttype_archive');

function wpclean_add_metabox_menu_posttype_archive() {
add_meta_box('wpclean-metabox-nav-menu-posttype', 'Custom Post Type Archives', 'wpclean_metabox_menu_posttype_archive', 'nav-menus', 'side', 'default');
}

function wpclean_metabox_menu_posttype_archive() {
$post_types = get_post_types(array('show_in_nav_menus' => true, 'has_archive' => true), 'object');

if ($post_types) :
    $items = array();
    $loop_index = 999999;

    foreach ($post_types as $post_type) {
        $item = new stdClass();
        $loop_index++;

        $item->object_id = $loop_index;
        $item->db_id = 0;
        $item->object = 'post_type_' . $post_type->query_var;
        $item->menu_item_parent = 0;
        $item->type = 'custom';
        $item->title = $post_type->labels->name;
        $item->url = get_post_type_archive_link($post_type->query_var);
        $item->target = '';
        $item->attr_title = '';
        $item->classes = array();
        $item->xfn = '';

        $items[] = $item;
    }

    $walker = new Walker_Nav_Menu_Checklist(array());

    echo '<div id="posttype-archive" class="posttypediv">';
    echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
    echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
    echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
    echo '</ul>';
    echo '</div>';
    echo '</div>';

    echo '<p class="button-controls">';
    echo '<span class="add-to-menu">';
    echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'digg') . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
    echo '<span class="spinner"></span>';
    echo '</span>';
    echo '</p>';

endif;
}
// class description_walker extends Walker_Nav_Menu {
// 		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
// 		//function start_el(&$output, $item, $depth, $args, $id = 0) {
      
//            global $wp_query;
//            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

//            $class_names = $value = '';

//            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

//            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
//            $class_names = ' class="'. esc_attr( $class_names ) . '"';

//            $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

//            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
//            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
//            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
//            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

//            $prepend = '<img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt=""><h1>';
//            $append = '</h1>';
//            $description  = ! empty( $item->description ) ? '<p>'.esc_attr( $item->description ).'</p>' : '';

//            if($depth != 0)
//            {
//                      $description = $append = $prepend = "";
//            }

//             $item_output = $args->before;
//             $item_output .= '<a class="grid-item" '. $attributes .'>';
//             $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
//             $item_output .= $description.$args->link_after;
//             $item_output .= '</a>';
//             $item_output .= $args->after;
//             $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
           
//             }
// }


// class img_description_walker extends Walker_Nav_Menu
// {
//     function start_lvl( &$output, $depth = 0, $args = array() ) {
//         // do nothing.
//     }
//     function end_lvl( &$output, $depth = 0, $args = array() ) {
//         // do nothing.
//     }
//     function end_el( &$output, $comment, $depth = 0, $args = array() ) {
//         // do nothing, no </li> will be added
//     }

//    // add main/sub classes to li's and links
//     function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
//         global $wp_query;

//         /*do not add anything to the link*/
//         $indent = '';
//         $class_names = $value = '';
//         $output .= '';

//         /*keeping link attributes*/

//         $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
//         $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
//         $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
//         $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

//         //append and prepend nothing - you may anything depending on your design
//        	$prepend = '<h1>';
//         $append = '</h1>';
// 		$description  = ! empty( $item->description ) ? '<p>'.esc_attr( $item->description ).'</p>' : '';

// 		if($depth != 0)
// 		{
// 			$description = $append = $prepend = "";
// 		}

//         //$description  = '';
// 		//$img_assets = THEMEROOT . '/assets/images';
//         /*We add the icons here*/
//         switch ($item->title) {

//         case 'Posts' : $item_img = get_theme_root_uri() .'/Digstatic-o-theme/assets/images/home.png';
//                   break;
//         case 'Snippets' : $item_img = get_theme_root_uri() .'/Digstatic-o-theme/assets/images/code.png';
//               	  break;
//         case 'Portfolio' : $item_img = get_theme_root_uri() .'/Digstatic-o-theme/assets/images/portfolio.png';
//   				  break;

//         //add as many element you need...

//         default : $item_img = get_theme_root_uri() .'/Digstatic-o-theme/assets/images/default.png';
//                   break;
//         }

//         $item_output = '';
//         $item_output .= '<a'. $attributes .'>';
        
//         $item_output .= '<img src="'.$item_img.'" alt="'.$item->title.'" />';
//         $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
//         $item_output .= $description.$args->link_after;

//         $item_output .= '</a>';

//         $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id);
//     }
// }






class portfolio_walker extends Walker_Nav_Menu {
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		//function start_el(&$output, $item, $depth, $args, $id = 0) {
      
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="nav-link '. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '';
           $append = '';
           $description  = ! empty( $item->description ) ? '<p>'.esc_attr( $item->description ).'</p>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a '. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
           
            }
}

class SH_BreadCrumbWalker extends Walker{
    /**
     * @see Walker::$tree_type
     * @var string
     */
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

    /**
     * @see Walker::$db_fields
     * @var array
     */
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

    /**
     * delimiter for crumbs
     * @var string
     */
    var $delimiter = ' > ';

    /**
     * @see Walker::start_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    //function start_el(&$output, $item, $depth, $args) {

        //Check if menu item is an ancestor of the current page
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $current_identifiers = array( 'current-menu-item', 'current-menu-parent', 'current-menu-ancestor' ); 
        $ancestor_of_current = array_intersect( $current_identifiers, $classes );     


        if( $ancestor_of_current ){
        	//apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
            $title = apply_filters( 'the_title', $item->title, $item->ID );

            //Preceed with delimter for all but the first item.
            if( 0 != $depth )
                $output .= $this->delimiter;

            //Link tag attributes
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            //Add to the HTML output
            $output .= '<a'. $attributes .'>'.$title.'</a>';
        }
    }
} 
/* After declaring your metaboxes, add the two hooks to make it all go! */
//add_action('admin_menu', 'create_box');
//add_action('save_post', 'save_box');
// add_action( 'add_meta_boxes', 'acme_custom_meta_box' );
// /**
//  * Defines a custom post meta box that displays directly below the
//  * post editor in the WordPress dashboard.
//  *
//  * @link    http://tommcfarlin.com/wordpress-meta-boxes-aiming-for-simplicity/
//  */
// function acme_custom_meta_box() {

// 	add_meta_box(
// 		'acme-custom-meta-box',
// 		'Acme Meta Box',
// 		'acme_render_meta_box',
// 		'post',
// 		'normal',
// 		'core'
// 	);

// }
// /**
//  * Renders the content to be displayed in the "Acme Meta Box" by requiring
//  * the file that is responsible for rendering the content.
//  *
//  * @link    http://tommcfarlin.com/wordpress-meta-boxes-aiming-for-simplicity/
//  */
// function acme_render_meta_box() {
// 	require_once get_template_directory() . '/acme-meta-box-display.php';
// }

/**
 * ----------------------------------------------------------------------------------------
 * 10.0 - Load the custom scripts for the theme.
 * ----------------------------------------------------------------------------------------
 */
// if ( ! function_exists( 'digg_scripts' ) ) {
// 	function digg_scripts() {
// 		// Adds support for pages with threaded comments
// 		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
// 			wp_enqueue_script( 'comment-reply' );
// 		}

// 		// Register scripts
// 		wp_register_script( 'bootstrap-js', 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array( 'jquery' ), false, true );
// 		wp_register_script( 'digg-custom', SCRIPTS . '/scripts.js', array( 'jquery' ), false, true );

// 		// Load the custom scripts
// 		wp_enqueue_script( 'bootstrap-js' );
// 		wp_enqueue_script( 'digg-custom' );

// 		// Load the stylesheets
// 		wp_enqueue_style( 'font-awesome', THEMEROOT . '/css/font-awesome.min.css' );
// 		wp_enqueue_style( 'digg-master', THEMEROOT . '/css/master.css' );
// 	}

// 	add_action( 'wp_enqueue_scripts', 'digg_scripts' );
//}

?>
<?php

// Function to add prism.css and prism.js to the site
function add_prism() {
// Register prism.css file
wp_register_style(
'prismCSS', // handle name for the style so we can register, de-register, etc.
get_stylesheet_directory_uri() . '/assets/vendor-theme/css/prism.css' // location of the prism.css file
);
// Register prism.js file
wp_register_script(
'prismJS', // handle name for the script so we can register, de-register, etc.
get_stylesheet_directory_uri() . '/assets/js/prism.js' // location of the prism.js file
);
// Enqueue the registered style and script files
wp_enqueue_style('prismCSS');
wp_enqueue_script('prismJS');
}
add_action('wp_enqueue_scripts', 'add_prism');
?>