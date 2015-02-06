<?php
/**
 * content-snippets.php
 * The default template for displaying content.
 *
 */
?>
<?php
			// If the post has a thumbnail and it's not password protected
			// then display the thumbnail
			//if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<!--	<figure class="entry-thumbnail"><?php // the_post_thumbnail(); ?></figure>-->
	<?php //endif; 

	// If it's single page, display the title
	// Else, display the title in a link
	if ( is_single() ) : ?>
<div class="wrapper-main">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- Article header-->
		<header class="entry-header"> 
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="sub-title">
			<?php
				// Display the meta information
				 digg_post_meta_c();
			?>
			</div>

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

					</div>
				</div>
			</div>
		</div><!-- end entry-content -->
	

		<footer class="entry-footer">


			<div class="row" style="width:100%;">
			<?php previous_post_link( '%link', '&laquo Previous Snippet', FALSE ); ?>
			<?php next_post_link( '%link', 'Next Snippet &raquo', FALSE ); ?>
			</div>


			<?php
				// Display the meta information
				//digg_comments();
			?>
		</footer>

	</article>

</div> <!--End wrapper-main-->
<div class="sidebar aside-snippets-meta">


	<?php
		// Display the meta information
		 digg_snippets_meta();
	?>
				

	<?php 
		// If we have a single page and the author bio exists, display it
		//if ( is_single() && get_the_author_meta( 'description' ) ) {
		//	echo '<h2>' . __( 'Written by ', 'digg' ) . get_the_author() . '</h2>';
		//	echo '<p>' . the_author_meta( 'description' ) . '</p>';
		//}


	?>
</div>




	<?php else : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- Article header-->
		<header class="entry-header"> 
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			
		</header><!-- end entry-header -->
		<!-- Article content -->

		<div class="entry-content">
			<div class="term index">
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
		<!-- Article content -->

	</article>

<?php endif; ?>
