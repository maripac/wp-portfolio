<?php
/**
 * The template for displaying single portfolio 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 */

get_header(); ?>
<!--wrapper-main-->


	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content-portfolio', get_post_format() ); ?>
			
		<?php comments_template(); ?>
	<?php endwhile; ?>


<?php // get_sidebar(); ?>

<?php get_footer(); ?>
