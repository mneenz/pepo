<!-- Individual Post Content -->
<article class="post-item">

  <!-- Thumbnail image -->
  <section class="featured-image">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <img src="<?php the_post_thumbnail_url( 'thumbnail' );  ?>" title="<?php the_title(); ?>"> <!-- Post thumbnail -->
      <?php if (in_category(7)): //Check if the post is in the Maintenance category & show relevant icon ?>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/maintenance-icon.svg" title="Maintenance Project" class="project-icon" width="30" height="auto">
      <?php endif;?>
      <?php if (in_category(5)): //Check if the post is in the Design & Installation category & show relevant icon ?>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/design-installation-icon.svg" title="Design and Installation Project" class="project-icon" width="30" height="auto">
      <?php endif;?>
    </a>
  </section>

  <!-- Date for News Category items-->
  <?php if ( in_category('news') ):?>
    <h4><?php echo get_the_date(); ?></h4>
  <?php endif;?>
  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h3><?php the_title(); ?></h3></a> <!-- Project title -->
  <section class="introduction">
    <p><?php the_excerpt();?></p> <!-- Project excerpt -->
  </section>
</article>
