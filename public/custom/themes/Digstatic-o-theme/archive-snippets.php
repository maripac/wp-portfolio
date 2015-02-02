<?php 
/**
 * archive.php
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
			endwhile;
			digg_paging_nav();

			// Previous/next page navigation.
			// the_posts_pagination( array(
			// 	'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
			// 	'next_text'          => __( 'Next page', 'twentyfifteen' ),
			// 	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			// ) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content-snippets', 'none' );

		endif;
		?>




			<?php/* while( have_posts() ) : the_post(); */?>
				<?php/* get_template_part( 'content', get_post_format() ); */?>
			<?php/* endwhile; */?>

			<?php/* digg_paging_nav(); */?>
		<?php/* else : */?>
			<?php/* get_template_part( 'content', 'none' ); */?>
		<?php/* endif; */?>
	</div> <!-- end wrapper-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>