/*
Single Post Image Slider
*/

function Slider () { // Create the top slideshow autoscroll function



	// Define max and min slide positionings
	var maxX = 0; // farthest to right it can go
	var contentDivWidth = $("#content").outerWidth();
	var minX = - ($("#slides").outerWidth() + contentWidth); // farthest to right it can go

	if (contentDivWidth > 1800) {
		var contentWidth = contentDivWidth;
	} else {
		var contentWidth = ((contentDivWidth) - 90);
	}


	if ($("#slides").outerWidth() > contentWidth) { //Check if there are more images than the window can fit

		$("#slides #slide:first").addClass('active'); //Add active class to first slide

		//Width of the slideshow - the width of the content
		var endofSlideshow = $("#slides").outerWidth() - contentWidth;

		function automatic() { //Create automatic function
			var left = ($("#slides").position().left); //Get the left positioning of the slideshow

			var active = $("#slides .active"); //Get the active thumbnails width
			function addRemoveClass () {
				$(active).next().addClass('active'); //Make the next thumbnail active
				$("#slides .active:first").removeClass('active'); //Remove the first one
			}

			/*We want to make the image go to the center of the page so we calculate  the page / 2 minus the next active image */
			var centerImage = (contentWidth / 2) - active.next().outerWidth();

			var totalWidth = 0;
			$(active).next().prevAll().each(function() {
					totalWidth += parseInt($(this).outerWidth(), 10);
			}); //Get the width of all the slideshow images that are before the (next) active one and combine their value (this is how much we will move the slider in order to show the active one). Set this to the variable totalWidth

			var howMuchWereMoving = ((totalWidth) - centerImage);

			if ((-howMuchWereMoving) > 0) { //If the amount the slideshow is moving is larger than 0
				if(($(active).next().length > 0)) {
					$("#slides").animate({'left': '0px'}); //Move the slideshow to the left based on the active image width
					addRemoveClass();
				} else {

				}
			} else if (howMuchWereMoving > endofSlideshow) { //Check if the amount the slideshow is moving is larger than the width of the slideshow - the width of the content

					$("#slides").animate({left: -(endofSlideshow)}, 500); //Move the slideshow to the left based on the active image width
						addRemoveClass();

				} else { //If the slider can move more to the right

				 $("#slides").animate({left: -howMuchWereMoving}, 500); //Move the slideshow to the left based on the active thumbnails width
				 addRemoveClass();
				}

		}

		var mainSliderTimer; // Create the variable mainSliderTimer
		function mainSliderAutomatic () { // Create the top slideshow autoscroll function
			mainSliderTimer =  window.setInterval(function(){  // Repeat the function every 5 seconds
				automatic(); //Call the nextSlide function
			}, 3000);
		}

		/*Image lightbox*/
		function CloseLightbox() { //Close the lightbox function
			$('#lightbox').fadeOut( "slow", function() { //Fade Out the lightbox
				$('#lightbox div').remove();
		  });
		}

		$('#slide img').click(function(e) { //When clicking on a slide image
			clearInterval(mainSliderTimer); // Stop the autoscroll function
			//insert img tag with clicked link's href as src value
			var image_href = $(this).attr('src'); //Get the SRC attribute
				$( "<div id='lightbox-content'><img src='" + image_href + "' /></div>" ).appendTo( "#lightbox" ); //Create lightbox
				$('#lightbox').fadeIn("slow");
		});

		$('#lightbox').on('click', function(e) {//Lightbox onClick
				e.preventDefault(); //Prevent Default
				CloseLightbox();  //Close the lightbox
		});

		$(document).keyup(function(e) { //Esc
			if (e.keyCode === 27) { //Esc
				e.preventDefault(); //Prevent Default
				if ($('#lightbox div').length){ //If there is a lightbox
					CloseLightbox(); //Close the lightbox
				}
			}
		});

		if (!$('#slide #video').length > 0){ //Check if there isn't a video tag (we don't want to start the slider if there is a video)
			//Run mainSliderAutomatic autoscroll function
			mainSliderAutomatic();
		}

		//Clickable arrows
		$('#navigation #prev').on( "click", function() {
			clearInterval(mainSliderTimer); // Stop the autoscroll function
			var left = $("#slides").position().left; //Get the left positioning of the slideshow
			var active = $("#slides .active"); //Get the active thumbnails width
			var centerImage = (contentWidth / 2) - active.prev().outerWidth();

			function addRemoveClass () {
				(active).prev().addClass('active'); //Make the next thumbnail active

				if ($("#slides .active").length > 1) {
					$("#slides .active:last").removeClass('active'); //Remove the first one
				}
			}

			var totalWidth = 0;
			(active).prev().prevAll().each(function() {
					totalWidth += parseInt($(this).outerWidth(), 10);
			}); //Get the width of all the slideshow images that are before the active one and combine their value (this is how much we will move the slider in order to show the active one). Set this to the variable totalWidth

			if ( (left + centerImage ) > 0) { //Check if the left positioning of the slideshow is less than 0

				$("#slides").animate({'left': '0px'}); //Move the slideshow to the left based on the active image width
				addRemoveClass();

			} else if ((totalWidth - centerImage) > (endofSlideshow)) { //Check if the active slides width - the left positioning of the slideshow is larger than the width of the slideshow - the width of the content

				addRemoveClass();

			} else {

				$("#slides").animate({left:-((totalWidth) - centerImage)}, 500); //Move the slideshow to the left based on the active thumbnails width

				addRemoveClass();
			}
		});

		$('#navigation #next').on( "click", function() {
			clearInterval(mainSliderTimer); // Stop the autoscroll function
			automatic();
		});

	//If there aren't more images than the window can fit
	} else {

		//Check if there is only 1 slide image
		if ($("#slides div").length == 1) {
			$("#slides").addClass('full-width'); //Add the full width class
		}

		$('#navigation').hide(); //Hide the navigation
		$('#slides div').addClass('active'); //add the active class to the first slide
	}
}

$(window).load(function () {

	Slider();

});

//Events on window resize
$(window).resize(function () {
		/*Move #slides to left*/
		Slider();

});
