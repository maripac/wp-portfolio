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
		<?php else : ?>
			<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif; ?>

		<p class="entry-meta">
			<ul class="entry-taxonomies">

			</ul>
			<?php
				// Display the meta information
				digg_post_meta_b();
			?>


		</p>
	</header><!-- end entry-header -->
	<!-- Article content -->
	<div class="entry-content">
		<?php
			if ( is_search() ) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading &rarr;', 'digg' ) );

				wp_link_pages();
			}
		?>

	</div><!-- end entry-content -->
	<footer class="entry-footer">
		<?php 
			// If we have a single page and the author bio exists, display it
			if ( is_single() && get_the_author_meta( 'description' ) ) {
				echo '<h2>' . __( 'Written by ', 'digg' ) . get_the_author() . '</h2>';
				echo '<p>' . the_author_meta( 'description' ) . '</p>';
			} ?>
		<?php /*
			if ( is_single() ) { ?>
			<?php // previous_post_link('%link', '%title', TRUE, '7'); ?> &bull; 
			<?php // next_post_link('%link', '%title', TRUE, '7'); ?>
		<?php }*/ ?>
		<?php 
			if ( is_single() ) { ?>
			<?php previous_post_link('<div class="go__back"> <<-- Older post: %link </div>', '%title', TRUE ); ?> 
			<?php next_post_link('<div class="go__forth"> Newer post: %link -->> </div>', '%title', TRUE ); ?>
		<?php } ?>
	</footer> <!-- end entry-footer -->
</article>