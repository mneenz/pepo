<?php
// Single Post (Projects & News)
get_header(); ?>

	<section id="content" role="main">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<!-- Slider -->
			<?php get_template_part( '/template-parts/slider'); ?>

			<article class="text">

				<!--Category-->
				<div class="category">
					<?php
					$categories = get_the_category($post->ID);//Get the main category
					$last_category = $categories[0]; //Get the last category
					foreach($categories as $i => $category) : //Foreach through the last categories
						$children = get_categories( array ('parent' => $category->term_id ));//Get children
						$has_children = count($children); //Count the children
						if ($category->cat_ID == 7):?>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/maintenance-icon.svg" title="Maintenance Project" class="project-icon" width="35" height="auto">
						<?php endif;?>
						<?php if ($category->cat_ID == 5):?>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/design-installation-icon.svg" title="Design and Installation Project" class="project-icon" width="35" height="auto">
						<?php endif;
						if ( $has_children == 0 ) { //If the children are equal to 0
							$permalink = get_category_link($category->cat_ID); //Set the variable permalink to category link
								echo '<a class="category-link" href="'. $permalink .'"><h3>'. $category->name .'</h3></a>';
							} elseif( $category->parent == $last_category->cat_ID) { //Elseif the parent is the same as the last category
								$last_category = $category; echo '<a class="category-link" href="'. $permalink .'"><h3>'. $category->name .'</h3></a>'; //Make the parent category the last category
							}
					endforeach;
					?>
				</div>

				<section class="share-section">
					<a href="javascript:fbShare('<?php the_permalink();?>', 'Fb Share', 'Share on Facebook', '', 300, 600)" title="Share on Facebook">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/share-icon.svg" alt="Share on Facebook" width="35" height="auto">
						<h4>Share on Facebook</h4>
					</a>
					<a href="#" onClick="window.print();return false" title="Print page">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/print-icon.svg" alt="Print page" width="35" height="auto">
						<h4>Print page</h4>
			  	</a>
				</section>

				<!-- Post title-->
				<h2 class="post-title"><?php the_title(); ?></h2>

				<section class="main-text">
					<?php the_content(); ?>
				</section>

				<?php if ( in_category('Projects') ) :?>
					<!-- Post tags-->
					<section class="tags">
						<ul>
						<?php
						$posttags = get_the_tags();
							if ($posttags) { // Check if there are tags for the post
								foreach($posttags as $tag) { //foreach through the tags
									echo '<li><a href="'. get_tag_link($tag->term_id) .'" title="'. $tag->name . '">#'. $tag->name . '</a></li>'; //Display the tag in a link
								}
							}?>
						</ul>
					</section>
				<?php elseif ( in_category('News') ):?>
					<!-- Post Archive-->
					<section class="archive-list">
						<h4>Earlier news</h4>
						<ul>
						<?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 6, 'post_type'=>'news', 'format' => 'html' ) ); ?>
						</ul>
					</section>
				<?php endif;?>

				<section class="related-posts">
					<?php $post_objects = get_field('related'); //Get the related and set it to the variable $post_objects
				 		if( $post_objects ): // Check if there are related posts ?>

					    <?php foreach( $post_objects as $post):?>
								<div class="related-post"> <!-- Thumbnail div -->
									<a href="<?php the_permalink();?>" title="<?php the_title();?>" class="post-link"> <!-- Link -->
										<?php the_post_thumbnail('thumbnail');?><!-- Thumbnail -->
										<h4><?php the_title();?></h4> <!-- The title -->
									</a>

								</div>
					    <?php endforeach;

					    wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

				   <?php endif; ?>
				</section>

			</article>

		<?php endwhile; endif; ?>

	</section>

	<!-- Lightbox -->
	<div id="lightbox"></div>

<?php get_footer(); ?>
<script data-cfasync="false" type="text/javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/slider.js"></script>
