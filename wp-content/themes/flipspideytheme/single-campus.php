
<?php
    get_header();

while(have_posts()){
    the_post();
    page_banner();
    ?>
  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <a class="metabox__blog-home-link" href="<?=get_post_type_archive_link('program')?>">
                <i class="fa fa-home" aria-hidden="true"></i> 
                All Programs
            </a> 
            <span class="metabox__main">
                <?=the_title()?>
            </span>
        </p>
    </div>

    <div class="generic-content">
      <?php the_content(); ?>
    </div>
    
    <?php
      $relatedProgram = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => 'program',
        'order' => "ASC",
        'meta_query' => array(
          array(
            'key' => 'related_campuses',
            'compare' => 'LIKE',
            'value' => '"'.get_the_ID().'"'
          )
        )
      ));
      
      if($relatedProgram->have_posts()){
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Program available at this campus</h2>';
        echo '<ul class="min-list link-list">';
        while ($relatedProgram -> have_posts()){
          $relatedProgram -> the_post();
          ?>
          <li>
            <a href="<?=the_permalink()?>"><?=the_title();?></a>
          </li>
          <?php
        }
        echo "</ul>";

      }
      wp_reset_postdata();
    ?>

  </div>
<?php
    }
    get_footer();
?>