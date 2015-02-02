<?php
/**
 * The template for displaying pages
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


		<?php
		// Start the loop.
		while ( have_posts() ) : the_post(); ?>

			<!-- Article article-->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Article header-->
				<header class="entry-header"> <?php
					// If the post has a thumbnail and it's not password protected
					// then display the thumbnail
					if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<figure class="entry-thumbnail"><?php the_post_thumbnail(); ?></figure>
					<?php endif; ?>

					<h1><?php the_title(); ?></h1>

				</header><!-- end entry-header -->
			<!-- Article content -->
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
					<?php /*
						if ( is_search() ) {
							the_excerpt();
						} else {
							the_content( __( 'Continue reading &rarr;', 'digg' ) );

							wp_link_pages();
						}
					*/?>

				</div><!-- end entry-content -->
			<!-- Footer entry-footer -->
				<footer class="entry-footer">
					<?php 
						if ( is_user_logged_in() ) {
							echo '<p>';
								edit_post_link( __( 'Edit', 'digg' ), '<span class="meta-edit">', '</span>' );
							echo '</p>';
						}
					?>
				</footer> <!-- end entry-footer -->
			</article><!-- end Article article-->
			
		<?php 
			// If comments are open or we have at least one comment, load up the comment template.
			//if ( comments_open() || get_comments_number() ) :
				comments_template();
			//endif; ?>
		<?php 
		// End the loop.
			endwhile;
		?>
</div> <!--End wrapper-main-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
