<?php 
/**
 * taxonomy-languages.php
 *
 * The template for displaying tag pages.
 */
?>

<?php get_header(); ?>

<div class="wrapper-main col-md-8" role="main">
<?php
    //this loop returns all movies separated by genres they belong to
    // $post_type = 'snippets'; // <-- put your custom post type here
    // $tax = 'languages'; // <-- put your custom taxonomy here
    // $tax_terms = get_terms($tax);
    // if ($tax_terms) {
    //   foreach ($tax_terms as $tax_term) {
        
    //     $args=array(
    //       'post_type' => $post_type,
    //       "$tax" => $tax_term->slug,
    //       'post_status' => 'publish',
    //       'posts_per_page' => 10
    //     );
    
    //     $my_query = null;
    //     $my_query = new WP_Query($args);
    //     if( $my_query->have_posts() ) {
    //       echo $tax_term->name;
    //       while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <!--         <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
    -->         <?php
    //       endwhile;
    //     }
    //     wp_reset_query();
    //   }
    // }
?>


<?php query_posts(digg_query_args_a()); ?>
<article>
	<ul>
	    <?php while ( have_posts() ) : the_post(); ?>  
		    <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		            <a href="<?php the_permalink() ?>"><h1 class="entry-title"><?php the_title(); ?></h1></a>
		    </li>
	    <?php endwhile; ?>
	</ul>
</article>

		
</div> <!-- end wrapper-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>