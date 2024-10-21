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
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program') ?>"><i class="fa fa-home" aria-hidden="true"> &nbsp; All Programs</i> </a> <span class="metabox__main"><?php  the_title(); ?></span>
        </p>
      </div>
    <h3 class="headline headline--medium headline--post--title"><?php the_title();?></h3>
    <div class="generic-content">
    <p><?php the_content(); ?><p>
        <hr>
        <?php 
        $professors= new WP_Query(array(
        
            'posts_per_page'=> -1,
            'post_type'=>'professor',
            'orderby'=>'title',
            'order'=>'ASC',
             'meta_query'=>array(
               
               array(
                'key'=>'related_programs',
                'compare'=>'LIKE',
                'value'=> '"'.get_the_ID().'"'
               )
               ),

        ));
        
        if($professors->have_posts())
        {
        echo   '<h4> Professors </h4>';
        echo '<ul class="professor-cards">';
        while($professors->have_posts()){
           
          $professors->the_post();
         ?>
         <li class="professor-card__list-item">
         <a class="professor-card" href="<?php the_permalink() ?>"> <img class="professor_card__image" src="<?php the_post_thumbnail_url() ?>">
          <span class="professor-card__name"><?php the_title();?></span>
          </a>
        </li>
         <?php
        }
        echo '</ul>';

        }
        // wp_reset_query();
        wp_reset_postdata();

        //showing related campuses
        $Related_Campuses = get_field('related_campuses');

        if($Related_Campuses)
        {
          echo '<hr>';
          echo '<h4>Related Campuses</h4>'; 
          echo '<ul>';
          foreach($Related_Campuses as $campus)
          {
            ?>
            <a href="<?php the_permalink($campus) ?>">
            <li>
            <?php
            echo get_the_title($campus);
           ?>
           </a>
          </li>
           <?php 
          }
          echo '</ul>';
        }
       

         $upcoming_events = new WP_Query(array(
            'posts_per_page'=> -1,
            'post_type'=>'event',
            'meta_key'=>'event_date',
            'orderby'=>'meta_value_num',
            'order'=>'Desc',
             'meta_query'=>array(
                array(
                    'key'=>'event_date',
                    'compare'=>'>=',
                    'value'=> date('Ymd'),
                    'type'=>'numeric',
                   ),
               array(
                'key'=>'related_programs',
                'compare'=>'LIKE',
                'value'=> '"'.get_the_ID().'"'
               )
               ),
             
         ));

    
         if($upcoming_events->have_posts())
         {
          echo '<hr>';
          echo '<h4> Related Events </h4>';
          while($upcoming_events->have_posts()){
            $upcoming_events->the_post();
            get_template_part('template files/event_template');
          }
        }

        
         wp_reset_postdata();
     ?>
    
        </div>
    </div>
    <?php
    ?>
   
    <?Php
}
?>
<?php
get_footer();
?>
 
