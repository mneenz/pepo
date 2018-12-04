<?php
/*
Archive Page
*/
get_header(); ?>

<section id="content" role="main">
	<section id="posts" class="listed-posts">
		<article class="post-category">
		 <!-- Category description -->
				<h2><?php the_archive_title(); ?></h2> <!-- Title -->
			
			<?php if ( '' != category_description() ) echo apply_filters('archive_meta', '<section class="introduction"><p class="precede">' . category_description() . '</p></section>'); ?>
		</article>

		<!-- Loop through projects -->
		<?php
			if ( have_posts() ) {
				while( have_posts() ) {
				    the_post();
				    get_template_part( '/template-parts/post-content', get_post_format() );
				}
			}
		?>

	</section>
</section>

<?php get_footer(); ?>
