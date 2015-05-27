// jQuery(document).ready(function ($) {
//     console.log( "ready!" );
// });

// jQuery(window).scroll(function() {
//     if (jQuery(window).scrollTop() > 950) {
//         jQuery('.secondary-nav').addClass('second-nav-scroll');
//     } else {
//         jQuery('.secondary-nav').removeClass('second-nav-scroll');
//     }
// });


// (function($, undefined){
//   "use strict";
//   console.log("all systems go");

//   var $navbar = $(".secondary-nav"),
//       y_pos = $navbar.offset().top,
//       height = $navbar.height();

//   $(document).scroll(function(){    
//     var scrollTop = $(this).scrollTop();

//     if (scrollTop > y_pos + height){
//       $navbar.addClass("second-nav-scroll").animate({ top: 0 });
//     } else if (scrollTop <= y_pos){        
//       $navbar.removeClass("second-nav-scroll").clearQueue().animate({ top: "45px" }, 0);
//     }
//   });
  
// })(jQuery, undefined);