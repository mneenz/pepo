<?php
/*
Search Page
*/
get_header(); ?>

<section id="content" role="main">
	<section id="posts" class="listed-posts">
		<article class="post-category">
		 <!-- Category description -->
			<h2>Search results for: <span><?php printf( get_search_query() ); ?></span></h2>
		</article>

		<!-- Loop through projects -->
		<?php
		if ( have_posts() ) {
			while( have_posts() ) {
				the_post();
					get_template_part( '/template-parts/post-content', get_post_format() );
			}
		} else {
		?>
			<article class="entry-content">
				<p>Sorry, nothing matched your search. Please try again</p>
				<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="text" placeholder="Search &amp; press enter" name="s" id="s">
				</form>
			</article>
		<?php }?>
	</section>
</section>

<?php get_footer(); ?>
