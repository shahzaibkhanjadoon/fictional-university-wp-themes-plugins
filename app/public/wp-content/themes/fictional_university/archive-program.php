<?php 
get_header();
page_banner(array(
  'title'=> 'All Programs',
  'subtitle'=>'There is something for everyone here',
  ));
?>
    
    <div class="container container--narrow page-section">
       <ul>
       <?php 
        while(have_posts())
        {
          the_post();
          ?>
          <a href="<?php the_permalink() ?>" style="text-decoration: none;"><li>
            <?php
          the_title();
          ?>
          </li>
          </a>
          <?php
        }
       ?>
       </ul>
       <hr class="section-break">
    </div>
<?php
get_footer();
?>