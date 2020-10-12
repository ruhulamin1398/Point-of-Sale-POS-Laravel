$(document).ready(function(){


    
    $(".inputMinZero").on('change',function(){

        var data=  $(this).val().trim();
       
         if(data.length<1){
             $(this).val(0);
         }
         if(data<0){
            $(this).val(0);
        }
     });

    
     $(".inputMinOne").on('change',function(){

        var data=  $(this).val().trim();
       
        if(data.length<1){
            $(this).val(1);
        }
        if(data<1){
            $(this).val(1);
        }
     });
  


     (function($) {
        "use strict"; // Start of use strict
      
        // Toggle the side navigation
        $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
          $("body").toggleClass("sidebar-toggled");
          $(".sidebar").toggleClass("toggled");
          if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
          };
        });
      
        // Close any open menu accordions when window is resized below 768px
        $(window).resize(function() {
          if ($(window).width() < 768) {
            $('.sidebar .collapse').collapse('hide');
          };
        });
      
        // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
        $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
          if ($(window).width() > 768) {
            var e0 = e.originalEvent,
              delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
          }
        });
      
        // Scroll to top button appear
        $(document).on('scroll', function() {
          var scrollDistance = $(this).scrollTop();
          if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
          } else {
            $('.scroll-to-top').fadeOut();
          }
        });
      
        // Smooth scrolling using jQuery easing
        $(document).on('click', 'a.scroll-to-top', function(e) {
          var $anchor = $(this);
          $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
          }, 1000, 'easeInOutExpo');
          e.preventDefault();
        });
      
      })(jQuery); // End of use strict

      





      // check box 
      $(".abasasCheckBox").on('input',function(){
        if ($(this).is(':checked'))
        $(this).val(1)
      else
      $(this).val(0)
      });
      
});