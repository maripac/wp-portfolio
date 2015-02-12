<?php 
/**
 * footer.php
 *
 * The template for displaying the footer.
 */
?>
<?php 
$jquery = get_theme_root_uri() .'/Digstatic-o-theme/assets/js/jquery.min.js';

?>
			</div> <!-- end row -->
		</div> <!-- end container -->

<!-- FOOTER -->
<?php if( ! is_page_template( 'template-grid-images.php' ) && ! is_front_page() ): ?>
	</div><!-- end #site-canvas -->
</div><!-- end #site-wrapper -->

<footer id="footer">
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
<?php else : ?>
<div class="copyright-front">
	<p>
		
		<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
		
	</p>
</div> <!-- end copyright -->
<?php endif; ?>



<?php wp_footer(); ?>

<script type='text/javascript' src='<?php echo $jquery; ?>'></script>

<?php

if( is_page_template( 'template-grid-images.php' ) || is_front_page() ):
// OK y-checkout x-checkout + NO hamburger + NO offset left background + NO offset top hides checkbox
?>
	<script>

		$('#switch-x').click(function(){
		    if($(this).is(":checked")) {
		        $('body').addClass("checked-x");
		    } else {
		        $('body').removeClass("checked-x");
		    }
		});
		$('#switch-y').click(function(){
		    if($(this).is(":checked")) {
		        $('body').addClass("checked-y");
		    } else {
		        $('body').removeClass("checked-y");
		    }
		});

	</script>

<?php
//elseif( is_page('About') ):
// NO y-checkout x-checkout + OK hamburger + OK offset left background + NO offset top hides checkbox
?>


<!--	<script>
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
			//$('.grid_control').removeClass("hide");
			isClosed = true;
		} else {
			// Do things on Nav Open
			$('#site-wrapper').addClass('show-nav');
			//$('.grid_control').addClass("hide");
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


	<script>
	$(document).ready(function() {
	var menuToggle = $('#js-mobile-menu').unbind();
		  //var menuToggles = $('.grid_control').unbind();
	$('#js-navigation-menu').removeClass("show");
		  //$('.grid_control').removeClass("hide");
		  

		menuToggle.on('click', function(e) {
		    e.preventDefault();
		    $('#js-navigation-menu').slideToggle(function(){
		      if($('#js-navigation-menu').is(':hidden')) {
		        $('#js-navigation-menu').removeAttr('style');
		      }
		      //$('.grid_control').removeAttr('style');
		    });
		    //$('.grid_control').slideToggle(function(){
		    //  if($('.grid_control').is(':hidden')) {
		    //  }
		    //});	    
		});
	});
	</script>-->

<?php
else :
// OK y-checkout x-checkout + OK hamburger + OK offset left background + OK offset top hides checkbox
?>
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
			$('.grid_control').removeClass("hide");
			isClosed = true;
		} else {
			// Do things on Nav Open
			$('#site-wrapper').addClass('show-nav');
			$('.grid_control').addClass("hide");
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


	<script>
		$(document).ready(function() {
		  var menuToggle = $('#js-mobile-menu').unbind();
		  var menuToggles = $('.grid_control').unbind();
		  $('#js-navigation-menu').removeClass("show");
		  $('.grid_control').removeClass("hide");
		  

		  menuToggle.on('click', function(e) {
		    e.preventDefault();
		    $('#js-navigation-menu').slideToggle(function(){
		      if($('#js-navigation-menu').is(':hidden')) {
		        $('#js-navigation-menu').removeAttr('style');
		     	//$('.grid_control').removeAttr('style');

		        //$('.grid_control').removeAttr('style');
		      }
		      $('.grid_control').removeAttr('style');
		    });
		    $('.grid_control').slideToggle(function(){
		      if($('.grid_control').is(':hidden')) {
		        //$('.grid_control').removeAttr('style');
		     	//$('.grid_control').removeAttr('style');

		        //$('.grid_control').removeAttr('style');
		      }
		    });		    
		  });
		});

	  $(window).scroll(function () { 
	    if ($(this).scrollTop() > 100) {
	      $('.grid_control').addClass("hidden");
	    } else {
	    	$('.grid_control').removeClass("hidden");
	    }
	  });
	</script>


	<script>
	$('#switch-x').click(function(){
	    if($(this).is(":checked")) {
	        $('body').addClass("checked-x");
	    } else {
	        $('body').removeClass("checked-x");
	    }
	});
	$('#switch-y').click(function(){
	    if($(this).is(":checked")) {
	        $('body').addClass("checked-y");
	    } else {
	        $('body').removeClass("checked-y");
	    }
	});
	</script>

<?php endif; // ends the conditional argument ?>


</body>
</html>