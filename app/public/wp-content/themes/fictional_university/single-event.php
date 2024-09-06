<?php
get_header();
?> 
<?php

while(have_posts())
{
    the_post(); 
    page_banner();
    ?>
     
    <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event') ?>"><i class="fa fa-home" aria-hidden="true"> Events Home</i> </a> <span class="metabox__main"><?php  the_title(); ?></span>
        </p>
      </div>
    <h3 class="headline headline--medium headline--post--title"><?php the_title();?></h3>
    <div class="generic-content">
    <p><?php the_content(); ?><p>
      <hr>
      <h4 class="title"> Related Programs </h4>
      <?php 
      
      $related_programs = get_field('related_programs');
      if($related_programs)
      {
        echo '<ul>';
        foreach ($related_programs as $program)
        {
          echo '<li>';
         ?> <a href="<?php echo get_the_permalink($program) ?>" style="text-decoration:none;"> <?php echo get_the_title($program); ?></a><?php
          echo '</li>';
        }
        echo '</ul>';
      }
      
      ?>
    </div>
    </div>
   
   
    <?Php
}
?>
<?php
get_footer();
?>
 
