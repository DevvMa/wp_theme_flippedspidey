
<?php
    get_header();
    page_banner(array(
        'title' => "Our Campuses",
        'subtitle' => "We have several conveniently located campuses"
    ));
?>


    <div class="container container--narrow page-section">
    <div class="acf-map">

        <?php
        while(have_posts()){
            the_post();
            $mapLocation = get_field('map_location');
        ?>
            <div class="marker" data-lat="<?=$mapLocation['lat']??null?>" data-lng="<?=$mapLocation['lng']??null?>">
            <h3><a href="<?=the_permalink()?>"><?=the_title()?></a></h3>
            <?=$mapLocation['address']?>
            </div>
        <?php
        }
        echo paginate_links();
        ?>
    </div>

  </div>
<?php
    get_footer();
?>