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
          <a class="metabox__blog-home-link" href="<?php echo site_url('/blog') ?>"><i class="fa fa-home" aria-hidden="true"> Back to Blog</i> </a> <span class="metabox__main"><?php  the_title(); ?> By <?php the_author_posts_link();?></span>
        </p>
      </div>
    <h3 class="headline headline--medium headline--post--title"><?php the_title(); ?></h3>
    <div class="generic-content">
    <p><?php the_content(); ?><p>
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
 
