
<?php
    get_header();

while(have_posts()){
    the_post();
    page_banner();
    ?>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <a class="metabox__blog-home-link" href="<?=site_url('/blog')?>">
                <i class="fa fa-home" aria-hidden="true"></i> 
                Back to Blog
            </a> 
            <span class="metabox__main">
                <?=the_title()?>
            </span>
        </p>
    </div>

    <div class="generic-content">
      <?php the_content(); ?>
    </div>

  </div>
<?php
    }
    get_footer();
?>