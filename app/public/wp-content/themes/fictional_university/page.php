 <?php
get_header();
while(have_posts())
{
    the_post(); 
    page_banner();
    ?> 
    
   
    
    <div class="container container--narrow page-section"> 
      <?php 
        $the_parrent= wp_get_post_parent_ID(get_the_ID());
        if($the_parrent)
        {
          ?>
          <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
         
          <a class="metabox__blog-home-link" href="<?php the_permalink($the_parrent) ?>"><i class="fa fa-home" aria-hidden="true"> Back to <?php echo get_the_title($the_parrent) ?></i> </a> <span class="metabox__main"><?php the_title() ?></span>
        </p>
      </div>
          <?php
        }
        
     ?>
      <?php
      $childcheck = get_pages(array(
        'child_of'=>get_the_ID()
      ));
      // echo $the_parrent;
      
      // echo json_encode($childcheck);
      if($the_parrent or $childcheck) 
      {
        ?>
        <div class="page-links">
    
        <h2 class="page-links__title"><a href="<?php the_permalink($the_parrent) ?>"><?php echo get_the_title($the_parrent) ?></a></h2>
        <ul class="min-list">
    
         <?php
         if($the_parrent) 
         {
          $findchildof=$the_parrent;
         } 
         else
         {
          $findchildof = get_the_ID();
         }
         wp_list_pages(array(
          'title_li'=>NULL,
           'child_of'=> $findchildof, 
           'sort_column'=>'menu_order'

         )); ?>
        </ul>
      </div>
        <?php
      }
      ?>
      
      
     
      <div class="generic-content">
        <?php the_content(); ?>
    </div>

    

    <?Php
}
get_footer();
?>
