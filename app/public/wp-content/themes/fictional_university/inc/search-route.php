<?php 
//  function for registing custom rest route  

add_action('rest_api_init','universityregistersearch');

function universityregistersearch()
{
    register_rest_route('university/v1','search',array(
      'methods'=> WP_REST_SERVER::READABLE ,
      'callback'=>'universitysearchresults',
    ));
}

function universitysearchresults($data){

    $mainquery=new WP_Query(array(
        'post_type'=> array('post','page','professor', 'program', 'campus','event'),
        's'=>sanitize_text_field($data['term'])
    ));
   
    $results = array(
        'generalinfo'=>array(),
        'professors'=>array(),
        'campuses'=>array(),
        'events'=>array(),
        'programs'=>array(),
    );
    while($mainquery-> have_posts())
    {
           $mainquery->the_post();

           if(get_post_type()=='post' OR get_post_type()=='page')
           {
            array_push($results['generalinfo'], array(
                'title'=>get_the_title(),
                'link'=>get_the_permalink(),
               ));
           }

           if(get_post_type()=='professor')
           {
            array_push($results['professors'], array(
                'title'=>get_the_title(),
                'link'=>get_the_permalink(),
               ));
           }

           
           if(get_post_type()=='program')
           {
            array_push($results['programs'], array(
                'title'=>get_the_title(),
                'link'=>get_the_permalink(),
               ));
           }
          
           if(get_post_type()=='campus')
           {
            array_push($results['campuses'], array(
                'title'=>get_the_title(),
                'link'=>get_the_permalink(),
               ));
           }

           if(get_post_type()=='event')
           {
            array_push($results['events'], array(
                'title'=>get_the_title(),
                'link'=>get_the_permalink(),
               ));
           }
    }
    
    return $results;
}
?>