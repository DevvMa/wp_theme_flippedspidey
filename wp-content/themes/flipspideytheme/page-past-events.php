
<?php
    get_header();
    page_banner(array(
      'title' => "Past Event",
      'subtitle' => "Recap of our past event"
    ));
?>

  <div class="container container--narrow page-section">

    <?php
        $today = date('Ymd');
        $pastEvents = new WP_Query(array(
            'paged' => get_query_var('paged', 1),
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => "ASC",
            'meta_query' => array(
              array(
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric'
              )
            )
        ));
        while($pastEvents->have_posts()){
            $pastEvents->the_post();
            $eventDate = new DateTime(get_field('event_date'));
    ?>
            <div class="event-summary">
                <a class="event-summary__date t-center" href="#">
                <span class="event-summary__month"><?=$eventDate->format('M')?></span>
                <span class="event-summary__day"><?=$eventDate->format('d')?></span>  
                </a>
                <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?=the_permalink()?>"><?=the_title();?></a></h5>
                <p><?php
                    if(has_excerpt()){
                        echo get_the_excerpt();
                    } else {
                        echo wp_trim_words(get_the_content(),18);
                    }
                    ?> <a href="<?=the_permalink()?>" class="nu gray">Learn more</a>
                </p>
                </div>
            </div>

    <?php
        }
        echo paginate_links(array(
            'total' => $pastEvents->max_num_pages
        ));
    ?>
  </div>
<?php
    get_footer();
?>