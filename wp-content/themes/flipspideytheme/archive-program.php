
<?php
    get_header();
    page_banner(array(
      'title' => "All Program",
      'subtitle' => "There is something for everyone. Have a look around."
    ));
?>


  <div class="container container--narrow page-section">
    <ul class="link-list min-list">

    <?php
      while(have_posts()){
        the_post();
        $eventDate = new DateTime(get_field('event_date'));
    ?>

    <li><a href="<?=the_permalink()?>"> <?=the_title()?></a></li>
    <?php
      }
      echo paginate_links();
    ?>
    </ul>

  </div>
<?php
    get_footer();
?>