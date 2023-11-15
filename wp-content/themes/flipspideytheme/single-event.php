
<?php
    get_header();

while(have_posts()){
    the_post();
    page_banner();
    ?>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <a class="metabox__blog-home-link" href="<?=get_post_type_archive_link('event')?>">
                <i class="fa fa-home" aria-hidden="true"></i> 
                Back to Event
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
        $relatedPrograms = get_field('related_programs');

        if($relatedPrograms){
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium"> Related Program(s)</h2>';
        echo '<ul class="link-list min-list">';
    
        foreach($relatedPrograms as $program){
          ?>
            <li><a href="<?=get_the_permalink($program)?>"><?=get_the_title($program)?></a></li>
          <?php
        }
        echo '</ul>';
        }
    ?>
  </div>
<?php
    }
    get_footer();
?>