<?php 
/**
 * footer.php
 *
 * The template for displaying the footer.
 */
?>
<?php
	$powerjs = THEMEROOT . '/assets/js/power.js';
 ?>

		</div> <!-- end row -->
	</div> <!-- end container -->

	<!-- FOOTER -->
	<footer class="site-footer">
		<div class="container-frame">
			<div class="row">



				<div class="copyright">
					<p>
						&copy; <?php echo date( 'Y' ); ?>
						<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
						<?php _e( 'All rights reserved.', 'digg' ); ?>
					</p>
				</div> <!-- end copyright -->
			</div>
		</div> <!-- end container -->
	</footer> <!-- end site-footer -->

	
	</div><!-- end #site-canvas -->
	</div><!-- end #site-wrapper -->
	<?php wp_footer(); ?>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <!--<script src="<?php echo $powerjs; ?>"></script>-->
 <!-- <script src='https://assets.codepen.io/assets/libs/fullpage/jquery-c152c51c4dda93382a3ae51e8a5ea45d.js'></script>-->

  <!--<script src="https://assets.codepen.io/assets/common/stopExecutionOnTimeout-6c99970ade81e43be51fa877be0f7600.js"></script>-->

<script>


$(function() {
var trigger = $('#hamburger');
var isClosed;
trigger.click(function() {
	toggleNav();

	burgerTime();
});
function toggleNav() {

	if ($('#site-wrapper').hasClass('show-nav')) {
		// Do things on Nav Close

		$('#site-wrapper').removeClass('show-nav');
		isClosed = true;
	} else {
		// Do things on Nav Open
		$('#site-wrapper').addClass('show-nav');
		isClosed = false;
	}

//$('#site-wrapper').toggleClass('show-nav');
}

function burgerTime() {
    if (isClosed == false) {
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        //isClosed = false;
    } else {
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        //isClosed = true;
    }
}

});




</script>

<?php if( is_post_type_archive('portfolio') || is_singular( 'portfolio' )  ) : // Checks if this version of WP supports menus ?>
	<script>
		$(document).ready(function() {
		  var menuToggle = $('#js-mobile-menu').unbind();
		  $('#js-navigation-menu').removeClass("show");

		  menuToggle.on('click', function(e) {
		    e.preventDefault();
		    $('#js-navigation-menu').slideToggle(function(){
		      if($('#js-navigation-menu').is(':hidden')) {
		        $('#js-navigation-menu').removeAttr('style');
		      }
		    });
		  });
		});
	</script>
<?php endif; // ends the conditional argument ?>

</body>

</html>