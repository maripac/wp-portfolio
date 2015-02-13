// /*====================================
// =            ON DOM READY            =
// ====================================*/
$(function() {
$('#hamburger').click(function() {
// var trigger = $('#hamburger'),
//     isClosed = true;

//$('.toggle-nav').click(function() {
// // Calling a function in case you want to expand upon this.
toggleNav();
// 	burgerTime();
});
});


/*========================================
=            CUSTOM FUNCTIONS            =
========================================*/
function toggleNav() {
if ($('#site-wrapper').hasClass('show-nav')) {
	// Do things on Nav Close
	$('#site-wrapper').removeClass('show-nav');
} else {
	// Do things on Nav Open
	$('#site-wrapper').addClass('show-nav');
}

//$('#site-wrapper').toggleClass('show-nav');
}




// $('document').ready(function () {
//     var trigger = $('#hamburger'),
//         isClosed = true;

//     trigger.click(function () {
//       burgerTime();
//       toggleNav();
//     });

//     function burgerTime() {
//       if (isClosed == true) {
//         trigger.removeClass('is-open');
//         trigger.addClass('is-closed');
//         isClosed = false;
//       } else {
//         trigger.removeClass('is-closed');
//         trigger.addClass('is-open');
//         isClosed = true;
//       }
//     }

//     function toggleNav() {
// 	if ($('#site-wrapper').hasClass('show-nav')) {
// 		// Do things on Nav Close
// 		$('#site-wrapper').removeClass('show-nav');
// 	} else {
// 		// Do things on Nav Open
// 		$('#site-wrapper').addClass('show-nav');
// 	}

// 	//$('#site-wrapper').toggleClass('show-nav');
// 	}

//   });


// function burgerTime() {
//   if (isClosed == true) {
//     trigger.removeClass('is-open');
//     trigger.addClass('is-closed');
//     isClosed = false;
//   } else {
//     trigger.removeClass('is-closed');
//     trigger.addClass('is-open');
//     isClosed = true;
//   }
// }

// $('document').ready(function () {
//     var trigger = $('#hamburger'),
//         isClosed = true;

//     trigger.click(function () {
//       burgerTime();
//     });

//     function burgerTime() {
//       if (isClosed == true) {
//         trigger.removeClass('is-open');
//         trigger.addClass('is-closed');
//         isClosed = false;
//       } else {
//         trigger.removeClass('is-closed');
//         trigger.addClass('is-open');
//         isClosed = true;
//       }
//     }

//   });



// $('document').ready(function () {
//     var trigger = $('#hamburger'),
//         isClosed = true;

//     trigger.click(function () {
//       burgerTime();
//     });

//     function burgerTime() {
//       if (isClosed == true) {
//         trigger.removeClass('is-open');
//         trigger.addClass('is-closed');
//         isClosed = false;
//       } else {
//         trigger.removeClass('is-closed');
//         trigger.addClass('is-open');
//         isClosed = true;
//       }
//     }

//   });