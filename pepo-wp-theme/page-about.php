<?php
/*
About Page
*/

get_header(); ?>

	<section id="content" role="main">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<section class="header" style="background-image:url('<?php the_field('background_image'); ?>');">
        <section class="header-content">
  				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/people.svg" alt="People" width="auto" height="100%" class="people"/>

  				<section class="staff">
  					<?php if( have_rows('staff_member') ): while( have_rows('staff_member') ): the_row(); // loop through rows (cstaff repeater)
  						$name = get_sub_field('staff_name'); //Output staff name
  						$title = get_sub_field('staff_title'); //Output staff title
  						$image = get_sub_field('staff_picture'); //Output staff picture
  						$description = get_sub_field('staff_description'); //Output staff description
  					?>

  						<article class="staff-member">
  							<div id="staff-image">
  								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" width="100%" height="auto"/>
  								<p><?php echo $description; ?></p>
  							</div>
  							<h4><?php echo $name; ?> <em><?php echo $title; ?></em></h4>
  						</article>

  					<?php endwhile; endif; ?>
  				</section>
        </section>

			</section>

      <article class="text">
  			<section class="left-column">

  				<!-- Page title and icon-->
  				<div class="category">
  					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-icon-black.svg" alt="e-News" width="35" height="auto"/>
  					<h3><?php the_title(); ?></h3> <!-- Title -->
  				</div>

  				<!-- Main text-->
  				<h2 class="post-title">Our Story</h2>
  				<section class="main-text">
  					<?php the_content();?>
  				</section>
  			</section>

        <section class="right-column">
  				<!-- Contact-->
  				<section class="contact">
  					<ul class="contact-columns">
              <?php $contactPage = get_post( 93 ); $homePage = get_post( 63 );?>
              <li class="address"><h4><?php the_field('address',$contactPage);?></h4></li>
              <li class="phone"><h4><a href="#"><?php the_field('phone_number',$contactPage);?></a></li>
              <li class="email"><h4><a href="mailto:<?php the_field('email',$contactPage); ?>"><?php the_field('email',$contactPage);?></a></h4></li> <!-- Out email-->
						  <li class="question">
                <h4><a id="contact-link" href="<?php the_field('question_title_01',$homePage);?>">Questions on our <?php the_field('question_title_01',$homePage);?>?</a></h4>
                <h4><a id="contact-link" href="<?php the_field('question_title_02',$homePage);?>">Questions on our <?php the_field('question_title_02',$homePage);?>?</a></h4>
                <h4><a id="contact-link" href="<?php the_field('question_title_03',$homePage);?>">Questions on our <?php the_field('question_title_03',$homePage);?>?</a></h4>
              </li>
  					</ul>
  				</section>

  				<!-- Awards-->
  				<section class="awards">
  					<ul class="award-columns">
  						<?php if( have_rows('awards') ): while( have_rows('awards') ): the_row(); // loop through rows (awards repeater)
  						$status = get_sub_field('award_status'); //Output awards status
  						$awardName = get_sub_field('award_name'); //Output awards name ?>
  							<li class="award"><h4><?php echo $status; ?></h4> <p><?php echo $awardName; ?></p></li>
  						<?php endwhile; endif; ?>
  					</ul>
  				</section>

        </section>

      </article>

		<?php endwhile; endif; ?>

		<div class="index-cursor">
			<h4 class="index-cursor"><a href="#news" title="News">News</a></h4>
		</div>

    <!-- News-->
    <section id="news" class="category-news">
      <div class="news-icon">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/news.svg" alt="e-News" width="35" height="auto"/>
      </div>
      <section  class="listed-posts">
        <article class="post-category">
      	  <h2><?php echo get_cat_name(7); ?></h2> <!-- News Category title -->
          <?php get_template_part( '/template-parts/news-sidebar'); ?>

      	</article>

  			<?php $catQuery = new WP_Query( 'posts_per_page=7&post_type=news' );
  			if($catQuery->have_posts()): while($catQuery->have_posts()) : $catQuery->the_post();
          get_template_part( '/template-parts/post-content', get_post_format() );
        endwhile; endif;?>
  		</section>

    </section>

	</section>

<?php get_footer(); ?>
