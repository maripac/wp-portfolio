<?php 
/**
 * footer.php
 *
 * The template for displaying the footer.
 */
?>


		</div> <!-- end row -->
	</div> <!-- end container -->

	<!-- FOOTER -->
	<!--<footer class="site-footer">
		<div class="container-frame">
			<div class="row">



				<div class="copyright">
					<p>
						&copy; <?php echo date( 'Y' ); ?>-->
						<!--<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>-->
						<?php// _e( 'All rights reserved.', 'digg' ); ?>
					<!--</p>-->
				<!--</div> --><!-- end copyright -->
			<!--</div>-->
		<!--</div>--> <!-- end container -->
	<!--</footer>--> <!-- end site-footer -->

	






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
	<?php wp_footer(); ?>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <!--<script src="<?php echo $powerjs; ?>"></script>-->
 <!-- <script src='https://assets.codepen.io/assets/libs/fullpage/jquery-c152c51c4dda93382a3ae51e8a5ea45d.js'></script>-->

  <!--<script src="https://assets.codepen.io/assets/common/stopExecutionOnTimeout-6c99970ade81e43be51fa877be0f7600.js"></script>-->


 
<?php 
if ( ! is_page_template( 'template-grid-images.php' ) && ! is_front_page() ) :	?>
<?php// if( is_post_type_archive('portfolio') || is_singular( 'portfolio' )  ) : // Checks if this version of WP supports menus ?>
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

// jQuery(function($) {
//   $(window).scroll(function () { 
//     if ($(this).scrollTop() < 200) {
//       $('.grid_control').hide();
//     } else {
//       $('.grid_control').show();
//     }
//   });
// });​
  $(window).scroll(function () { 
    if ($(this).scrollTop() > 100) {
      $('.grid_control').addClass("hidden");
    } else {
    	$('.grid_control').removeClass("hidden");
    }
  });

//var scroll_pos = 0;
//var scroll_time;

// $(window).scroll(function() {
//     clearTimeout(scroll_time);
//     var current_scroll = $(window).scrollTop();

//     if (current_scroll >= $('.grid_control').outerHeight()) {
//         if (current_scroll <= scroll_pos) {
//             $('.grid_control').removeClass('hidden');    
//         }
//         else {
//             $('.grid_control').addClass('hidden');  
//         }
//     }

//     scroll_time = setTimeout(function() {
//         scroll_pos = $(window).scrollTop();
//     }, 100);
// });
</script>
<?php endif; // ends the conditional argument ?>
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

</body>

</html>