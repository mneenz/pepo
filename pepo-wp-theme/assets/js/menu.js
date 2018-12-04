/*
Menu events
*/

$(window).load( function() {
  //Show loading icon until page has loaded
  $(".spinner").delay(500).fadeOut(1000);
  $(".loading").delay(1000).animate({'opacity': 1 }, 1000);

  //Change background image after 4 seconds
  setTimeout(function() {
    $('body.home.background-image').css('background-image', 'url(/wp-content/themes/pepo-wp-theme/assets/images/home-background-2.jpg)');
  }, 8000);

  if ($('body').hasClass('home')) {
    setTimeout( function(){ $('#branding').removeClass("home-animation"); }, 9000 );
  }

});

$(document).ready(function(){

  //Load background image
  if (document.images) {
	   img = new Image();

     img.src = "http://test.pepo.com.au/wp-content/themes/pepo-wp-theme/assets/images/home-background-2.jpg";
  }

  //Menu click
  $("a.slicknav_btn, #contact-title").click(function(e){
    e.preventDefault();
    e.stopPropagation(); // Prevents the event from bubbling up the DOM tree, preventing any parent handlers from being notified of the event
    $('#header').toggleClass('closed open'); //Add open or closed class to menu
  });

  //Change the subject header based on the 'Have some questions?' click
  $('.column h4 a').click(function(e){
    e.preventDefault();
    e.stopPropagation(); // Prevents the event from bubbling up the DOM tree, preventing any parent handlers from being notified of the event
    $('#ccf_field_subject').val($(this).attr('href')).trigger('change');
    $('#ccf_field_subject').trigger('click');

    //Check if the menu is closed
    if ($('#header').hasClass('closed')) {
      $('#header').toggleClass('closed open'); //Open it if it's closed
    }
  });

});
