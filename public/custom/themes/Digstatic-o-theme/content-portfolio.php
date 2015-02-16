<?php
/**
 * content-portfolio.php
 * The default template for displaying content.
 *
 */
?>

<!--<div class="hover-tile-outer">
  <div class="hover-tile-container">
    <div class="hover-tile hover-tile-visible"></div>
    <div class="hover-tile hover-tile-hidden">
      <h4>Hidden Copy</h4>
      <p>Lorem ipsum dolor provident eligendi fugiat ad exercitationem sit amet, consectetur adipisicing elit. Unde, provident eligendi.</p>
    </div>
  </div>
</div>-->

<?php if ( ! is_single() ): ?>
<?php if ( has_post_thumbnail( $post->ID ) ) { ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>

  <div class="hover-tile-outer" style="background-image: url('<?php echo $image[0]; ?>')">
  	<div class="hover-tile-container">
    	<div class="hover-tile hover-tile-visible"></div>
    	<div class="hover-tile hover-tile-hidden">
      		<a id="post-<?php the_ID(); ?>" href="<?php the_permalink(); ?>" rel="bookmark">
      			<h2><?php the_title(); ?></h2>
      		</a>
      		<div>
      			<p>	<?php digg_portfolio_meta_c(); ?></p>	
      			
      		</div>
    	</div>
  	</div>
  </div>
<?php } else { ?>
	    	<div class="">
      		<a id="post-<?php the_ID(); ?>" href="<?php the_permalink(); ?>" rel="bookmark">
      			<h2><?php the_title(); ?></h2>
      		</a>
      		<p>	<?php digg_portfolio_meta_c(); ?></p>
			
      		
    	</div>
<?php } ?>




<?php else : ?>
<div class="wrapper-main">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<div class="main-portfolio">
		<?php
			// Display the meta information
			digg_post_meta_date();
		?>
		<?php
		// if ( is_search() ) {
		// 	the_excerpt();
		// } else {
			the_content( __( 'Continue reading &rarr;', 'digg' ) );

		// 	wp_link_pages();
		// }
		?>
				
		</div>



	
			

		







		<footer class="entry-footer">


			<div class="footer-nav" style="width:100%;">
			<div class="before">	
			<?php previous_post_link( '%link', '&laquo Previous Entry', FALSE ); ?>
			</div>
			<div class="after">	
			<?php next_post_link( '%link', 'Next Entry &raquo', FALSE ); ?>
			</div>

			
			</div>

		</footer> <!-- end entry-footer -->
	</article>	<!-- end Article -->


</div> <!--End wrapper-main-->
<div class="sidebar aside-portfolio-desc">


	<div class="entry-content portfolio">
			<div class="term index">
				<div class="chrome">
					<span class="btn btn-term close"></span>
					<span class="btn btn-term min"></span>
					<span class="btn btn-term max"></span>
										<?php
					digg2_portfolio_meta_b2();
					?>

				</div>
				<div class="shell">
					<div class="workshopper">
					<div class="portfolio-meta"><div style="padding:2em;">

					<?php
					digg_portfolio_meta_b();
					?>

		
	<?php
		// Display the meta information
		digg_post_meta_d();
	?>
					</div></div><!--End portfolio-meta-->
					</div>
				</div>
			</div>
	</div><!-- end entry-content -->

	

	<div>	



	</div><!-- end entry-header -->
	<?php 
		// If we have a single page and the author bio exists, display it
		if ( is_single() && get_the_author_meta( 'description' ) ) {
			echo '<h2>' . __( 'Written by ', 'digg' ) . get_the_author() . '</h2>';
			echo '<p>' . the_author_meta( 'description' ) . '</p>';
		}
	?>
				
</div>
<?php endif; ?>
