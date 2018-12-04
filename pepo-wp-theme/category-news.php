<?php
/*
News category Page
*/
get_header(); ?>

<section id="content" role="main">

  <div class="news-icon">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/news.svg" alt="e-News" width="35" height="auto"/>
  </div>

	<section id="posts" class="listed-posts">
		<article class="post-category">
			<h2><?php single_cat_title(); ?></h2> <!-- Title -->

      <?php get_template_part( '/template-parts/news-sidebar'); ?>

		</article>

		<!-- Loop through news -->
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
