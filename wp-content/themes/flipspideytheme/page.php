
<?php
    get_header();

while(have_posts()){
  the_post();
  page_banner();
  ?>

  <div class="container container--narrow page-section">

    <?php 
        $parentID = wp_get_post_parent_id(get_the_ID());
        if($parentID){
    ?>
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <a class="metabox__blog-home-link" href="<?=get_permalink($parentID)?>">
                <i class="fa fa-home" aria-hidden="true"></i> 
                Back to <?=get_the_title($parentID)?>
            </a> 
            <span class="metabox__main">
                <?=the_title()?>
            </span>
        </p>
    </div>
    <?php
        }
    ?>
    
    <?php
        $childIds = get_pages(array(
            'child_of' => get_the_ID()
        ));

        if($parentID or $childIds ){
    ?>
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?=get_permalink($parentID)?>"><?=get_the_title($parentID)?></a></h2>
      <ul class="min-list">
        <?php
            $childOfId = $parentID; 
            if(!$parentID){
                $childOfId = get_the_ID(); 
            }
            wp_list_pages(array(
              'title_li' => NULL,
              'child_of' => $childOfId,
              'sort_column' => 'menu_order'
            ));
        ?>
      </ul>
    </div>
    <?php } ?>
   

    <div class="generic-content">
      <?php the_content(); ?>
    </div>

  </div>
<?php
    }
    get_footer();
?>