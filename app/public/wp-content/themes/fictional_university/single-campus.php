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
}
get_footer();
?>
 
