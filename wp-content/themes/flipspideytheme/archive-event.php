
<?php
    get_header();
    page_banner(array(
      'title' => "All Events",
      'subtitle' => 'See how the world moving around us'
    ));
?>

  <div class="container container--narrow page-section">

    <?php
      while(have_posts()){
        the_post();
        $eventDate = new DateTime(get_field('event_date'));
        get_template_part('template-parts/content', 'event');
      }
      echo paginate_links();
    ?>
    <hr class="section-break">
    <p>Looking for our past events? Checkout in our <a href="<?=site_url('/past-events')?>">past events archive</a></p>
  </div>
<?php
    get_footer();
?>