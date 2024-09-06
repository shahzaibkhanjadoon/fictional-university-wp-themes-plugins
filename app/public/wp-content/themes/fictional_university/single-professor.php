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
    
    <h3 class="headline headline--medium headline--post--title"><?php the_title();?></h3>
    <div class="generic-content">

    <div class="row group">
      <div class="one-third">
        <?php the_post_thumbnail('professorportrait'); ?>
      </div>
      <div class="two-thirds">
      <p><?php the_content(); ?><p>
      </div>
    </div>
     
      <?php 
      
      $related_programs = get_field('related_programs');
      if($related_programs)
      {
       echo '<hr>';
        echo '<h4 class="title"> Subject(s) Taught </h4>';
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
 
