<?php 
/**
 * sidebar-navget.php
 *
 * The navget sidebar.
 */
?>

<div class="wrapper-navget">



		<div class="portfolio-fields">

			<?php //start by fetching the terms for the animal_cat taxonomy
			
			$terms = get_terms( 'fields', array(
			    'orderby'    => 'count',
			    'hide_empty' => 0
			) );
			?>
			<h5>Taxonomy Fields</h5>
			<?php
			// now run a query for each animal family
			foreach( $terms as $term ) {
			    // Define the query
			    $args = array(
			        //'post_type' => 'portfolio',
			        'post_type' => array('portfolio', 'post'),
					        'fields' => $term->slug
			    );
			 

			    $query = new WP_Query( $args );
			    $term_link = get_term_link( $term );
			             
			    // output the term name in a heading tag 
			    echo '<a href="' . esc_url( $term_link ) . '"><h1>' . $term->name . '</h1></a>';               
			    //echo'<h2>' . $term->name . '</h2>';
			     
			    // output the post titles in a list
			    echo '<ul>';
			     
			        // Start the Loop
			        while ( $query->have_posts() ) : $query->the_post(); ?>
			 
			        <li class="tax-listing" id="post-<?php the_ID(); ?>">
			            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			        </li>
			         
			        <?php endwhile;
			     
			    echo '</ul>';
			     
			    // use reset postdata to restore orginal query
			    wp_reset_postdata();
			 
			} ?>
		</div><!-- end snippets-languages-->



		<div class="snippets-languages">

			<?php //start by fetching the terms for the animal_cat taxonomy
			$termsl = get_terms( 'languages', array(
			    'orderby'    => 'count',
			    'hide_empty' => 0
			) );
			?>
			<h5>Taxonomy Languages</h5>
			<?php
			// now run a query for each animal family
			foreach( $termsl as $term ) {
			 
			    // Define the query
			    $args = array(
			        'post_type' => array('snippets', 'post'),
					        'languages' => $term->slug
			    );
			    $query = new WP_Query( $args );
			    $term_link = get_term_link( $term );
			             
			    // output the term name in a heading tag 
			    echo '<a href="' . esc_url( $term_link ) . '"><h1>' . $term->name . '</h1></a>';               
			    //echo'<h2>' . $term->name . '</h2>';
			     
			    // output the post titles in a list
			    echo '<ul>';
			     
			        // Start the Loop
			        while ( $query->have_posts() ) : $query->the_post(); ?>
			 
			        <li class="tax-listing" id="post-<?php the_ID(); ?>">
			            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			        </li>
			         
			        <?php endwhile;
			     
			    echo '</ul>';
			     
			    // use reset postdata to restore orginal query
			    wp_reset_postdata();
			 
			} ?>
		</div><!-- end snippets-languages-->











</div> <!--End wrapper-navget-->