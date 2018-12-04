/*
Main events
*/

function LeftColumnPosition() {
  if ($('body').hasClass('home')) {
    var marginLeft = (parseInt($('.process-content').css('marginLeft')) + parseInt($('.column').css('paddingLeft'))) - $('h4.index-cursor').outerWidth() / 2;
  } else if ($('body').hasClass('page-id-66')) {
    var position = $('.left-column').position();
    var marginLeft = position.left - ($('h4.index-cursor').outerWidth() / 2);
  }

  if ($('body').hasClass('archive') || $('body').hasClass('home') || $('body').hasClass('page-id-66')) {
    $('h4.index-cursor').css({left:marginLeft});
  }
}

$(window).load( function() {
  if ($('body').hasClass('category-news') || $('body').hasClass('page-id-66')) { //Check if the body tag has the category-news class or page-id-66 (about page) class
    var eNewsHeight = $('.category-news .listed-posts > article:nth-child(2) .featured-image img').outerHeight();
    $('#e-news').height(eNewsHeight);
    $('.post-category').height($('#news').height());
  }

  LeftColumnPosition();

   //Click on link to get to content
   $(function() {
     $('a[href*=\\#]:not([href=\\#])').click(function(e) {
       e.preventDefault();
       if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
         var target = $(this.hash);
         target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
         if (target.length) {
           //Stop the process animation on click
           if ($(this).hasClass('process')) {
             $(".index-cursor").css("-webkit-animation-play-state", "paused");
           }

           $('html,body').animate({
           scrollTop: target.offset().top - 60
           }, 1000);
           return false;
         }
       }
     });
   });

   //Stop the process animation on scroll
   $(window).scroll(function() {
     $(".index-cursor").css("animation-iteration-count", "1");
  });
});


$( window ).resize(function() {
  LeftColumnPosition();
});
