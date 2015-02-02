<?php
/**
 * content.php
 * The default template for displaying content.
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- Article header-->
	<header class="entry-header"> <?php
			// If the post has a thumbnail and it's not password protected
			// then display the thumbnail
			if ( has_post_thumbnail() && ! post_password_required() ) : ?>
				<figure class="entry-thumbnail"><?php the_post_thumbnail(); ?></figure>
			<?php endif; 

			// If it's single page, display the title
			// Else, display the title in a link
			if ( is_single() ) : ?>
				<h1><?php the_title(); ?></h1>
				
				<?php
					// Display the meta information
					digg_snippets_meta();
				?>
					
				<?php
					// Display the meta information
					digg_post_meta_b();
				?>

	</header><!-- end entry-header -->
		<!-- Article content -->

		<div class="entry-content">
			<div class="term">
				<div class="chrome">
					<span class="btn btn-term close"></span>
					<span class="btn btn-term min"></span>
					<span class="btn btn-term max"></span>

				</div>
				<div class="shell">
					<div class="workshopper">

					<?php
						// if ( is_search() ) {
						// 	the_excerpt();
						// } else {
							the_content( __( 'Continue reading &rarr;', 'digg' ) );

						// 	wp_link_pages();
						// }
					?>
					<?php
						/* translators: %s: Name of current post */
						// the_content( sprintf(
						// 	__( 'Continue reading %s', 'twentyfifteen' ),
						// 	the_title( '<span class="screen-reader-text">', '</span>', false )
						// ) );


					?>
					</div>
				</div>
			</div>
		</div><!-- end entry-content -->

		<?php else : ?>
			<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>


			
				<?php
					// Display the meta information
					digg_snippets_meta();
				?>

				<?php
					// Display the meta information
					digg_post_meta_b();
				?>
			
	</header><!-- end entry-header -->
	<!-- Article content -->

	<footer class="entry-footer">
	<?php 
		// If we have a single page and the author bio exists, display it
		if ( is_single() && get_the_author_meta( 'description' ) ) {
			echo '<h2>' . __( 'Written by ', 'digg' ) . get_the_author() . '</h2>';
			echo '<p>' . the_author_meta( 'description' ) . '</p>';
		}
	?>
	<?php
		// Display the meta information
		digg_comments();
	?>
	</footer> <!-- end entry-footer -->
	<?php endif; ?>
</article>