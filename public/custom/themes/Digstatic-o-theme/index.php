<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 */
?>
<?php get_header(); ?>
<!--wrapper-main-->
<div class="wrapper-main">
<?php if ( have_posts() ) : ?>
<?php /* The loop */ ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
    <?php endwhile; ?>
	
	<?php digg_paging_nav(); ?>

	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>
</div> <!--End wrapper-main-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>