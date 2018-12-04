<?php
/*
404 Page
*/
get_header(); ?>

<section id="content" role="main">
	<section id="posts" class="listed-posts">
		<article class="post-category">
		 <!-- Title -->
			<h2>Nothing found</h2>
			<p>Sorry, nothing was found for the requested page. Try a search instead.</p>
		</article>

			<article class="entry-content">
				<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="text" placeholder="Search &amp; press enter" name="s" id="s">
				</form>
			</article>
	</section>
</section>

<?php get_footer(); ?>
