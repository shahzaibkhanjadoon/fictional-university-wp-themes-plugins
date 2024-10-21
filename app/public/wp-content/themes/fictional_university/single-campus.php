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
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus') ?>"><i class="fa fa-home" aria-hidden="true"> &nbsp; All Campuses</i> </a> <span class="metabox__main"><?php  the_title(); ?></span>
        </p>
      </div>
    <h3 class="headline headline--medium headline--post--title"><?php the_title();?></h3>
    <div class="generic-content">
    <p><?php the_content(); ?><p>
        <hr>
</div>
<?php
$Related_programs = new WP_Query(array(
        'posts_per_page'=> -1,
        'post_type'=>'program',
        'orderby'=>'title',
        'order'=>'Asc',
         'meta_query'=>array(
            array(
                'key'=>'related_campuses',
                'compare'=>'LIKE',
                'value'=> '"'.get_the_ID().'"',
               ),
           ),
         
     ));
// print_r($Related_programs);

// while($Related_programs->have_posts())
// {
     if($Related_programs->have_posts())
     {
      echo '<h4> Related Programs </h4>';
      echo '<ul>';
       while($Related_programs->have_posts())
 {
        $Related_programs->the_post();
        ?><a href="<?php the_permalink(); ?>"><?php
      echo '<li>';
     echo get_the_title(); 
      echo '</li>';
      ?></a><?php
     }
      }   
      echo '</ul>';
//  }
 ?>

<?php
}
get_footer();
?>
 
