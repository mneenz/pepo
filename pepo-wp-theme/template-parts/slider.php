<!-- Slider -->
<?php $counter = 0; //Set counter to 0
      $images = get_field('gallery'); //Get gallery field and set it to the variable $images
      if( $images ): //Check if there are images in the gallery field
?>

  <div id="slide-window">

    <ol id="slides"> <!-- Slides list -->

    <!-- Images -->
      <?php foreach( $images as $image ): $counter++;//Foreach through images ?>
        <?php $imageTitle = get_the_title($image['id']); //Get the title of images via the image id and set it to the variable $imageTitle
          echo '<a id="slide" rel="'.$counter.'" title="'.$imageTitle.'"> <img rel="lightbox" src="'. $image['url'] .'" width="auto" height="100%">'; //Output the large size
          echo '</a>';
      endforeach;?>
    </ol>

    <!-- Navigation -->
    <?php if ($counter > 1) :?>
      <div id="navigation" class="center">
        <a id="prev" title="Previous Project Image">
            <span class="menu_icon slicknav">
              <span class="menu_icon-bar"></span>
              <span class="menu_icon-bar"></span>
              <span class="menu_icon-bar"></span>
            </span>
        </a>
        <a id="next" title="Next Project Image">
            <span class="menu_icon slicknav">
              <span class="menu_icon-bar"></span>
              <span class="menu_icon-bar"></span>
              <span class="menu_icon-bar"></span>
            </span>
        </a>
      </div>
    <?php endif;?>
  </div>

<?php endif; ?>
