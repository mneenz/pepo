//Load more projects script

jQuery(function($){
	var canBeLoaded = true, // this param allows to initiate the AJAX call only if necessary
	    bottomOffset = 2000; // the distance (in px) from the page bottom when you want to load more posts

	$(window).scroll(function(){
		var data = {
			'action': 'loadmore',
			'query': pepo_loadmore_params.posts,
			'page' : pepo_loadmore_params.current_page
		};

		if( $(document).scrollTop() > ( $(document).height() - bottomOffset ) && canBeLoaded == true ){
			$.ajax({
				url : pepo_loadmore_params.ajaxurl,
				data:data,
				type:'POST',
				beforeSend: function( xhr ){
					// you can also add your own preloader here
					// you see, the AJAX call is in process, we shouldn't run it again until complete
					canBeLoaded = false;
				},
				success:function(data){
					if( data ) {
						$('#posts').find('.post-item:last-of-type').after( data ); // where to insert posts
						$('.post-category').height($('#news').height());

						canBeLoaded = true; // the ajax is completed, now we can run it again
						pepo_loadmore_params.current_page++;
						if ( pepo_loadmore_params.current_page == pepo_loadmore_params.max_page ) //Check if there are no more posts to load
							$( "<section id='no-more-posts'>No more posts to load</div>" ).appendTo('.listed-projects');
					}
				}
			});
		}
	});
});
