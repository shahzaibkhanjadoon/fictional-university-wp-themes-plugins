<?php 
get_header();
page_banner(array(
'title'=> 'Past Events',
'subtitle'=>'Get in Touch with us',
));
?>

    <div class="container container--narrow page-section">
       <?php 
       
        $past_events = new WP_Query(array(
             'paged'=>get_query_var('paged',1),
             'posts_per_page'=>2,
             'post_type'=>'event',
             'meta_key'=>'event_date',
             'orderby'=>'meta_value_num',
             'order'=>'Desc',
             'meta_query'=>array(
                array(
                   'key'=> 'event_date',
                   'compare'=>'<',
                    'value'=>date('Ymd'),
                ),
            ),

            
        ));
      
        while($past_events->have_posts())
        {
          $past_events->the_post();
          get_template_part('template files/event_template');

        }
       echo paginate_Links(array(
           'total'=> $past_events->max_num_pages,
        ));
       ?>
       
    </div>
<?php
get_footer();
?>