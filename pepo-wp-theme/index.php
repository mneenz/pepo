<?php get_header(); ?>

	<section id="content" role="main">
		<?php $homePage = get_post( 63 );?>
		<section class="headerContent">
			<h1 class="introduction"><?php the_field('introduction_text',$homePage);?></h1>
		</section>

		<article class="process" id="process">
			<section class="process-content">

				<div>
					<h4 class="index-cursor" style="top: -32px;"><a href="#process" class="process" title="process">process</a></h4>
				</div>

				<section class="column">
					<?php the_field('first_paragraph',$homePage);?>
					<h4><a id="contact-link" href="<?php the_field('question_title_01',$homePage);?>">Have some questions on our <?php the_field('question_title_01',$homePage);?>?</a></h4>
				</section>
				<section class="column">
					<?php the_field('second_paragraph',$homePage);?>
					<h4><a id="contact-link" href="<?php the_field('question_title_02',$homePage);?>">Have some questions on our <?php the_field('question_title_02',$homePage);?>?</a></h4>
				</section>
				<section class="column">
					<?php the_field('third_paragraph',$homePage);?>
					<h4><a id="contact-link" href="<?php the_field('question_title_03',$homePage);?>">Have some questions on our <?php the_field('question_title_03',$homePage);?>?</a></h4>
				</section>
				<div>
					<h4 class="index-cursor" style="bottom: -20px;"><a href="#projects" title="projects">projects</a></h4>
				</div>
			</section>
		</article>

		<div id="cover-projects">

			<section id="projects" class="listed-posts">
				<article class="post-category">
					<h2><?php echo get_cat_name(6); ?></h2> <!-- Projects Category title -->
					<section class="introduction">
						<p class="precede"><?php echo category_description(6); ?></p><!-- Projects Category description -->
					</section>
				</article>

				<?php $catQuery = new WP_Query( 'cat=6&posts_per_page=7&post_type=projects&orderby=date' );
				if($catQuery->have_posts()):?>
				<?php while($catQuery->have_posts()) : $catQuery->the_post();?>

					<article class="post-item">
						<section class="featured-image">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<img src="<?php the_post_thumbnail_url( 'thumbnail' );  ?>" title="<?php the_title(); ?>">
								<?php if (in_category(7)):?>
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/maintenance-icon.svg" title="Maintenance Project" class="project-icon" width="30" height="auto">
								<?php endif;?>
								<?php if (in_category(5)):?>
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/design-installation-icon.svg" title="Design and Installation Project" class="project-icon" width="30" height="auto">
								<?php endif;?>
							</a>
						</section>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h3><?php the_title(); ?></h3></a>
						<section class="introduction">
							<p><?php the_excerpt();?></p>
						</section>
					</article>

				<?php endwhile; endif;?>
			</section>
		</div>

	</section>

<?php get_footer(); ?>
