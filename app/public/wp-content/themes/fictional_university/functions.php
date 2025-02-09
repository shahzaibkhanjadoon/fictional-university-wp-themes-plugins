<?php

// custom rest route for search
require get_theme_file_path('/inc/search-route.php');
// function to customize rest API 
function university_costom_rest(){
  register_rest_field('post','authorName',array(
'get_callback'=>function(){
   return get_the_author();
}
  ));
}
add_action('rest_api_init','university_costom_rest');
//page banner function
function page_banner($args=Null)
{

  if (!isset($args['title'])) {
    $args['title'] = get_the_title();
  }
 
  if (!isset($args['subtitle'])) {
    $args['subtitle'] = get_field('page_subtitle');
  }
 
  if (!isset($args['photo'])) {
    if (get_field('page_banner') AND !is_archive() AND !is_home() ) {
      $args['photo'] = get_field('page_banner')['sizes']['page_banners'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }
  ?>

  <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'];?>"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
    <div class="page-banner__intro">
      <p><?php echo $args['subtitle']; ?></p>
    </div>
  </div>
</div>

<?php 
}

function University_style_files()
{
    wp_enqueue_script('main_js_file', get_theme_file_uri('/build/index.js'),array('jquery'),1.0,true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('main_style_file', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('extra_style_file',get_theme_file_uri('/build/index.css'));

    // output js data in source file : three parameters 1: where you want to use this data , 2: name 3:array for data.
    wp_localize_script('main_js_file','universitydata',array(
      'root_url'=>get_site_url(),
    ));
}

add_action('wp_enqueue_scripts','University_style_files');


function university_features()
{
   add_theme_support('title-tag');
   add_theme_support('post-thumbnails');
   add_image_size('professorlandscape',400,260, true);
   add_image_size('professorportrait',480,650, true);
   add_image_size('page_banners', 1500, 350, true);
   register_nav_menu('headerlocation','Header Location');
}
add_action('after_setup_theme','university_features');

function university_adjust_queries($query)
{
// adjust program query 

if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query())
{
  $today=date('Ymd');
  $query->set('orderby','title');
  $query->set('order','ASC');
  $query->set('posts_per_page',-1);
}
// adjust event query
if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query())
{
  $today=date('Ymd');
  $query->set('meta_key','event_date');
  $query->set('orderby','meta_value_num');
  $query->set('order','DECS');
  $query->set('meta_query', array(
    array(
      'key' => 'event_date',
      'compare' => '>=',
      'value' => $today,
      'type' => 'numeric'
    )
  ));
}
}

add_action('pre_get_posts','university_adjust_queries');
?>