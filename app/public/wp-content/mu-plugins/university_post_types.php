<?php 
function university_post_types()
{
    
    // event post type 
        register_post_type('event',array(
            'rewrite' => array('slug' => 'events'),
            'supports'=>array('title','editor','excerpt'),
            'has_archive'=>true,
            'public'=> true,
            'show_in_rest'=>true,
            'labels'=>array(
                'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event'
            ),
            'menu_icon'=> 'dashicons-calendar',
       
         
        ));
// program post type 
        register_post_type('program',array(
            'rewrite' => array('slug' => 'programs'),
            'supports'=>array('title','editor'),
            'has_archive'=>true,
            'public'=> true,
            'show_in_rest'=>true,
            'labels'=>array(
                'name' => 'program',
      'add_new_item' => 'Add New program',
      'edit_item' => 'Edit program',
      'all_items' => 'All programs',
      'singular_name' => 'Program'
            ),
            'menu_icon'=> 'dashicons-awards',
       

        ));
// professors post type 

        register_post_type('professor',array(
            'supports'=>array('title','editor','thumbnail'),
            'public'=> true,
            'show_in_rest'=>true,
            'labels'=>array(
                'name' => 'Professors',
      'add_new_item' => 'Add New professor',
      'edit_item' => 'Edit professor',
      'all_items' => 'All professors',
      'singular_name' => 'Professor'
            ),
            'menu_icon'=> 'dashicons-welcome-learn-more',
       

        ));

        register_post_type('campus',array(
            'rewrite' => array('slug' => 'campuses'),
            'supports'=>array('title','editor','thumbnail'),
            'public'=>true,
            'show_in_rest'=>true,
            'has_archive'=>true,
            'labels'=>array(
                'name' => 'campuses',
      'add_new_item' => 'Add New campus',
      'edit_item' => 'Edit campus',
      'all_items' => 'All campuses',
      'singular_name' => 'campus'
            ),
            'menu_icon'=> 'dashicons-location-alt',

        ));
    
}

add_action('init','university_post_types');
?>