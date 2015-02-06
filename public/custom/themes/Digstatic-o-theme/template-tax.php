<?php
/**
 * template-tax.php
 *
 * Template Name: Taxonomy Page
 */
/**
 * The template for displaying taxonomy fields for portfolio post type
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 */

get_header(); ?>
<!--wrapper-main-->
<div class="wrapper-main">

			<div class="terms">

			<h1>Fields</h1>

		

			<?php

			$fields = get_terms( 'fields' );

			echo '<ul>';

			foreach ( $fields as $term ) {

			    // The $term is an object, so we don't need to specify the $taxonomy.
			    $term_link = get_term_link( $term );
			   
			    // If there was an error, continue to the next term.
			    if ( is_wp_error( $term_link ) ) {
			        continue;
			    }

			    // We successfully got a link. Print it out.
			    echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
			}

			echo '</ul>';

			?>
			</div>



		    <div class="terms">

            <h1>Languages</h1>

        

            <?php

            $languages = get_terms( 'languages' );

            echo '<ul>';

            foreach ( $languages as $term ) {

                // The $term is an object, so we don't need to specify the $taxonomy.
                $term_link = get_term_link( $term );
               
                // If there was an error, continue to the next term.
                if ( is_wp_error( $term_link ) ) {
                    continue;
                }

                // We successfully got a link. Print it out.
                echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
            }

            echo '</ul>';

            ?>
    		</div>	


			<div class="portfolio-fields">

			<h1>Portfolio</h1>

			<?php //start by fetching the terms for the animal_cat taxonomy
			$termsf = get_terms( 'fields', array(
			    'orderby'    => 'count',
			    'hide_empty' => 0
			) );
			?>

			<?php
			// now run a query for each animal family
			foreach( $termsf as $term ) {
			 
			    // Define the query
			    $args = array(
			        'post_type' => 'portfolio',
					        'fields' => $term->slug
			    );
			    $query = new WP_Query( $args );
			             
			    // output the term name in a heading tag                
			    echo'<h2>' . $term->name . '</h2>';
			     
			    // output the post titles in a list
			    echo '<ul>';
			     
			        // Start the Loop
			        while ( $query->have_posts() ) : $query->the_post(); ?>
			 
			        <li class="animal-listing" id="post-<?php the_ID(); ?>">
			            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			        </li>
			         
			        <?php endwhile;
			     
			    echo '</ul>';
			     
			    // use reset postdata to restore orginal query
			    wp_reset_postdata();
			 
			} ?>
		</div><!--end portfolio-fields-->



		<div class="snippets-languages">

			<h1>Snippets</h1>
			<?php //start by fetching the terms for the animal_cat taxonomy
			$termsl = get_terms( 'languages', array(
			    'orderby'    => 'count',
			    'hide_empty' => 0
			) );
			?>

			<?php
			// now run a query for each animal family
			foreach( $termsl as $term ) {
			 
			    // Define the query
			    $args = array(
			        'post_type' => 'snippets',
					        'languages' => $term->slug
			    );
			    $query = new WP_Query( $args );
			             
			    // output the term name in a heading tag                
			    echo'<h2>' . $term->name . '</h2>';
			     
			    // output the post titles in a list
			    echo '<ul>';
			     
			        // Start the Loop
			        while ( $query->have_posts() ) : $query->the_post(); ?>
			 
			        <li class="animal-listing" id="post-<?php the_ID(); ?>">
			            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			        </li>
			         
			        <?php endwhile;
			     
			    echo '</ul>';
			     
			    // use reset postdata to restore orginal query
			    wp_reset_postdata();
			 
			} ?>
		</div><!-- end snippets-languages-->

</div> <!--End wrapper-main-->

<div class="exploring">
	<h3>Output a list all registered taxonomies</h3>

<?php

$taxonomies = get_taxonomies(); 
foreach ( $taxonomies as $taxonomy ) {
    echo '<p>' . $taxonomy . '</p>';
}

?>

	<h3>Output a list of all public custom taxonomies</h3>

<?php 
$args = array(
  'public'   => true,
  '_builtin' => false
  
); 
$output = 'names'; // or objects
$operator = 'and'; // 'and' or 'or'
$taxonomies = get_taxonomies( $args, $output, $operator ); 
if ( $taxonomies ) {
  foreach ( $taxonomies  as $taxonomy ) {
    echo '<p>' . $taxonomy . '</p>';
  }
}
?>

	<h3>Output a named taxonomy</h3>

<?php 
$args=array(
  'name' => 'languages'
);
$output = 'objects'; // or names
$taxonomies=get_taxonomies($args,$output); 
if  ($taxonomies) {
  foreach ($taxonomies  as $taxonomy ) {
    echo '<p>' . $taxonomy->name . '</p>';
  }
}  
?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
