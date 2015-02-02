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

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content-snippets', get_post_format() ); ?>
			
		<?php comments_template(); ?>
	<?php endwhile; ?>

</div> <!--End wrapper-main-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
