<?php 
get_header();
page_banner(array(
  'title'=> 'ALL Events',
  'subtitle'=>'Get in Touch with us',
  ));
?>
  
    <div class="container container--narrow page-section">
       <?php 
       
        while(have_posts())
        {
          the_post();
          get_template_part('template files/event_template');

        }
       ?>
       <hr class="section-break">
       <p>Watch Our Past Events <a href="<?php echo site_url('/past-events') ?>"> <b>Click Here<b></a></p>
    </div>
<?php
get_footer();
?>