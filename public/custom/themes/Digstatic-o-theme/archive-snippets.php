<?php 
/**
 * archive-snippets.php
 *
 * The template for displaying archive pages.
 */
?>

<?php get_header(); ?>

	<div class="wrapper-main col-md-8" role="main">
		<?php if ( have_posts() ) : ?>
			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content-snippets', get_post_format() );

			// End the loop.
			endwhile; ?>
			<div class="paging-nav">
				<?php digg_paging_nav(); ?>
			</div>
		<?php
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content-snippets', 'none' );

		endif;
		?>

	</div> <!-- end wrapper-main -->
<?php //endif; ?>
<?php

// 	// If it's single page, display the title
// 	// Else, display the title in a link
// if ( is_single() ) { 
// 		get_footer(); 
// } else { 
//  get_sidebar(); 
//  get_footer(); 
// } 


// 
// if ( ! is_single() ) {
//   get_sidebar();
// } else {
//   get_footer();
// } 

?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>